<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;

/**
 *  @OA\Tag(
 *      name="booking",
 *      description="Booking routes"
 *  )
 */
class BookingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreBookingRequest
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     *     tags={"booking"},
     *     path="/api/booking",
     *     description="Return the booking by id ",
     *     @OA\RequestBody(
     *         description="Create Booking object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Booking")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="",
     *          @OA\JsonContent(ref="#/components/schemas/Booking")
     *      )
     * )
     */
    public function store(StoreBookingRequest $request)
    {
        return Booking::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *     tags={"booking"},
     *     path="/api/booking/{id}",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id to load the booking",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="Int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Booking object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Booking")
     *     ),
     *     description="Return the booking by id ",
     *     @OA\Response(response=200, description="")
     * )
     */
    public function show(Booking $booking)
    {
        return $booking;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $booking->update($request->all());
        return $booking;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        return $booking->delete();
    }
}
