<?php

namespace App\Repositories;

use App\Models\{Block, Booking, Room};
use DateTime;
use Illuminate\Support\Facades\DB;

class OccupancyRepository
{
    /**
     * Function to return the monthly occupancy rate
     * @param DateTime $date
     * @param array $roomIds
     * @return float
     */
    public function countBlocksByDay(DateTime $day = null, array $roomIds = null): float
    {
        $query = Block::query();

        if ($day) {
            $query->whereDate("starts_at", '<=', $day);

            $endsAt = clone $day;
            $endsAt->modify('+1 day');

            $query->whereDate("ends_at", '>=', $endsAt);
        }


        if ($roomIds) {
            $query->whereIn('room_id', $roomIds);
        }

        return $query->count();
    }

    /**
     * Function to return the monthly occupancy rate
     * @param DateTime $date
     * @param array $roomIds
     * @return float
     */
    public function countBookingsByDay(DateTime $day = null, array $roomIds = null): float
    {
        $query = Booking::query();

        if ($day) {
            $query->whereDate("starts_at", '<=', $day);

            $endsAt = clone $day;
            $endsAt->modify('+1 day');

            $query->whereDate("ends_at", '>=', $endsAt);
        }

        if ($roomIds) {
            $query->whereIn('room_id', $roomIds);
        }

        return $query->count();
    }

    /**
     * Function to return the monthly occupancy rate
     * @param DateTime $date
     * @param array $roomIds
     * @return float
     */
    public function countBlocksByMonth(DateTime $month = null, array $roomIds = null): float
    {
        $query = Block::query();

        if ($roomIds) {
            $query->whereIn('room_id', $roomIds);
        }

        if ($month) {
            $endsAt = clone $month;
            $endsAt->modify('+1 month');

            $query->selectRaw("SUM(DATEDIFF(IF(ends_at > ?, ?, ends_at), IF(starts_at < ?, ?, starts_at)) + 1) as monthly_blocks", [$endsAt->format("Y-m-d"),$endsAt->format("Y-m-d"),$month->format("Y-m-d"),$month->format("Y-m-d")]);

            $query->whereDate("starts_at", '>=', $month);
            $query->whereDate("ends_at", '<=', $endsAt);
        } else {
            $query->selectRaw("SUM(DATEDIFF(ends_at,starts_at) + 1) as monthly_blocks");
        }

        return  floatval($query->get()[0]->monthly_blocks);
    }

    /**
     * Function to return the monthly occupancy rate
     * @param DateTime $date
     * @param array $roomIds
     * @return float
     */
    public function countBookingsByMonth(DateTime $month = null, array $roomIds = null): float
    {
        $query = Booking::query();

        if ($roomIds) {
            $query->whereIn('room_id', $roomIds);
        }

        if ($month) {
            $endsAt = clone $month;
            $endsAt->modify('+1 month');

            $query->selectRaw("SUM(DATEDIFF(IF(ends_at > ?, ?, ends_at), IF(starts_at < ?, ?, starts_at)) + 1) as monthly_bookings", [$endsAt->format("Y-m-d"),$endsAt->format("Y-m-d"),$month->format("Y-m-d"),$month->format("Y-m-d")]);

            $query->whereDate("starts_at", '>=', $month);
            $query->whereDate("ends_at", '<=', $endsAt);
        } else {
            $query->selectRaw("SUM(DATEDIFF(ends_at,starts_at) + 1) as monthly_bookings");
        }

        return  floatval($query->get()[0]->monthly_bookings);
    }

    /**
     * Function to return the monthly occupancy rate
     * @param DateTime $date
     * @param array $roomIds
     * @return float
     */
    public function capacityByRooms(array $roomIds = null): float
    {
        $query = Room::query();

        if ($roomIds) {
            $query->whereIn('id', $roomIds);
        }

        return $query->sum('capacity');
    }
}
