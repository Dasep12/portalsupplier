<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;


class Roles extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'tbl_mst_role';
    protected $primaryKey = 'id';
    protected $fillable = [
        'roleName',
        'code_role',
        'status_unit',
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

        $query = DB::table('vw_roles as a')
            ->select('a.*');

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

    public static function jsonDetailListMenu($req)
    {
        $page = $req->input('page'); // current page number
        $limit = $req->input('rows'); // rows per page
        $sidx = $req->input('sidx'); // sort column
        $sord = $req->input('sord'); // sort direction
        $role_id = $req->id_role;
        $query = DB::table('tbl_sys_menu as a')
            ->select('a.Menu_id', 'a.ParentMenu', 'a.MenuName', 'a.MenuLevel', 'a.MenuIcon', 'a.LevelNumber', 'X.enable_menu')
            ->leftJoin(DB::raw("(select tsr.enable_menu, tsr.menu_id from tbl_sys_roleaccessmenu tsr where tsr.role_id = '$role_id' group by tsr.menu_id, tsr.enable_menu) as X"), function ($join) {
                $join->on('X.menu_id', '=', 'a.Menu_id');
            })
            ->where('a.StatusMenu', '=', 1);


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
