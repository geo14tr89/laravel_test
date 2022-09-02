<?php

namespace App\Http\Controllers;


use App\Services\StatisticService;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('statistic');
    }

    public function index()
    {
        return view('document');
    }

    public function download()
    {
        return response()->download(public_path('files/test.xls'));
    }
}
