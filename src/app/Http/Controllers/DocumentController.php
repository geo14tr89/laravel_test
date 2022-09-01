<?php

namespace App\Http\Controllers;


use App\Services\StatisticService;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        (new StatisticService($request))->addStatistics();

        return view('document');
    }

    public function download(Request $request)
    {
        (new StatisticService($request))->addStatistics();

        return response()->download(public_path('files/test.xls'));
    }
}
