<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Http\Request;
use App\Services\StatisticService;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('statistic');
    }

    public function index()
    {
        return view('order');
    }

    public function send()
    {
        return view('order')->with('success', 'Thank You');
    }
}
