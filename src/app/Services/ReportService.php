<?php

namespace App\Services;

use App\Charts\ReportChart;
use App\Models\Statistic;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ReportService
{
    /** @var Collection $buttonClickBuyACow */
    public Collection $buttonClickBuyACow;

    /** @var Collection $buttonClickDownload */
    public Collection $buttonClickDownload;

    /** @var Collection $pageViewCowshed */
    public Collection $pageViewCowshed;

    /** @var Collection $pageViewDocuments */
    public Collection $pageViewDocuments;

    /**
     * @return void
     */
    public function reportForPageClick(): void
    {
        $this->buttonClickDownload = DB::table('statistics')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(id) as count'))
            ->where(['source' => Statistic::SOURCE_DOCUMENT_DOWNLOAD])
            ->groupBy('date', 'source')
            ->get();

        $this->buttonClickBuyACow = DB::table('statistics')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(id) as count'))
            ->where(['source' => Statistic::SOURCE_ORDER_SEND])
            ->groupBy('date', 'source')
            ->get();
    }

    /**
     * @return void
     */
    public function reportForPageView(): void
    {
        $this->pageViewCowshed = DB::table('statistics')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(id) as count'))
            ->where(['source' => Statistic::SOURCE_ORDER_INDEX])
            ->groupBy('date', 'source')
            ->get();

        $this->pageViewDocuments = DB::table('statistics')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(id) as count'))
            ->where(['source' => Statistic::SOURCE_DOCUMENT_INDEX])
            ->groupBy('date', 'source')
            ->get();
    }

    public function getReportTableBySource(array $sources): Collection
    {
        $statistics = DB::table('statistics')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(id) as count'), 'source');

        foreach ($sources as $value) {
            $statistics->where('source', '=', $value, 'or');
        }

        $statistics->groupBy('date', 'source');

        return $statistics->get();
    }

    public function prepareData(Collection $statistics)
    {
        $sources = [
            'date' => null,
            Statistic::SOURCE_ORDER_INDEX => 0,
            Statistic::SOURCE_DOCUMENT_INDEX => 0,
            Statistic::SOURCE_DOCUMENT_DOWNLOAD => 0,
            Statistic::SOURCE_ORDER_SEND => 0,
        ];

        $result = [];

        foreach ($statistics as $value) {
            if (!isset($result[$value->date])) {
                $result[$value->date] = $sources;
                $result[$value->date]['date'] = $value->date;
            }
            $result[$value->date][$value->source] = $value->count;
        }

        return array_values($result);
    }

    public function chartForClickDownload(): ReportChart
    {
        $chartClickDownload = new ReportChart();
        if (!isset($this->buttonClickDownload[0])) {
            $chartClickDownload->labels(['Button Click Download']);
            $chartClickDownload->dataset(
                'Empty data',
                'bar',
                [
                    0
                ]
            );
        } else {
            foreach ($this->buttonClickDownload as $item) {
                $chartClickDownload->labels(['Button Click Download']);
                $chartClickDownload->dataset(
                    $item->date,
                    'bar',
                    [
                        $item->count,
                    ]
                );
            }
        }

        return $chartClickDownload;
    }

    public function chartForClickBuy(): ReportChart
    {
        $chartClickBuy = new ReportChart();

        if (!isset($this->buttonClickBuyACow[0])) {
            $chartClickBuy->labels(['Button Click Buy']);
            $chartClickBuy->dataset(
                'Empty data',
                'bar',
                [
                    0
                ]
            );
        } else {
            foreach ($this->buttonClickBuyACow as $item) {
                $chartClickBuy->labels(['Button Click Buy']);
                $chartClickBuy->dataset(
                    $item->date,
                    'bar',
                    [
                        $item->count,
                    ]
                );
            }
        }

        return $chartClickBuy;
    }

    public function chartForViewDocuments(): ReportChart
    {
        $chartViewDocuments = new ReportChart();

        if (!isset($this->pageViewDocuments[0])) {
            $chartViewDocuments->labels(['Button Click Buy']);
            $chartViewDocuments->dataset(
                'Empty data',
                'bar',
                [
                    0
                ]
            );
        } else {
            foreach ($this->pageViewDocuments as $item) {
                $chartViewDocuments->labels(['Page Documents']);
                $chartViewDocuments->dataset(
                    $item->date,
                    'bar',
                    [
                        $item->count,
                    ]
                );
            }
        }

        return $chartViewDocuments;
    }

    public function chartForViewCowshed(): ReportChart
    {
        $chartViewCowshed = new ReportChart();
        if (!isset($this->pageViewCowshed[0])) {
            $chartViewCowshed->labels(['Page Cowshed']);
            $chartViewCowshed->dataset(
                'Empty data',
                'bar',
                [
                    0
                ]
            );
        } else {
            foreach ($this->pageViewCowshed as $item) {
                $chartViewCowshed->labels(['Page Cowshed']);
                $chartViewCowshed->dataset(
                    $item->date,
                    'bar',
                    [
                        $item->count,
                    ]
                );
            }
        }

        return $chartViewCowshed;
    }
}
