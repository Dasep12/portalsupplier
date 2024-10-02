<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\Users;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;



class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('users.index');
    }

    public function jsonUsers(Request $req)
    {
        $response = Users::jsonList($req);
        return response()->json($response);
    }

    public function jsonListRoles(Request $req)
    {
        $data = Roles::where('status_role', 1)->get();
        return response()->json($data);
    }

    public function jsonDetailListUserMenu(Request $req)
    {
        $response = Users::jsonDetailListUserMenu($req);
        return response()->json($response);
    }

    public function jsonCrudUser(Request $req)
    {
        $act = $req->action;
        $useraccess = json_decode($req->UserAccess, true);
        $data = [
            "username"       => $req->username,
            "password"       => $req->password,
            "email"          => $req->email,
            "phone"          => $req->phone,
            "supplier_id"    => $req->supplier_id,
            "role_id"        => $req->role_id,
            'created_by'     => 1,
            'lock_user'      => $req->lock_user != null ? 1 : 0
        ];
        switch (strtolower($act)) {
            case "create":
                $cekRoles = Users::where('username', $req->username);
                if ($cekRoles->count() > 0) {
                    return response()->json(['success' => false, 'msg' => 'Account ' . $req->username . ' Has Exist']);
                }

                Users::Create($data);
                $lastId  = DB::getPdo()->lastInsertId();
                for ($i = 0; $i < count($useraccess); $i++) {
                    DB::table('tbl_sys_menuusers')->insert([
                        'user_id'       => $lastId,
                        'accessmenu_id' => $useraccess[$i]['idRoles'],
                        'add'           => $useraccess[$i]['CanCreate'],
                        'edit'          => $useraccess[$i]['CanUpdate'],
                        'delete'        => $useraccess[$i]['CanDelete'],
                        'showAll'       => $useraccess[$i]['CanSee'],
                        'created_by'    => 1
                    ]);
                }
                break;
            case "update":
                $roles = Users::find($req->id);
                $roles->username = $req->username;
                $roles->email = $req->email;
                $roles->phone = $req->phone;
                $roles->supplier_id = $req->supplier_id;
                $roles->role_id = $req->role_id;
                $roles->lock_user = $req->lock_user != null ? 1 : 0;
                $roles->updated_by = 1;
                DB::table('tbl_sys_menuusers')->where('user_id', $req->id)->delete();
                for ($i = 0; $i < count($useraccess); $i++) {
                    DB::table('tbl_sys_menuusers')->insert([
                        'user_id'       => $req->id,
                        'accessmenu_id' => $useraccess[$i]['idRoles'],
                        'add'           => $useraccess[$i]['CanCreate'],
                        'edit'          => $useraccess[$i]['CanUpdate'],
                        'delete'        => $useraccess[$i]['CanDelete'],
                        'showAll'       => $useraccess[$i]['CanSee'],
                        'created_by'    => 1
                    ]);
                }
                $roles->save();
                break;
            case "delete":
                DB::table('tbl_sys_menuusers')->where('user_id', $req->id)->delete();
                Users::where('id', $req->id)->delete();
                break;
        }
        try {
            DB::commit();
            return response()->json(['success' => true, 'msg' => 'Successfully', 'data' => $req->username]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['success' => false, 'msg' => $ex->getMessage()]);
        }
    }
}
