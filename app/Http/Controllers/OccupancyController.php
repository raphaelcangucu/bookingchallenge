<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OccupancyRepository;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\DailyOccupancyRatesRequest;
use App\Http\Requests\MonthlyOccupancyRatesRequest;
use DateTime;
use Nette\Utils\Json;

class OccupancyController extends Controller
{
    /**
     * Indicates the repository of the controller
     *
     * @var OccupancyRepository
     */
    private OccupancyRepository $occupancyRepository;

    /**
     * Construct the controller
     * @param OccupancyRepository occupancyRepository
     * @return void
     */
    public function __construct(OccupancyRepository $occupancyRepository)
    {
        $this->occupancyRepository = $occupancyRepository;
    }

    /**
     * Function to return the daily occupancy rate
     * @param DailyOccupancyRatesRequest request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dailyOccupancyRates(DailyOccupancyRatesRequest $request): JsonResponse
    {
        $day = new DateTime($request->date);

        $bookings = $this->occupancyRepository->countBookingsByDay($day, $request->room_ids);
        $blocks = $this->occupancyRepository->countBlocksByDay($day, $request->room_ids);
        $capacity = $this->occupancyRepository->capacityByRooms($request->room_ids) ;

        if ($capacity - $blocks > 0) {
            $occupancyRate = $bookings / ($capacity - $blocks);
        } else {
            $occupancyRate = $bookings / $capacity;
        }

        return response()->json([
            'occupancy_rate' => round($occupancyRate, 2)
        ]);
    }

    /**
     * Function to return the monthly occupancy rate
     * @param MonthlyOccupancyRatesRequest request
     * @return \Illuminate\Http\JsonResponse
     */
    public function monthlyOccupancyRates(MonthlyOccupancyRatesRequest $request): JsonResponse
    {
        $month = new DateTime($request->date);
        $daysInMonth = 31 ;

        $bookings = $this->occupancyRepository->countBookingsByMonth($month, $request->room_ids);
        $blocks = $this->occupancyRepository->countBlocksByMonth($month, $request->room_ids);
        $capacity = $this->occupancyRepository->capacityByRooms($request->room_ids) * $daysInMonth;

        if ($capacity - $blocks > 0) {
            $occupancyRate = $bookings / ($capacity - $blocks);
        } else {
            $occupancyRate = $bookings / $capacity;
        }

        return response()->json([
            'occupancy_rate' => round($occupancyRate, 2)
        ]);
    }
}
