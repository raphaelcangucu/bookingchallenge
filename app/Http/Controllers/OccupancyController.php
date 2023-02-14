<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OccupancyRepository;
use Illuminate\Http\JsonResponse;

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

    public function dailyOccupancyRates(): JsonResponse
    {
        return response()->json([
            'data' => $this->occupancyRepository->dailyOccupancyRates()
        ]);
    }

    public function monthlyOccupancyRates(): JsonResponse
    {
        return response()->json([
            'data' => $this->occupancyRepository->dailyOccupancyRates()
        ]);
    }
}
