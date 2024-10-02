<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;


class Users extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'tbl_mst_users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'username',
        'password',
        'email',
        'phone',
        'lock_user',
        'profile',
        'supplier_id',
        'role_id',
        'created_at',
        'created_by',
        'updated_by',
        'updated_at',
    ];
    public static function jsonList($req)
    {
        $page = $req->input('page'); // current page number
        $limit = $req->input('rows'); // rows per page
        $sidx = $req->input('sidx'); // sort column
        $sord = $req->input('sord'); // sort direction

        $query = DB::table('tbl_mst_users as a')
            ->leftJoin('tbl_mst_role as b', 'b.id', '=', 'a.role_id')
            ->select('a.*', 'b.roleName');

        $count = $query->count();
        $query->orderByDesc('a.id');

        $data = $query->skip(($page - 1) * $limit)
            ->take($limit)
            ->get();

        $totalPages = ($count > 0) ? ceil($count / $limit) : 0;

        $response = [
            'page'      => $page,
            'total'     => $totalPages,
            'records'   => $count,
            'rows'      => $data->toArray(),
        ];

        return $response;
    }

    public static function jsonDetailListUserMenu($req)
    {
        $page = $req->input('page'); // current page number
        $limit = $req->input('rows'); // rows per page
        $sidx = $req->input('sidx'); // sort column
        $sord = $req->input('sord'); // sort direction
        $role_id = $req->role_id;
        $user_id = $req->user_id;
        $query = DB::table('tbl_sys_menu as a')
            ->select(
                'X.id as id_accessMenu',
                'a.Menu_id',
                'a.MenuName',
                'a.MenuIcon',
                'a.MenuLevel',
                'a.LevelNumber',
                DB::raw('IFNULL(X.enable_menu, 0) as enable_menu'),
                DB::raw('IFNULL(Y.add, 0) as CanCreate'),
                DB::raw('IFNULL(Y.edit, 0) as CanUpdate'),
                DB::raw('IFNULL(Y.delete, 0) as CanDelete'),
                DB::raw('IFNULL(Y.showAll, 0) as CanSee'),
            )
            ->leftJoin(DB::raw('(SELECT tsr.id, tsr.menu_id, tsr.enable_menu 
                             FROM tbl_sys_roleaccessmenu tsr 
                             WHERE tsr.role_id = "' . $role_id . '") as X'), 'a.Menu_id', '=', 'X.menu_id')
            ->leftJoin(DB::raw('(SELECT tsa.accessmenu_id, tsa.add, tsa.edit, tsa.delete,tsa.showAll 
                             FROM tbl_sys_menuusers tsa 
                             WHERE tsa.user_id = "' . $user_id . '") as Y'), 'Y.accessmenu_id', '=', 'X.id')
            ->where('a.StatusMenu', 1);


        $count = $query->count();

        $data = $query->skip(($page - 1) * $limit)
            ->take($limit)
            ->get();

        $totalPages = ($count > 0) ? ceil($count / $limit) : 0;

        $response = [
            'page'      => $page,
            'total'     => $totalPages,
            'records'   => $count,
            'rows'      => $data->toArray(),
        ];

        return $response;
    }
}
