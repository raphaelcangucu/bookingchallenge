<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Booking.
 *
 *
 * @OA\Schema(
 *     description="Booking model",
 *     title="Booking model",
 *     required={"room_id", "starts_at", "ends_at"},
 *     @OA\Xml(
 *         name="Booking"
 *     ),
 *     @OA\Property(
 *          property="room_id",
 *          format="integer",
 *          type="integer",
 *          description="Room Id",
 *          example="1",
 *     ),
 *     @OA\Property(
 *          property="starts_at",
 *          format="string",
 *          type="date",
 *          description="Date of start",
 *          example="2023-01-01",
 *     ),
 *     @OA\Property(
 *          property="ends_at",
 *          format="string",
 *          type="date",
 *          description="Date of end",
 *          example="2023-01-10",
 *     ),
 * )
 */
class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['room_id','starts_at','ends_at'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the room associated with the booking.
     */
    public function room()
    {
        return $this->hasOne(Room::class);
    }
}
