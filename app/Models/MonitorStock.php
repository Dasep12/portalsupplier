<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;


class MonitorStock extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     */
    protected $table = '';
    protected $primaryKey = '';
    protected $fillable = [];

    public static function jsonList($req)
    {

        $page = $req->input('page'); // current page number
        $limit = $req->input('rows'); // rows per page
        $sidx = $req->input('sidx'); // sort column
        $sord = $req->input('sord'); // sort direction

        $query = DB::table('vw_monitorstock as a')
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
}
