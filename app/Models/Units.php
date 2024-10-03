<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;


class Units extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'tbl_mst_units';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name_unit',
        'code_unit',
        'status_unit',
        'unit_level',
        'parent_id',
        'remarks',
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

        $query = DB::table('tbl_mst_units as a')
            ->where('parent_id', '*')
            ->select('a.*');

        if ($req->search) {
            $query->where('a.name_unit', 'like', '%' . $req->search . '%');
        }

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


    public static function jsonListDetail($req)
    {
        $page = $req->input('page'); // current page number
        $limit = $req->input('rows'); // rows per page
        $sidx = $req->input('sidx'); // sort column
        $sord = $req->input('sord'); // sort direction

        $query = DB::table('tbl_mst_units as a')
            ->select('a.*')
            ->where('parent_id', $req->parent_id);

        if ($req->search) {
            $query->where('a.name_unit', 'like', '%' . $req->search . '%');
        }

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
