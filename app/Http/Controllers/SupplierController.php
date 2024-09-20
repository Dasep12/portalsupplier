<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;
use Exception;
use GuzzleHttp\Promise\Create;

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
        }

        try {
            DB::commit();
            return response()->json(['success' => true, 'msg' => 'Successfully', 'data' => $req->supplier_name]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['success' => false, 'msg' => $ex->getMessage()]);
        }
    }
}
