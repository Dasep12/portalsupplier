<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Part;
use App\Models\Supplier;
use App\Models\Units;
use Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;

class PartController extends Controller
{
    //
    public function index()
    {
        return view("part.index");
    }

    public function jsonPartList(Request $req)
    {
        $data = Part::jsonList($req);
        return response()->json($data);
    }



    public function jsonCrudPart(Request $req)
    {
        $act = $req->CrudActionPart;
        $data = [
            "supplier_id"       => $req->supplier_id,
            "category_id"       => $req->category_id,
            'model'             => $req->model,
            'uniq'              => $req->uniq,
            'part_number'       => $req->part_number,
            'part_name'         => $req->part_name,
            'unit_id'           => $req->unit_id,
            'units_id'          => $req->units_id,
            'qtyPerUnit'        => $req->qtyPerUnit,
            'volumePerDays'     => $req->volumePerDays,
            'qtySafety'         => $req->qtySafety,
            'safetyForDays'     => $req->safetyForDays,
            'remarks'           => $req->remarks,
            'forecast'          => $req->forecast,
            "status_part"       => isset($req->status_part) ? 1 : 0,
            'created_by'        => 1
        ];
        switch (strtolower($act)) {
            case "create":
                $cek = Part::where('uniq', $req->uniq);
                if ($cek->count() > 0) {
                    return response()->json(['success' => false, 'msg' => 'Uniq ' . $req->uniq . ' Has Been Existing']);
                }
                Part::Create($data);
                break;
            case "update":
                $supp = Part::find($req->id);
                $supp->supplier_id   = $req->supplier_id;
                $supp->category_id   = $req->category_id;
                $supp->model         = $req->model;
                $supp->uniq          = $req->uniq;
                $supp->part_number   = $req->part_number;
                $supp->part_name     = $req->part_name;
                $supp->unit_id       = $req->unit_id;
                $supp->units_id      = $req->units_id;
                $supp->qtyPerUnit    = $req->qtyPerUnit;
                $supp->qtySafety     = $req->qtySafety;
                $supp->volumePerDays = $req->volumePerDays;
                $supp->safetyForDays = $req->safetyForDays;
                $supp->remarks       = $req->remarks;
                $supp->forecast       = $req->forecast;
                $supp->status_part   = isset($req->status_part) ? 1 : 0;
                $supp->save();
                break;
            case "delete":
                Part::where('id', $req->id)->delete();
                break;
        }
        try {
            DB::commit();
            return response()->json(['success' => true, 'msg' => 'Successfully', 'data' => $req->part_name]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['success' => false, 'msg' => $ex->getMessage()]);
        }
    }

    public function jsonMultiDeletePart(Request $req)
    {
        DB::beginTransaction();
        try {
            $stock = DB::table('tbl_trn_stock')->whereIn('part_id', $req->id);
            if ($stock->count() > 0) {
                return response()->json(['msg' => 'not sucess,part has been transaction']);
            } else {
                DB::table('tbl_mst_part')->whereIn('id', $req->id)->delete();
                DB::commit();
                return response()->json(['success' => true, 'msg' => 'Berhasil Delete']);
            }
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function jsonListSupplier(Request $req)
    {
        $data = Supplier::where('status_supplier', 1)->get();
        return response()->json($data);
    }

    public function jsonListCategory(Request $req)
    {
        $data = Category::where('status_category', 1)->get();
        return response()->json($data);
    }

    public function jsonListPackage(Request $req)
    {
        $data = Units::where(['status_unit' => 1, 'parent_id' => '*'])->get();
        return response()->json($data);
    }

    public function jsonListUnits(Request $req)
    {
        $data = Units::where(['status_unit' => 1, 'parent_id' => $req->parent_id])->get();
        return response()->json($data);
    }


    // Handle the file upload and data extraction
    public function loadPart(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xls,xlsx',
        ]);

        $file = $request->file('excel_file');
        $spreadsheet = IOFactory::load($file->getPathname());

        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        unset($sheetData[0]);
        unset($sheetData[1]);
        unset($sheetData[2]);

        // Check if validation passed (file is Excel)
        if ($file->getClientOriginalExtension() !== 'xls' && $file->getClientOriginalExtension() !== 'xlsx') {
            return back()->withErrors(['success' => false, 'msg' => 'The uploaded file must be an Excel file (.xls or .xlsx).']);
        }

        $data = [];
        $error = [];
        foreach ($sheetData as $s) {


            // cek supplier name 
            $suppName = Supplier::where('supplier_name', $s['A'])->count();
            if ($suppName <= 0) {
                array_push($error, ['Supplier ' . $s['A'] . ' not found']);
            }

            // cek package 
            $package = Units::where('name_unit', $s['F'])->count();
            if ($package <= 0) {
                array_push($error, ['Package ' . $s['F'] . ' not found']);
            }

            // cek unit 
            $unit = Units::where('code_unit', $s['G'])->count();
            if ($unit <= 0) {
                array_push($error, ['Unit ' . $s['G'] . ' not found']);
            }

            // cek uniq code 
            $partUniq = Part::where('uniq', $s['C'])->count();
            if ($partUniq > 0) {
                array_push($error, ['Uniq ' . $s['C'] . ' has been existing']);
            }

            // cek part number 
            $partNumber = Part::where('part_number', $s['D'])->count();
            if ($partNumber > 0) {
                array_push($error, ['Part Number ' . $s['D'] . ' has been existing']);
            }

            // cek category name 
            $categName = Category::where('name_category', $s['M'])->count();
            if ($categName <= 0) {
                array_push($error, ['Category ' . $s['M'] . ' not found']);
            }
            $res = [
                'supplier_name' => $s['A'],
                'model'         => $s['B'],
                'uniq'          => $s['C'],
                'part_number'   => $s['D'],
                'part_name'     => $s['E'],
                'unit_code'     => $s['F'],
                'units_code'    => $s['G'],
                'qtyPerUnit'    => $s['H'],
                'forecast'      => $s['I'],
                'volumePerDays' => $s['J'],
                'qtySafety'     => $s['K'],
                'safetyForDays' => $s['L'],
                'name_category' => $s['M'],
                'remarks'       => $s['N'],
            ];
            array_push($data, $res);
        }
        // Send the data to the view (or return it via JSON)
        return response()->json(['success' => true, 'data' => $data, 'error' => $error]);
    }


    public function uploadPart(Request $req)
    {
        $sendData = $req->allData;
        $data = [];
        foreach ($sendData as $s) {

            // cek category name 
            $categ = Category::where('name_category', $s['name_category'])->get()->first();
            // cek unit 
            $unit = Units::where('code_unit', $s['units_code'])->get()->first();
            // cek package 
            $package = Units::where('name_unit', $s['unit_code'])->get()->first();
            // cek supplier name 
            $supplier = Supplier::where('supplier_name', $s['supplier_name'])->get()->first();
            $par = [
                'supplier_id'   => $supplier->id,
                'category_id'   => $categ->id,
                'unit_id'       => $package->id,
                'units_id'      => $unit->id,
                'model'         => $s['model'],
                'uniq'          => $s['uniq'],
                'part_number'   => $s['part_number'],
                'part_name'     => $s['part_name'],
                'qtyPerUnit'    => $s['qtyPerUnit'] == null ? 0 : $s['qtyPerUnit'],
                'volumePerDays' => $s['volumePerDays'],
                'qtySafety'     => $s['qtySafety'],
                'remarks'       => $s['remarks'],
                'safetyForDays' => $s['safetyForDays'],
                'forecast'      => $s['forecast'],
                'created_at'    => date('Y-m-d H:i:s'),
                'created_by'    => 1
            ];
            array_push($data, $par);
        }

        DB::beginTransaction();
        DB::table('tbl_mst_part')->insert($data);
        try {
            DB::commit();
            return response()->json(['success' => true, 'msg' => 'success upload', 'data' => 'part uploaded']);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function exportPart(Request $req)
    {

        $data = DB::table('vw_part')
            ->select('*')
            ->get();
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        // Set some data in the spreadsheet
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Supplier Name');
        $sheet->setCellValue('C1', 'Model');
        $sheet->setCellValue('D1', 'Uniq');
        $sheet->setCellValue('E1', 'Part Number');
        $sheet->setCellValue('F1', 'Part Name');
        $sheet->setCellValue('G1', 'Unit');
        $sheet->setCellValue('H1', 'Qty/Unit');
        $sheet->setCellValue('I1', 'Volume/Days');
        $sheet->setCellValue('J1', 'Category');
        $sheet->setCellValue('K1', 'Remarks');

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
        $sheet->getStyle('A1:K1')->applyFromArray([
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
        $this->autoSizeColumns($sheet, range('A', 'K'));

        $start = 2;
        $no = 1;

        if (count($data) > 0) {
            foreach ($data as $d) {
                $sheet->setCellValue('A' . $start, $no++);
                $sheet->setCellValue('B' . $start, $d->supplier_name);
                $sheet->setCellValue('C' . $start, $d->model);
                $sheet->setCellValue('D' . $start, ucwords(strtoupper($d->uniq)));
                $sheet->setCellValue('E' . $start, ucwords(strtoupper($d->part_number)));
                $sheet->setCellValue('F' . $start, ucwords(strtoupper($d->part_name)));
                $sheet->setCellValue('G' . $start, ucwords(strtoupper($d->code_units)));
                $sheet->setCellValue('H' . $start, ucwords(strtoupper($d->qtyPerUnit)));
                $sheet->setCellValue('I' . $start, ucwords(strtoupper($d->volumePerDays)));
                $sheet->setCellValue('J' . $start, ucwords(strtoupper($d->name_category)));
                $sheet->setCellValue('K' . $start, ucwords(strtoupper($d->remarks)));
                $start++;
            }
        } else {
            $sheet->setCellValue('A' . $start, "data not found");
            $sheet->mergeCells('A' . $start . ':K' . $start + 1);
        }

        $sheet->getStyle('A1:K' . $start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:K' . $start)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A1:K' . $start - 1)->applyFromArray($styleArray);
        $sheet->getStyle('A1:K' . $start)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


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
