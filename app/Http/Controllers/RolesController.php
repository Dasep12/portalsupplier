<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('roles.index');
    }

    public function jsonRole(Request $req)
    {
        $response = Roles::jsonList($req);
        return response()->json($response);
    }
    public function jsonDetailListMenu(Request $req)
    {
        $response = Roles::jsonDetailListMenu($req);
        return response()->json($response);
    }

    public function jsonCrudRoles(Request $req)
    {
        $act = $req->action;
        $selectedMenu = json_decode($req->selectedMenu);
        $data = [
            "roleName"       => $req->roleName,
            "code_role"      => $req->code_role,
            'created_by'     => 1,
            'status_role'    => $req->status_role != null ? 1 : 0
        ];
        switch (strtolower($act)) {
            case "create":
                $cekRoles = Roles::where('code_role', $req->code_role);
                if ($cekRoles->count() > 0) {
                    return response()->json(['success' => false, 'msg' => 'Role Id ' . $req->code_role . ' Has Exist']);
                }

                Roles::Create($data);
                $lastId  = DB::getPdo()->lastInsertId();
                for ($i = 0; $i < count($selectedMenu->menuItems); $i++) {
                    DB::table('tbl_sys_roleaccessmenu')->insert([
                        'role_id' => $lastId,
                        'menu_id' => $selectedMenu->menuItems[$i],
                        'enable_menu' => 1,
                        'created_by'    => 1
                    ]);
                }
                break;
            case "update":
                $roles = Roles::find($req->id);
                $roles->code_role = $req->code_role;
                $roles->roleName = $req->roleName;
                $roles->status_role = $req->status_role != null ? 1 : 0;
                $roles->updated_by = 1;

                $existingMenus = DB::table('tbl_sys_roleaccessmenu')
                    ->where('role_id', $req->id)
                    ->pluck('menu_id') // Get existing menu IDs for the role
                    ->toArray();
                $newMenuItems = $selectedMenu->menuItems;
                // Update or Insert new menu items
                foreach ($newMenuItems as $menuId) {
                    if (in_array($menuId, $existingMenus)) {
                        // Update existing menu item
                        DB::table('tbl_sys_roleaccessmenu')
                            ->where('role_id', $req->id)
                            ->where('menu_id', $menuId)
                            ->update([
                                'enable_menu' => 1,
                                'updated_by' => 1, // Assuming you have an updated_by column
                                'updated_at' => now(), // Assuming you have a timestamp column for updates
                            ]);
                    } else {
                        // Insert new menu item
                        DB::table('tbl_sys_roleaccessmenu')->insert([
                            'role_id' => $req->id,
                            'menu_id' => $menuId,
                            'enable_menu' => 1,
                            'created_by' => 1,
                        ]);
                    }
                }

                // Delete menu items that are no longer present
                foreach ($existingMenus as $existingMenu) {
                    if (!in_array($existingMenu, $newMenuItems)) {
                        DB::table('tbl_sys_roleaccessmenu')
                            ->where('role_id', $req->id)
                            ->where('menu_id', $existingMenu)
                            ->delete();
                    }
                }
                $roles->save();
                break;
            case "delete":
                DB::table('tbl_sys_roleaccessmenu')->where('role_id', $req->id)->delete();
                Roles::where('id', $req->id)->delete();
                break;
        }
        try {
            DB::commit();
            return response()->json(['success' => true, 'msg' => 'Successfully', 'data' => $req->roleName]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['success' => false, 'msg' => $ex->getMessage()]);
        }
    }
}
