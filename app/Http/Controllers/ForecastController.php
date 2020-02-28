<?php

namespace App\Http\Controllers;

use App\Enums\TempScaleEnum;
use App\Services\ForecastService;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ForecastController extends Controller
{
    /**
     * @param Request $request
     * @param ForecastService $forecastService
     * @param $townName
     * @param $date
     * @return JsonResponse
     * @throws \Exception
     */
    public function get(Request $request, ForecastService $forecastService, $townName, $date)
    {
        $scale = $request->get('scale', TempScaleEnum::CELSIUS());
        $date = $date ? (new DateTime($date)) : (new DateTime());

        $forecast = $forecastService->getForecast($townName, $date, $scale);

        return $forecast;
    }
}
