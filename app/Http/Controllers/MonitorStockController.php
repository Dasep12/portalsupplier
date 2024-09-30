<?php

namespace App\Http\Controllers;

use App\Models\MonitorStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonitorStockController extends Controller
{
    //
    public function index()
    {

        return view("monitor_stock.index");
    }

    public function jsonMonitorList(Request $req)
    {
        $data = MonitorStock::jsonList($req);
        return response()->json($data);
    }
}
