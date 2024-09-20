<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;


class CategoryController extends Controller
{
    //
    public function index()
    {
        return view("category.index");
    }

    public function jsonCategoryList(Request $req)
    {
        $data = Category::jsonList($req);
        return response()->json($data);
    }

    public function jsonCrudCategory(Request $req)
    {
        $act = $req->CrudActionCategory;
        $data = [
            "name_category" => $req->name_category,
            "remarks" => $req->remarks,
            "status_category" => isset($req->status_category) ? 1 : 0,
        ];
        switch (strtolower($act)) {
            case "create":
                $cek = Category::where('name_category', $req->name_category);
                if ($cek->count() > 0) {
                    return response()->json(['success' => false, 'msg' => 'Name Category ' . $req->name_category . ' Has Been Existing']);
                }
                Category::Create($data);
                break;
            case "update":
                $supp = Category::find($req->id);
                $supp->name_category = $req->name_category;
                $supp->remarks = $req->remarks;
                $supp->status_category = isset($req->status_category) ? 1 : 0;
                $supp->save();
                break;
            case "delete":
                Category::where('id', $req->id)->delete();
                break;
        }

        try {
            DB::commit();
            return response()->json(['success' => true, 'msg' => 'Successfully', 'data' => $req->name_category]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['success' => false, 'msg' => $ex->getMessage()]);
        }
    }
}
