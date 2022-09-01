<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Http\Request;
use App\Services\StatisticService;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        (new StatisticService($request))->addStatistics();

        return view('order');
    }

    public function send(Request $request)
    {
        (new StatisticService($request))->addStatistics();

        return view('order')->with('success', 'Thank You');
    }
}
