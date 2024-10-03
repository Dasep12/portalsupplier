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
        $page = $req->input('page'); // current page number
        $limit = $req->input('rows'); // rows per page
        $sidx = $req->input('sidx'); // sort column
        $sord = $req->input('sord'); // sort direction

        $query = DB::table('vw_part as a')
            ->select('a.*');

        if ($req->search) {
            $query->where('a.supplier_name', 'like', '%' . $req->search . '%');
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
