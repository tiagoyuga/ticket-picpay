<?php
/**
 * @package    Services
 ****************************************************
 * @date       02/29/2020 11:48 AM
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\Group;
use App\Models\Ticket;
use App\Models\TicketActivity;
use App\Models\TicketFile;
use App\Models\TicketStatus;
use App\Models\User;
use App\Rlustosa\GenericUpload;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketService
{

    private function buildQuery(): Builder
    {

        $query = Ticket::query();

        $query->when(request('id'), function ($query, $id) {

            return $query->whereId($id);
        });

        $query->when(\Auth()->user()->group_id == Group::DEVELOPER, function ($query, $id) {
            return $query->where('dev_id', '=', $id);
        });

//        $query->when(\Auth()->user()->group_id == Group::CTO, function ($query, $id) {
//            return $query->where('cto_id', '=', $id);
//        });

        $query->when(request('search'), function ($query, $search) {

            return $query->where('subject', 'LIKE', '%' . $search . '%')
                ->orWhere('uid', 'LIKE', '%' . $search . '%');
        });

        $query->when(request('start_date'), function ($query, $start_date) {

            $startDate = request('start_date');
            $startDate = Carbon::parse($startDate)->format('Y-m-d');

            return $query->where('tickets.created_at', '>=', $startDate . ' 00:00:00');
        });

        $query->when(request('end_date'), function ($query, $end_date) {

            $endDate = request('end_date');
            $endDate = Carbon::parse($endDate)->format('Y-m-d');

            return $query->where('tickets.created_at', '<=', $endDate . ' 23:59:59');
        });


        return $query;
    }

    public function paginate(int $limit): LengthAwarePaginator
    {

        return $this->buildQuery()->orderBy('id','desc')->paginate($limit);
    }

    public function all(): Collection
    {

        return $this->buildQuery()->orderBy('id','desc')->get();
    }

    public function find(int $id): ?Ticket
    {

        //return Cache::remember('Ticket_find_' . $id, config('cache.cache_time'), function () use ($id) {
        return Ticket::find($id);
        //});
    }

    public function create(array $data): Ticket
    {

        return DB::transaction(function () use ($data) {

            $model = new Ticket();
            $model->fill($data);
            $model->user_id = \Auth::id ();
            $model->cto_id = User::where('group_id', Group::CTO)->first()->id;
            $model->uid = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,4) . '-' . \Carbon\Carbon::now()->format('m-d-Y');
            $model->ticket_status_id = 1;
            $model->save();

            $activity = new TicketActivity();
            $activity->user_id = \Auth::id();
            $activity->ticket_id = $model->id;
            $activity->activity = "Created at ". \Carbon\Carbon::parse($model->created_at)->format('m-d-Y H:i:s');
            $activity->before = json_encode([]);
            $activity->after = json_encode($model->toArray());
            $activity->save();

            $this->upload($model);

            return $model;

        });
    }

    private function upload($model)
    {
        if(request()->hasFile('file')){
            $path = GenericUpload::store(request()->file('file'), 'tickets');
            $attach = new TicketFile();
            $attach->file = $path;
            $attach->user_id = \Auth::id();
            $attach->ticket_id = $model->id;
            $attach->save();

            $activity = new TicketActivity();
            $activity->user_id = \Auth::id();
            $activity->ticket_id = $model->id;
            $activity->activity = "Uploaded a file in ". \Carbon\Carbon::parse($model->created_at)->format('m-d-Y H:i:s');
            $activity->before = json_encode($model->toArray());
            $activity->after = json_encode($model->toArray());
            $activity->save();
        }
    }

    public function setWorkHoursToDev($hour, $model, $type = 'add')
    {
        $partes = explode(":", $hour);
        $minutes = $partes[0]*60+$partes[1];

        $partes = explode(":", $model->dev_hour_spent);
        $minutesNew = $partes[0]*60+$partes[1];

        if ($type == 'add') {
            $totalMinutes = $minutes + $minutesNew;
        } else {
            $totalMinutes = $minutes - $minutesNew;
            $totalMinutes = ($totalMinutes < 0) ? $totalMinutes * -1 : $totalMinutes;
        }

        $dev_hour_spent = $this->hoursandmins($totalMinutes);
        $cto_hours =  $this->hoursandmins( isset($model->client->cto_amount) ? ( $totalMinutes * $model->client->cto_amount ) : $totalMinutes);

        $model->dev_hour_spent = $dev_hour_spent;
        $model->cto_hours = $cto_hours;
        $model->save();
    }

    public function update(array $data, Ticket $model): Ticket
    {
        $model_before = $model->toArray();

        $model->dev_hour_spent = empty($model->dev_hour_spent) ? '00:00' : $model->dev_hour_spent;

        $workHour = false;

        if(isset($data['dev_hour_spent']) && $data['dev_hour_spent'] != $model->dev_hour_spent) {
            $partes = explode(":", $data['dev_hour_spent']);

            $minutes = $partes[0]*60+$partes[1];

            $data['cto_hours'] =  $this->hoursandmins( isset($model->client->cto_amount) ? ( $minutes * $model->client->cto_amount ) : $minutes);

        }
        else if(isset($data['add_work_hour']) || isset($data['remove_work_hour'])) {

            if (Auth::user()->getIsDevAttribute()) {

                if (!empty($data['add_work_hour'])) {

                    $workHour = true;
                    $this->setWorkHoursToDev($data['add_work_hour'], $model);
                }

                if (!empty($data['remove_work_hour'])) {
                    $workHour = true;
                    $this->setWorkHoursToDev($data['remove_work_hour'], $model, 'remove');
                }
            }
        }

        if(isset($data['payment_date'])){
            $data['payment_date'] = (isset($data['payment_date']) && !empty($data['payment_date'])) ? Carbon::parse($data['payment_date'])->format('Y-m-d') : '';
        }

        $model->fill($data);
        $model_after = $model->toArray();
        $model->save();


        if(isset($data['completed'])){

            $model->ticket_status_id = TicketStatus::COMPLETED;
            $model_after = $model->toArray();
            $model->save();

            $data['review'] = 'Ticket set as completed';

        }

        if(isset($data['reopen'])){

            $model->ticket_status_id = TicketStatus::CLIENT_REVIEW;
            $model_after = $model->toArray();
            $model->save();

            $data['review'] = 'Ticket set as review';

        }

        if($model_before != $model_after){

            $content = "Updated at ". \Carbon\Carbon::parse($model->updated_at)->format('m-d-Y H:i:s');

            if(in_array(\Auth::user()->group_id, [Group::CTO, Group::CLIENT, Group::ADMIN]) && $model_before['ticket_status_id'] != $model_after['ticket_status_id'] ) {
                $content = 'Status anternancy to: <strong>' . $model->status->name . "</strong>. <br>  Review: <br> " . ($data['review'] ? $data['review'] : '');
            }

            if ($workHour) {
                if (!empty($data['add_work_hour'])) {
                    $content .= " - User has added {$data['add_work_hour']} work hours to {$data['work_date']}";
                }

                if (!empty($data['remove_work_hour'])) {
                    $content .= " - User has removed {$data['add_work_hour']} work hours to {$data['work_date']}";
                }
            }
            $activity = new TicketActivity();
            $activity->user_id = \Auth::id();
            $activity->ticket_id = $model->id;
            $activity->activity = $content;
            $activity->before = json_encode($model_before);
            $activity->after = json_encode($model_after);
            $activity->save();

        }

        $this->upload($model);

        return $model;
    }

    public function delete(Ticket $model): ?bool
    {
        #$model->user_eraser_id = \Auth::id();
        $model->save();

        return $model->delete();
    }

    public function lists(): array
    {
        //return Cache::remember('Ticket_lists', config('cache.cache_time'), function () {

        return Ticket::orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
        //});
    }


    private function hoursandmins($time, $format = '%02d:%02d')
    {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }

    public function paginateTicketsForClientAdmin(int $limit): LengthAwarePaginator
    {
        return $this->buildQuery()
            ->whereIn('tickets.client_id', Auth::user()->clientUser->pluck('client_id'))
            ->orderBy('flag', 'desc')->orderBy('id', 'desc')
            ->paginate($limit);
    }

    public function paginateTicketsForClient(int $limit): LengthAwarePaginator
    {
        return $this->buildQuery()
            ->whereIn('tickets.client_id', Auth::user()->clientUser->pluck('client_id'))
            ->where('tickets.user_id', Auth::id())
            ->orderBy('id','desc')->paginate($limit);
    }
}
