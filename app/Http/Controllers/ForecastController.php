<?php

namespace App\Http\Controllers;

use App\Enums\TempScaleEnum;
use App\Services\ForecastService;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ForecastController extends Controller
{
    /** @var ForecastService */
    private $forecastService;

    public function __construct(ForecastService $forecastService)
    {
        $this->forecastService = $forecastService;
    }

    /**
     * @param Request $request
     * @param string $townName
     * @param string $date
     * @return JsonResponse
     * @throws \Exception
     */
    public function get(Request $request, $townName, $date = null)
    {
        $scale = $request->get('scale', TempScaleEnum::CELSIUS());
        $date = $date ? (new DateTime($date)) : (new DateTime());

        $forecast = $this->forecastService->getForecast($townName, $date, $scale);

        return response()->json($forecast->toArray($scale));
    }
}
