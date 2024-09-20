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
        $page = $req->input('page');
        $limit = $req->input('rows');
        $sidx = $req->input('sidx', 'id');
        $sord = $req->input('sord', 'asc');
        $start = ($page - 1) * $limit;

        // Total count of records
        $qry = "SELECT COUNT(1) AS count from tbl_mst_units WHERE parent_id='*' ";
        if ($req->search) {
            $qry .= " AND name_unit LIKE '%$req->search%' ";
        }
        $countResult = DB::select($qry);
        $count = $countResult[0]->count;

        // Total pages calculation
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }

        // Fetch data using DB::raw
        $query = "SELECT *  from tbl_mst_units WHERE parent_id='*' ";
        if ($req->search) {
            $query .= " AND name_unit LIKE '%$req->search%' ";
        }
        $query .= " ORDER BY  id  DESC  LIMIT  $start , $limit ";
        $data = DB::select($query);

        // Prepare rows for jqGrid
        $rows = [];
        foreach ($data as $item) {
            $rows[] = [
                'id'                => $item->id,
                'name_unit'         => $item->name_unit,
                'code_unit'         => $item->code_unit,
                'status_unit'       => $item->status_unit,
                'unit_level'        => $item->unit_level,
                'parent_id'         => $item->parent_id,
                'remarks'           => $item->remarks,
                'created_at'        => $item->created_at,
                'created_by'        => $item->created_by,
                'updated_at'        => $item->updated_at,
                'updated_by'        => $item->updated_by,
                'cell' => [
                    $item->id,
                ] // Adjust fields as needed
            ];
        }

        $response = [
            'page' => $page,
            'total' => $total_pages,
            'records' => $count,
            'rows' => $rows
        ];
        return $response;
    }

    public static function jsonListDetail($req)
    {
        $page = $req->input('page');
        $limit = $req->input('rows');
        $sidx = $req->input('sidx', 'id');
        $sord = $req->input('sord', 'asc');
        $start = ($page - 1) * $limit;

        // Total count of records
        $qry = "SELECT COUNT(1) AS count from tbl_mst_units WHERE parent_id='$req->parent_id' ";
        if ($req->search) {
            $qry .= " AND name_unit LIKE '%$req->search%' ";
        }
        $countResult = DB::select($qry);
        $count = $countResult[0]->count;

        // Total pages calculation
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }

        // Fetch data using DB::raw
        $query = "SELECT *  from tbl_mst_units WHERE parent_id='$req->parent_id' ";
        if ($req->search) {
            $query .= " AND name_unit LIKE '%$req->search%' ";
        }
        $query .= " ORDER BY  id  DESC  LIMIT  $start , $limit ";
        $data = DB::select($query);

        // Prepare rows for jqGrid
        $rows = [];
        foreach ($data as $item) {
            $rows[] = [
                'id'                => $item->id,
                'name_unit'         => $item->name_unit,
                'code_unit'         => $item->code_unit,
                'status_unit'       => $item->status_unit,
                'unit_level'        => $item->unit_level,
                'parent_id'         => $item->parent_id,
                'remarks'           => $item->remarks,
                'created_at'        => $item->created_at,
                'created_by'        => $item->created_by,
                'updated_at'        => $item->updated_at,
                'updated_by'        => $item->updated_by,
                'cell' => [
                    $item->id,
                ] // Adjust fields as needed
            ];
        }

        $response = [
            'page' => $page,
            'total' => $total_pages,
            'records' => $count,
            'rows' => $rows
        ];
        return $response;
    }
}
