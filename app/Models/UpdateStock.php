<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;


class UpdateStock extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'tbl_trn_stock';
    protected $primaryKey = 'id';
    protected $fillable = [
        'supplier_id',
        'part_id',
        'date_upload',
        'stock',
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
        $qry = "SELECT COUNT(1) AS count from tbl_mst_part a
                left join tbl_mst_supplier b on b.id = a.supplier_id
                left outer join (
                select  date_upload , coalesce(qty_safetyStock,0)qty_safetyStock , part_id  from tbl_trn_stockUploadDaily
                where date_upload = '" . $req->date_stock . "'
                )X on X.part_id = a.id
                WHERE a.supplier_id = '" . $req->supplier_id . "' ";
        if ($req->part_name) {
            $qry .= " AND part_name LIKE '%$req->part_name%' ";
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
        $query = "SELECT b.supplier_name , a.supplier_id , a.part_name , a.part_number , 
                IFNULL(X.qty_safetyStock,'not set') safetyStock, X.date_upload
                from tbl_mst_part a
                left join tbl_mst_supplier b on b.id = a.supplier_id
                left outer join (
                    select  date_upload , qty_safetyStock , part_id  from tbl_trn_stockUploadDaily
                    where date_upload = '" . $req->date_stock . "'
                )X on X.part_id = a.id 
                WHERE a.supplier_id = '" . $req->supplier_id . "' ";
        if ($req->part_name) {
            $qry .= " AND part_name LIKE '%$req->part_name%' ";
        }
        $data = DB::select($query);

        // Prepare rows for jqGrid
        $rows = [];
        foreach ($data as $item) {
            $rows[] = [
                'supplier_name'           => $item->supplier_name,
                'part_name'               => $item->part_name,
                'part_number'             => $item->part_number,
                'safetyStock'             => $item->safetyStock,
                'date_stock'              => $req->date_stock,
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
