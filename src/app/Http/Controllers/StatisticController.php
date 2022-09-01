<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        $statistic = new Statistic();

        return view('statistic', ['data' => $statistic->all()]);
    }

    public function filter(Request $request)
    {
        $originalFields = Statistic::attributesForFilter();
        $filters = array_keys($request->all());

        $data = Statistic::where(static function ($query) use ($filters, $request, $originalFields) {
            foreach ($filters as $field) {
                if ((in_array($field, $originalFields, true) === true) && $request->input($field) !== null) {
                    $query->where($field, $request->input($field));
                }
            }
        })->get();

        return view('statistic', ['data' => $data]);
    }
}
