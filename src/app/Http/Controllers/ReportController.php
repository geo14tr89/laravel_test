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

        $chartClickDownload = new ReportChart();
        foreach ($reportService->buttonClickDownload as $item) {
            $chartClickDownload->labels(['Button Click Download']);
            $chartClickDownload->dataset(
                $item->date,
                'bar',
                [
                    $item->count,
                ]
            );
        }

        $chartClickBuy = new ReportChart();
        foreach ($reportService->buttonClickBuyACow as $item) {
            $chartClickBuy->labels(['Button Click Buy']);
            $chartClickBuy->dataset(
                $item->date,
                'bar',
                [
                    $item->count,
                ]
            );
        }

        $chartViewDocuments = new ReportChart();
        foreach ($reportService->pageViewDocuments as $item) {
            $chartViewDocuments->labels(['Page Documents']);
            $chartViewDocuments->dataset(
                $item->date,
                'bar',
                [
                    $item->count,
                ]
            );
        }

        $chartViewCowshed = new ReportChart();
        foreach ($reportService->pageViewCowshed as $item) {
            $chartViewCowshed->labels(['Page Cowshed']);
            $chartViewCowshed->dataset(
                $item->date,
                'bar',
                [
                    $item->count,
                ]
            );
        }

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
