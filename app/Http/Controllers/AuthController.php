<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;

class AuthController extends Controller
{
    //
    public function index()
    {
        return view("login");
    }

    public function Auth(Request $req)
    {


        $data = Users::where('username', $req->username)
            ->leftJoin('tbl_mst_role as b', 'b.id', '=', 'tbl_mst_users.role_id')
            ->select('tbl_mst_users.*', 'b.roleName')
            ->get()
            ->first();
        if ($data) {
            session()->put('user_id', $data->id);
            session()->put('fullname', $data->username);
            session()->put('role_id', $data->role_id);
            session()->put('roleName', $data->roleName);
            session()->put('supplier_id', $data->supplier_id);
            return response()->json(["msg" => "success", "text" => "login successfully", "roles" => $data->supplier_id]);
        } else {
            return response()->json(["msg" => "account not found"]);
        }
    }
}
