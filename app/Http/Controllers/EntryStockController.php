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
                $suppName = Supplier::where('supplier_name', $row['A'])->count();
                if ($suppName <= 0) {
                    array_push($error, ['Supplier ' . $row['A'] . ' not found']);
                }

                // cek part number 
                $partNumber = Part::where('part_number', $row['B'])->count();
                if ($partNumber <= 0) {
                    array_push($error, ['Part Number ' . $row['B'] . ' not found']);
                }

                // cek part name 
                $partName = Part::where('part_name', $row['C'])->count();
                if ($partName <= 0) {
                    array_push($error, ['Part Name ' . $row['C'] . ' not found']);
                }


                $res = [
                    'date_upload'     => date('d M Y'),
                    'supplier_name'   => $row['A'],
                    'part_number'     => $row['B'],
                    'part_name'       => $row['C'],
                    'qty_safety'      => $row['D'],
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



    public function downloadtemplate(Request $req) {}
}
