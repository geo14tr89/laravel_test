<?php

namespace App\Services;


use App\Models\Statistic;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticService
{
    public const AVAILABLE_SOURCES = [
        Statistic::SOURCE_ORDER_INDEX,
        Statistic::SOURCE_DOCUMENT_INDEX,
        Statistic::SOURCE_ORDER_SEND,
        Statistic::SOURCE_DOCUMENT_DOWNLOAD,
        Statistic::SOURCE_USER_LOGIN,
        Statistic::SOURCE_USER_LOGOUT,
        Statistic::SOURCE_USER_REGISTER,
    ];

    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function addStatistics(): void
    {
        if ($this->checkSource()) {
            $statistic = new Statistic();
            $statistic->user_id = Auth::user()->id;
            $statistic->source = $this->request->getRequestUri();
            $statistic->method = $this->request->getMethod();
            $statistic->count = 1;
            if ($statistic->save() === false) {
                throw new Exception('Error per saving Statistic');
            }
        }
    }

    /**
     * @return bool
     */
    public function checkSource(): bool
    {
        return $this->strposArray($this->request->getUri(),self::AVAILABLE_SOURCES);
    }

    private function strposArray(string $haystack, array $needles, int $offset = 0): bool
    {
        foreach ($needles as $needle) {
            if (strpos($haystack, $needle, $offset) !== false) {
                return true;
            }
        }

        return false;
    }
}
