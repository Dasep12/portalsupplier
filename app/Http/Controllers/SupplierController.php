<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;
use Exception;
use GuzzleHttp\Promise\Create;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;

class SupplierController extends Controller
{
    //
    public function index()
    {
        return view("supplier.index");
    }

    public function jsonSupplierList(Request $req)
    {
        $data = Supplier::jsonList($req);
        return response()->json($data);
    }

    public function jsonCrudSupplier(Request $req)
    {
        $act = $req->CrudActionSupplier;
        $data = [
            "supplier_id" => $req->supplier_id,
            "supplier_name" => $req->supplier_name,
            "email" => $req->email,
            "phone" => $req->phone,
            "address" => $req->address,
            "status_supplier" => isset($req->status_supplier) ? 1 : 0,
        ];
        switch (strtolower($act)) {
            case "create":
                $cek = Supplier::where('supplier_id', $req->supplier_id);
                if ($cek->count() > 0) {
                    return response()->json(['success' => false, 'msg' => 'Supplier Id Has Been Existing']);
                }
                Supplier::Create($data);
                break;
            case "update":
                $supp = Supplier::find($req->id);
                $supp->supplier_id = $req->supplier_id;
                $supp->supplier_name = $req->supplier_name;
                $supp->phone = $req->phone;
                $supp->address = $req->address;
                $supp->email = $req->email;
                $supp->status_supplier = isset($req->status_supplier) ? 1 : 0;
                $supp->save();
                break;
            case "delete":
                Supplier::where('id', $req->id)->delete();
                break;
            case "upload":
                foreach ($req->allData as $d) {
                    $par = [
                        "supplier_id" => $d['supplier_id'],
                        "supplier_name" => $d['supplier_name'],
                        "email" => $d['email'],
                        "phone" => $d['phone'],
                        "address" => $d['address'],
                        "status_supplier" =>  1,
                    ];
                    Supplier::Create($par);
                }
                break;
        }

        try {
            DB::commit();
            return response()->json(['success' => true, 'msg' => 'Successfully', 'data' => $req->supplier_name]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['success' => false, 'msg' => $ex->getMessage()]);
        }
    }

    public function uploadFilesSupplier(Request $request)
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
                if ($suppName > 0) {
                    array_push($error, ['Supplier ' . $row['B'] . ' Has Exist']);
                }

                $suppCode = Supplier::where('supplier_id', $row['A'])->count();
                if ($suppCode > 0) {
                    array_push($error, ['Supplier Code ' . $row['A'] . ' Has Exist']);
                }


                $res = [
                    'supplier_id'     => $row['A'],
                    'supplier_name'   => $row['B'],
                    'phone'           => $row['C'],
                    'email'           => $row['D'],
                    'address'         => $row['E'],
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

    public function exportSupplier(Request $req)
    {

        $data = DB::table('tbl_mst_supplier')
            ->select('*')
            ->get();
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        // Set some data in the spreadsheet
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Supplier Code');
        $sheet->setCellValue('C1', 'Supplier Name');
        $sheet->setCellValue('D1', 'Phone');
        $sheet->setCellValue('E1', 'Email');
        $sheet->setCellValue('F1', 'Address');

        // Apply borders to a single cell
        $styleArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
                'inside' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        // Set background color for a range of cells
        $sheet->getStyle('A1:F1')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'f8fc03'], // Magenta background
            ],
            'font' => [
                'bold' => true,
            ],
        ]);

        // Example: Freeze the first row
        $sheet->freezePane('A2');
        // Auto size columns based on the content
        $this->autoSizeColumns($sheet, range('A', 'F'));

        $start = 2;
        $no = 1;

        if (count($data) > 0) {
            foreach ($data as $d) {
                $sheet->setCellValue('A' . $start, $no++);
                $sheet->setCellValue('B' . $start, $d->supplier_id);
                $sheet->setCellValue('C' . $start, $d->supplier_name);
                $sheet->setCellValue('D' . $start, ucwords(strtoupper($d->phone)));
                $sheet->setCellValue('E' . $start, ucwords(strtoupper($d->email)));
                $sheet->setCellValue('F' . $start, ucwords(strtoupper($d->address)));
                $start++;
            }
        } else {
            $sheet->setCellValue('A' . $start, "data not found");
            $sheet->mergeCells('A' . $start . ':F' . $start + 1);
        }

        $sheet->getStyle('A1:F' . $start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:F' . $start)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A1:F' . $start - 1)->applyFromArray($styleArray);
        $sheet->getStyle('A1:F' . $start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


        if ($req->act == "xls") {
            // Save the spreadsheet to a file
            $writer = new Xlsx($spreadsheet);
            $tempFile = tempnam(sys_get_temp_dir(), 'php');
            $writer->save($tempFile);

            // Return the file as a response
            return response()->download($tempFile, 'export.xlsx')->deleteFileAfterSend(true);
        } else if ($req->act == "pdf") {
            // Write the file to a stream
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf($spreadsheet);
            $writer = new Mpdf($spreadsheet);

            // Return the file as a response
            return response()->stream(
                function () use ($writer) {
                    $writer->save('php://output');
                },
                200,
                [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'attachment; filename="export.pdf"',
                ]
            );
        }
    }

    private function autoSizeColumns($sheet, array $columns)
    {
        foreach ($columns as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    }
}
