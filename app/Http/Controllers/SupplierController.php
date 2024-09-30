<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;
use Exception;
use GuzzleHttp\Promise\Create;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
}
