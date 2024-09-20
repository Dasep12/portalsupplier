<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Units;
use Exception;


class UnitsController extends Controller
{
    //
    public function index()
    {
        return view("units.index");
    }

    public function jsonParent(Request $req)
    {
        return response()->json(Units::where('parent_id', '*')->get());
    }


    public function jsonUnitsList(Request $req)
    {
        $data = Units::jsonList($req);
        return response()->json($data);
    }

    public function jsonUnitsListDetail(Request $req)
    {
        $data = Units::jsonListDetail($req);
        return response()->json($data);
    }

    public function jsonCrudUnits(Request $req)
    {
        $act = $req->CrudActionUnit;
        $data = [
            "parent_id" => $req->parent_id,
            "unit_level" => $req->unit_level,
            "name_unit" => $req->name_unit,
            "code_unit" => $req->code_unit,
            "remarks" => $req->remarks,
            "status_unit" => isset($req->status_unit) ? 1 : 0,
        ];
        switch (strtolower($act)) {
            case "create":
                $cek = Units::where('code_unit', $req->code_unit);
                if ($cek->count() > 0) {
                    return response()->json(['success' => false, 'msg' => 'Code Unit Has Been Existing']);
                }
                Units::Create($data);
                break;
            case "update":
                $supp = Units::find($req->id);
                $supp->parent_id = $req->parent_id;
                $supp->unit_level = $req->unit_level;
                $supp->name_unit = $req->name_unit;
                $supp->code_unit = $req->code_unit;
                $supp->remarks = $req->remarks;
                $supp->status_unit = isset($req->status_unit) ? 1 : 0;
                $supp->save();
                break;
            case "delete":
                Units::where('id', $req->id)->delete();
                break;
        }

        try {
            DB::commit();
            return response()->json(['success' => true, 'msg' => 'Successfully', 'data' => $req->name_unit]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['success' => false, 'msg' => $ex->getMessage()]);
        }
    }
}
