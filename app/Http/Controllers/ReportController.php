<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\StorageMainView;
use App\Models\Expenses;
use App\Models\StorageDetail;
use App\Models\OrderDetailsView;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;


class ReportController extends Controller
{
    // Combine data retrieval for dashboard and storage
    public function DashboardReport()
    {


        // Custome Weekly report
        $today = Carbon::today();
        $startOfWeek = $today->copy()->previous(Carbon::FRIDAY); // Start on the previous Friday
        $endOfWeek = $today->copy()->next(Carbon::THURSDAY);

    // Get the current Hijri Shamsi date
        $currentShamsiDate = Jalalian::now();

        // Calculate the start and end of the current Hijri Shamsi month
        $startOfShamsiMonth = new Jalalian($currentShamsiDate->getYear(), $currentShamsiDate->getMonth(), 1);
        $endOfShamsiMonth = $startOfShamsiMonth->addMonths(1)->subDays(1);

        // Convert the start and end of the Shamsi month to Gregorian dates
        $startOfGregorianMonth = $startOfShamsiMonth->toCarbon();
        $endOfGregorianMonth = $endOfShamsiMonth->toCarbon();

        // Sales Report
        $dailysales = DB::table('tbl_order_detail')->whereDate('created_at', today())->sum('OD_Price');
        $weeklysales = DB::table('tbl_order_detail')->whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('OD_Price');
        $monthlysales = DB::table('tbl_order_detail')->whereBetween('created_at', [$startOfGregorianMonth, $endOfGregorianMonth])->sum('OD_Price');
        $totalsales = DB::table('tbl_order_detail')->sum('OD_Price');
        
        // Expenses Report
        $dailyExpenses = DB::table('tbl__expenses')->whereDate('created_at', today())->sum('E_Amount');
        $weeklyExpenses = DB::table('tbl__expenses')->whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('E_Amount');
        $monthlyExpenses = DB::table('tbl__expenses')->whereBetween('created_at', [$startOfGregorianMonth, $endOfGregorianMonth])->sum('E_Amount');
        $totalExpenses = DB::table('tbl__expenses')->sum('E_Amount');

        // Storage Report
        $dailystorage = DB::table('tbl_storage__detail')
            ->whereDate('created_at', today())
            ->where('S_status', 'In')
            ->selectRaw('SUM(S_Unit * S_Price) as total')
            ->value('total');

        $weeklystorage = DB::table('tbl_storage__detail')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->where('S_status', 'In')
            ->selectRaw('SUM(S_Unit * S_Price) as total')
            ->value('total');

        $monthlystorage = DB::table('tbl_storage__detail')
            ->whereBetween('created_at', [$startOfGregorianMonth, $endOfGregorianMonth])
            ->where('S_status', 'In')
            ->selectRaw('SUM(S_Unit * S_Price) as total')
            ->value('total');

        $totalstorage = DB::table('tbl_storage__detail')
            ->where('S_status', 'In')
            ->selectRaw('SUM(S_Unit * S_Price) as total')
            ->value('total');

        // Retrieve storage data for storage alert table
        $storage = StorageMainView::all();

        return view('Dashboard', compact(
            'dailysales', 'weeklysales', 'monthlysales', 'totalsales',
            'dailyExpenses', 'weeklyExpenses', 'monthlyExpenses', 'totalExpenses',
            'dailystorage', 'weeklystorage', 'monthlystorage', 'totalstorage',
            'storage'
        ));
    }
}
