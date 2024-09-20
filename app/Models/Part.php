<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;


class Part extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'tbl_mst_part';
    protected $primaryKey = 'id';
    protected $fillable = [
        'supplier_id',
        'category_id',
        'model',
        'uniq',
        'part_number',
        'part_name',
        'unit_id',
        'units_id',
        'qtyPerUnit',
        'volumePerDays',
        'qtySafety',
        'remarks',
        'safetyForDays',
        'forecast',
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
        $qry = "SELECT COUNT(1) AS count from vw_part";
        if ($req->search) {
            $qry .= " WHERE part_name LIKE '%$req->search%' ";
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
        $query = "SELECT *  from vw_part ";
        if ($req->search) {
            $query .= " WHERE part_name LIKE '%$req->search%' ";
        }
        $query .= " ORDER BY  id  DESC  LIMIT  $start , $limit ";
        $data = DB::select($query);

        // Prepare rows for jqGrid
        $rows = [];
        foreach ($data as $item) {
            $rows[] = [
                'id'                => $item->id,
                'supplier_id'       => $item->supplier_id,
                'category_id'       => $item->category_id,
                'model'             => $item->model,
                'uniq'              => $item->uniq,
                'forecast'          => $item->forecast,
                'remarks'           => $item->remarks,
                'part_number'       => $item->part_number,
                'part_name'         => $item->part_name,
                'unit_id'           => $item->unit_id,
                'units_id'          => $item->units_id,
                'qtyPerUnit'        => $item->qtyPerUnit,
                'volumePerDays'     => $item->volumePerDays,
                'qtySafety'         => $item->qtySafety,
                'safetyForDays'     => $item->safetyForDays,
                'status_part'       => $item->status_part,
                'supplier_name'     => $item->supplier_name,
                'name_category'     => $item->name_category,
                'units_code'        => $item->code_units,
                'unit_code'         => $item->code_unit,
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
            'page'      => $page,
            'total'     => $total_pages,
            'records'   => $count,
            'rows'      => $rows
        ];
        return $response;
    }
}
