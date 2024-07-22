<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use app\Models\StorageMainView;
use app\Models\Expenses;
use app\Models\StorageDetail;
use app\Models\OrderDetailsView;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Displaying storage data in Dashboard 
    // public function dashboard()
    // {
    //     $storage = StorageMainView::all(); // Retrieve all  from the database
    //     return view('dashboard', compact('storage')); // Pass the to the view
    // }

    public function DashboardReport(){

        // Retrieve All data from Storage main view 
        // $storage = StorageMainView::all(); // Retrieve all  from the database

        // Sales Report
        $dailysales = DB::table('tbl_order_detail')->whereDate('created_at', today())->sum('OD_Price');
        $weeklysales = DB::table('tbl_order_detail')->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('OD_Price');
        $monthlysales = DB::table('tbl_order_detail')->whereMonth('created_at', now()->month)->sum('OD_Price');
        $totalsales = DB::table('tbl_order_detail')->sum('OD_Price');
        
        //Expences Report
        $dailyExpenses = DB::table('tbl__expenses')->whereDate('created_at', today())->sum('E_Amount');
        $weeklyExpenses = DB::table('tbl__expenses')->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('E_Amount');
        $monthlyExpenses = DB::table('tbl__expenses')->whereMonth('created_at', now()->month)->sum('E_Amount');
        $totalExpenses = DB::table('tbl__expenses')->sum('E_Amount');

        //Storage Report
        $dailystorage = DB::table('tbl_storage__detail')
        ->whereDate('created_at', today())
        ->where('S_status', 'In')
        ->selectRaw('SUM(S_Unit * S_Price) as total')
        ->value('total');

        $weeklystorage = DB::table('tbl_storage__detail')
        ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
        ->where('S_status', 'In')
        ->selectRaw('SUM(S_Unit * S_Price) as total')
        ->value('total');

        $monthlystorage = DB::table('tbl_storage__detail')
        ->whereMonth('created_at', now()->month)
        ->where('S_status', 'In')
        ->selectRaw('SUM(S_Unit * S_Price) as total')
        ->value('total');

        $totalstorage = DB::table('tbl_storage__detail')
        ->where('S_status', 'In')
        ->selectRaw('SUM(S_Unit * S_Price) as total')
        ->value('total');

        return view('Dashboard', compact(
        // Orders
        'dailysales', 'weeklysales', 'monthlysales','totalsales',
        'dailyExpenses', 'weeklyExpenses', 'monthlyExpenses','totalExpenses',
        'dailystorage', 'weeklystorage', 'monthlystorage','totalstorage'

        ));
    }
}
