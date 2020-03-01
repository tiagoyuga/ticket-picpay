<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Attendance;
use App\Models\PlaceReservation;
use App\Models\Sale;
use App\Models\StatusPayments;
use App\Models\User;
use Carbon\Carbon;
use stdClass;

class DashboardService
{

    public function reservationByDay()
    {
        $query = PlaceReservation::selectRaw('count(id) AS count, DATE_FORMAT(date, "%Y-%m-%d") as mdate');

        if (request('period')) {
            $periods = explode("-", request('period'));
            $date_start = Carbon::createFromFormat('d/m/Y', trim($periods[0]))->startOfDay();
            $date_end = Carbon::createFromFormat('d/m/Y', trim($periods[1]))->endOfDay();

            $query->where("date", ">=", $date_start);
            $query->where("date", "<=", $date_end);
        }

        if (!request('period'))
            $query->where("date", ">=", Carbon::now()->subWeek(1));

        $data = $query->groupBy('mdate')->orderBy('mdate')->get();


        return $this->formatPayloadChartFromDate($data);

    }

    private function formatPayloadChartFromDate(object $data)
    {
        $modelsDay = array();
        if ($data) {
            foreach ($data as $model) {
                if (isset($model->mdate) && isset($model->count)) {
                    $date = Carbon::createFromFormat('Y-m-d', $model->mdate);
                    $obj = new stdClass();
                    $obj->day = $date->day;
                    $obj->month = $date->month;
                    $obj->year = $date->year;
                    $obj->count = $model->count;
                    $modelsDay[] = $obj;
                }
            }
        }

        return $modelsDay;
    }

    public function usersRegistrationDay()
    {
        $query = User::selectRaw('count(users.id) AS count, DATE_FORMAT(users.created_at, "%Y-%m-%d") as mdate');


        if (request('period')) {
            $periods = explode("-", request('period'));
            $date_start = Carbon::createFromFormat('d/m/Y', trim($periods[0]))->startOfDay();
            $date_end = Carbon::createFromFormat('d/m/Y', trim($periods[1]))->endOfDay();

            $query->where("users.created_at", ">=", $date_start);
            $query->where("users.created_at", "<=", $date_end);
        }

        if (!request('period'))
            $query->where("users.created_at", ">=", Carbon::now()->subWeek(1));

        $data = $query->groupBy('mdate')->orderBy('mdate')->get();


        return $this->formatPayloadChartFromDate($data);
    }

    public function reservationByPlace()
    {
        $query = PlaceReservation::selectRaw('count(place_reservations.id) as count, places.name as name')
            ->join("places", "place_id", "places.id");


        if (request('period')) {
            $periods = explode("-", request('period'));
            $date_start = Carbon::createFromFormat('d/m/Y', trim($periods[0]))->startOfDay();
            $date_end = Carbon::createFromFormat('d/m/Y', trim($periods[1]))->endOfDay();

            $query->where("date", ">=", $date_start);
            $query->where("date", "<=", $date_end);
        }

        $collection = $query->groupBy('place_id')->orderBy('count', 'DESC')->get();

        $total = $collection->reduce(function ($total, $item) {
            return $total + $item->count;
        });

        $formated = $collection->map(function ($item, $key) use ($total) {
            $item->y = $item->count / $total * 100;
            return $item;
        });


        return $formated->all();
    }

    public function reservationBySport()
    {
        $query = PlaceReservation::selectRaw('count(place_reservations.id) as count, sports.name as name')
            ->join("sports", "sport_id", "sports.id");


        if (request('period')) {
            $periods = explode("-", request('period'));
            $date_start = Carbon::createFromFormat('d/m/Y', trim($periods[0]))->startOfDay();
            $date_end = Carbon::createFromFormat('d/m/Y', trim($periods[1]))->endOfDay();

            $query->where("date", ">=", $date_start);
            $query->where("date", "<=", $date_end);
        }

        $collection = $query->groupBy('sport_id')->orderBy('count', 'DESC')->get();

        $total = $collection->reduce(function ($total, $item) {
            return $total + $item->count;
        });

        $formated = $collection->map(function ($item, $key) use ($total) {
            $item->y = $item->count / $total * 100;
            return $item;
        });


        return $formated->all();
    }


}
