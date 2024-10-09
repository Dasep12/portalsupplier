<?php

namespace App\Http\Controllers;

use App\Models\EntryStockDaily;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Part;
use App\Models\Supplier;
use App\Models\UpdateStock;
use Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;

class EntryStockController extends Controller
{
    //
    public function index()
    {
        return view("entrystock.index");
    }

    public function jsonStockList(Request $req)
    {
        $data = EntryStockDaily::jsonList($req);
        return response()->json($data);
    }


    public function uploadFiles(Request $request)
    {

        try {
            $request->validate([
                'excel_file' => 'required|mimes:xlsx,xls,csv',
            ]);

            $file = $request->file('excel_file');
            $filePath = $file->getPathname();

            // Start processing the file
            $spreadsheet = IOFactory::load($filePath);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            unset($sheetData[0]);
            unset($sheetData[1]);
            $processedData = [];
            $error = [];
            foreach ($sheetData as  $row) {
                $suppName = Supplier::where('supplier_name', $row['B'])->count();
                if ($suppName <= 0) {
                    array_push($error, ['Supplier ' . $row['B'] . ' not found']);
                }

                // cek part number 
                $partNumber = Part::where('part_number', $row['C'])->count();
                if ($partNumber <= 0) {
                    array_push($error, ['Part Number ' . $row['C'] . ' not found']);
                }

                // cek part name 
                $partName = Part::where('part_name', $row['D'])->count();
                if ($partName <= 0) {
                    array_push($error, ['Part Name ' . $row['D'] . ' not found']);
                }


                $res = [
                    'date_upload'     => date('d M Y'),
                    'supplier_name'   => $row['B'],
                    'part_number'     => $row['C'],
                    'part_name'       => $row['D'],
                    'qty_safety'      => $row['E'],
                ];
                array_push($processedData, $res);
            }
            return response()->json([
                'message' => 'File processed successfully.',
                'data'    => $processedData,
                'errors'  => $error,
                'success' => count($error) > 0 ? false : true
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }


    public function jsonImportStock(Request $req)
    {
        $sendData = $req->allData;
        $data = [];
        foreach ($sendData as $s) {
            // cek part 
            $partName = Part::where('part_number', $s['part_number'])->get()->first();
            $par = [
                'supplier_id'       => $req->supplier_id,
                'part_id'           => $partName->id,
                'qty_safetyStock'   => $s['qty_safety'],
                'created_at'        => date('Y-m-d H:i:s'),
                'date_upload'       => date("Y-m-d", strtotime($s['date_upload'])),
                'created_by'        => 1
            ];

            $par2 = [
                'supplier_id'       => $req->supplier_id,
                'part_id'           => $partName->id,
                'stock'             => $s['qty_safety'],
                'created_at'        => date('Y-m-d H:i:s'),
                'date_update'       => date("Y-m-d", strtotime($s['date_upload'])),
                'created_by'        => 1
            ];
            $count = EntryStockDaily::where(['part_id' => $partName->id, 'date_upload' => date("Y-m-d", strtotime($s['date_upload']))]);
            if ($count->count() > 0) {
                $update = $count->get()->first();
                $update->qty_safetyStock = $s['qty_safety'];
                $update->updated_at = date('Y-m-d H:i:s');
                $update->updated_by = 1;
                $update->save();
            } else {
                EntryStockDaily::insert($par);
            }


            $cekStock = UpdateStock::where(['part_id' => $partName->id]);
            if ($cekStock->count() > 0) {
                $update = $cekStock->get()->first();
                $update->stock = $s['qty_safety'];
                $update->updated_at = date('Y-m-d H:i:s');
                $update->date_update = date('Y-m-d H:i:s');
                $update->updated_by = 1;
                $update->save();
            } else {
                UpdateStock::insert($par2);
            }
        }

        DB::beginTransaction();
        try {
            DB::commit();
            return response()->json(['success' => true, 'msg' => 'success upload stock']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'msg' => $e->getMessage()], 500);
        }
    }



    public function downloadFormat(Request $req)
    {
        $supplier = $req->suppliers_id;

        $data = DB::table('tbl_mst_part as a')
            ->leftJoin('tbl_mst_supplier as b', 'a.supplier_id', '=', 'b.id')
            ->where('a.supplier_id', $supplier)
            ->select('a.*', 'b.supplier_name')
            ->get();
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        // Set some data in the spreadsheet
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'SUPPLIER');
        $sheet->setCellValue('C1', 'PART NUMBER');
        $sheet->setCellValue('D1', 'PART NAME');
        $sheet->setCellValue('E1', 'QTY SAFETY');


        // Set background color for a range of cells
        $sheet->getStyle('A1:E1')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FABF8F'], // Magenta background
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'font' => [
                'bold' => true,
            ],
        ]);

        // Example: Freeze the first row
        $sheet->freezePane('A2');
        // Auto size columns based on the content
        $this->autoSizeColumns($sheet, range('A', 'E'));

        $start = 2;
        $no = 1;

        if (count($data) > 0) {
            foreach ($data as $d) {
                $sheet->setCellValue('A' . $start, $no++);
                $sheet->setCellValue('B' . $start, strtoupper($d->supplier_name));
                $sheet->setCellValue('C' . $start, $d->part_number);
                $sheet->setCellValue('D' . $start, strtoupper($d->part_name));
                $sheet->setCellValue('E' . $start, 0);
                // Apply striped background color (alternating rows)
                $backgroundColor = ($start % 2 == 0) ? 'FFFFFFFF' : 'FDE9D9'; // Light gray for even rows, white for odd rows
                $sheet->getStyle("A$start:E$start")->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['argb' => $backgroundColor],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
                $start++;
            }
        } else {
            $sheet->setCellValue('A' . $start, "data not found");
            $sheet->mergeCells('A' . $start . ':E' . $start + 1);
        }

        // Save the spreadsheet to a file
        $writer = new Xlsx($spreadsheet);
        $tempFile = tempnam(sys_get_temp_dir(), 'php');
        $writer->save($tempFile);
        // Return the file as a response
        return response()->download($tempFile, 'export.xlsx')->deleteFileAfterSend(true);
    }

    private function autoSizeColumns($sheet, array $columns)
    {
        foreach ($columns as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    }
}
