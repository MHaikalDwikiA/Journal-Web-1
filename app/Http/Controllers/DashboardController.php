<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $selectedDate = request()->input('selected_month');
        $selectedYear = Carbon::now()->year;

        if (strlen($selectedDate) === 7) {
            $selectedYear = substr($selectedDate, 0, 4);
            $selectedMonth = substr($selectedDate, 5, 2);
        } else {
            $selectedMonth = Carbon::now()->format('m');
            $selectedYear = Carbon::now()->format('Y');
        }

        $dailyCounts = DB::table('internship_journals')
            ->selectRaw('DATE_FORMAT(date, "%d %M %Y") AS day, COUNT(*) AS count')
            ->whereMonth('date', $selectedMonth)
            ->whereYear('date', $selectedYear)
            ->groupBy('day')
            ->get();

        $chartData = [
            'labels' => $dailyCounts->pluck('day')->all(),
            'counts' => $dailyCounts->pluck('count')->all(),
        ];

        return view('dashboard', compact('chartData', 'selectedDate', 'selectedMonth', 'selectedYear'));
    }
}
