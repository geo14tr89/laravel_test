<?php

namespace App\Http\Controllers;

use App\Charts\ReportChart;
use App\Models\Statistic;
use App\Services\ReportService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ReportController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function showChart()
    {
        $reportService = new ReportService();

        $reportService->reportForPageClick();
        $reportService->reportForPageView();

        $chartClickDownload = $reportService->chartForClickDownload();
        $chartClickBuy = $reportService->chartForClickBuy();
        $chartViewDocuments = $reportService->chartForViewDocuments();
        $chartViewCowshed = $reportService->chartForViewCowshed();

        return view(
            'report-chart',
            [
                'chartClickDownload' => $chartClickDownload,
                'chartClickBuy' => $chartClickBuy,
                'chartViewDocuments' => $chartViewDocuments,
                'chartViewCowshed' => $chartViewCowshed,
            ]
        );
    }

    public function index()
    {
        return view('report-index');
    }

    public function showTable()
    {
        $reportService = new ReportService();

        $sources = [
            Statistic::SOURCE_ORDER_INDEX,
            Statistic::SOURCE_ORDER_SEND,
            Statistic::SOURCE_DOCUMENT_DOWNLOAD,
            Statistic::SOURCE_DOCUMENT_INDEX,
        ];
        $statistic = $reportService->getReportTableBySource($sources);
        $data = $reportService->prepareData($statistic);

        return view('report-table', ['data' => $data]);
    }
}
