<?php

namespace App\Http\Middleware;

use App\Services\StatisticService;
use Closure;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StatisticMiddleware
{
    /** @var StatisticService $statisticService */
    protected StatisticService $statisticService;

    public function __construct(StatisticService $statisticService)
    {
        $this->statisticService = $statisticService;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response|RedirectResponse
     * @throws Exception
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $this->statisticService->addStatistics();

        return $response;
    }
}
