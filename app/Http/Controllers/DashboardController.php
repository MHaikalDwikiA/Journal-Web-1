<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $dailyCounts = DB::table('internship_journals')
            ->select(DB::raw('DATE(date) AS day'), DB::raw('COUNT(*) AS count'))
            ->groupBy('day')
            ->get();

        $chartData = [
            'labels' => [],
            'counts' => [],
        ];

        foreach ($dailyCounts as $dailyCount) {
            $chartData['labels'][] = $dailyCount->day;
            $chartData['counts'][] = $dailyCount->count;
        }

        return view('dashboard', compact('chartData'));
    }
}
