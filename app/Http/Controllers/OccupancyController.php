<?php

namespace App\Http\Controllers;

use App\Repositories\OccupancyRepository;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\DailyOccupancyRatesRequest;
use App\Http\Requests\MonthlyOccupancyRatesRequest;
use DateTime;

/**
 *  @OA\Tag(
 *      name="occupancy",
 *      description="Occupancy Api"
 *  )
 */
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
    /**
     * @OA\Get(
     *     tags={"occupancy"},
     *     path="/api/daily-occupancy-rates/{date}",
     *     @OA\Parameter(
     *         name="date",
     *         in="path",
     *         description="Date Day",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             format="Date"
     *         )
     *     ),
     *     description="Return the daily occupancy rate ",
     *     @OA\Response(response=200, description="")
     * )
     */
    public function dailyOccupancyRates(DailyOccupancyRatesRequest $request): JsonResponse
    {
        $day = new DateTime($request->date);

        $bookings = $this->occupancyRepository->countBookingsByDay($day, $request->room_ids);
        $blocks = $this->occupancyRepository->countBlocksByDay($day, $request->room_ids);
        $capacity = $this->occupancyRepository->capacityByRooms($request->room_ids) ;

        if ($capacity - $blocks > 0) {
            $occupancyRate = $bookings / ($capacity - $blocks);
        } elseif ($capacity) {
            $occupancyRate = $bookings / $capacity;
        } else {
            $occupancyRate = 0;
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
    /**
     * @OA\Get(
     *     tags={"occupancy"},
     *     path="/api/monthly-occupancy-rates/{date}",
     *     @OA\Parameter(
     *         name="date",
     *         in="path",
     *         description="Date of month",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             format="Date"
     *         )
     *     ),
     *     description="Return the monthly occupancy rate ",
     *     @OA\Response(response=200, description="")
     * )
     */
    public function monthlyOccupancyRates(MonthlyOccupancyRatesRequest $request): JsonResponse
    {
        $month = new DateTime($request->date);
        $daysInMonth = intval($month->format('t')) ;

        $bookings = $this->occupancyRepository->countBookingsByMonth($month, $request->room_ids);
        $blocks = $this->occupancyRepository->countBlocksByMonth($month, $request->room_ids);
        $capacity = $this->occupancyRepository->capacityByRooms($request->room_ids) * $daysInMonth;

        if ($capacity - $blocks > 0) {
            $occupancyRate = $bookings / ($capacity - $blocks);
        } elseif ($capacity) {
            $occupancyRate = $bookings / $capacity;
        } else {
            $occupancyRate = 0;
        }

        return response()->json([
            'occupancy_rate' => round($occupancyRate, 2)
        ]);
    }
}
