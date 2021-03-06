<?php

namespace App\Http\Controllers;

use App\Enums\TempScaleEnum;
use App\Exceptions\InvalidForecastDateException;
use App\Repositories\ForecastDateChecker;
use App\Services\ForecastService;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ForecastController extends Controller
{
    use ForecastDateChecker;

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

        try {
            $this->checkDate($date);
        } catch (InvalidForecastDateException $dateException) {
            return response()->json([
                'message' => $dateException->getMessage(),
            ], 400);
        }
        try {
            $scaleObject = new TempScaleEnum($scale);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'supported temperature scales: celsius, fahrenheit'
            ], 400);
        }

        $forecast = $this->forecastService->getForecast($townName, $date, $scaleObject);

        return response()->json($forecast->toArray($scaleObject));
    }
}
