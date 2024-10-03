<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;


class EntryStockDaily extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'tbl_trn_stockUploadDaily';
    protected $primaryKey = 'id';
    protected $fillable = [
        'supplier_id',
        'part_id',
        'date_upload',
        'qty_safetyStock',
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

        $query = DB::table('tbl_mst_part as a')
            ->select(
                'b.supplier_name',
                'a.supplier_id',
                'a.part_name',
                'a.part_number',
                DB::raw("IFNULL(X.qty_safetyStock, 'not set') as safetyStock"),
                DB::raw("COALESCE(X.date_upload, '" . $req->date_stock . "') as date_stock")
            )
            ->leftJoin('tbl_mst_supplier as b', 'b.id', '=', 'a.supplier_id')
            ->leftJoin(
                DB::raw("(select date_upload, qty_safetyStock, part_id from tbl_trn_stockUploadDaily where date_upload = '" . $req->date_stock . "') as X"),
                'X.part_id',
                '=',
                'a.id'
            );

        if (session()->get('supplier_id') == "*") {
            if ($req->supplier_id) {
                $query->where('a.supplier_id', $req->supplier_id);
            } else {
                $query->whereNotNull('a.supplier_id');
            }
        } else {
            $query->where('a.supplier_id', session()->get('supplier_id'));
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
