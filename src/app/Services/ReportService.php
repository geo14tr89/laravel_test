<?php

namespace App\Services;

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
}
