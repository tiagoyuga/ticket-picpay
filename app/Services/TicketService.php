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
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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

        $query->when(request('search'), function ($query, $search) {

            return $query->where('name', 'LIKE', '%' . $search . '%');
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
            $model->client_id = \Auth::user()->client->id;
            $model->cto_id = User::where('group_id', Group::CTO)->first()->id;
            $model->uid = strtoupper(substr(uniqid(), 0, 4) . \Carbon\Carbon::now()->format('m-d-Y'));
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


    public function update(array $data, Ticket $model): Ticket
    {
        $model_before = $model->toArray();
        $model->fill($data);
        $model_after = $model->toArray();

        #$model->user_updater_id = \Auth::id();
        $model->save();



        if($model_before != $model_after){

            $content = "Updated at ". \Carbon\Carbon::parse($model->created_at)->format('m-d-Y H:i:s');

            if(in_array(\Auth::user()->group_id, [Group::CTO,  Group::ADMIN]) && $model_before['ticket_status_id'] != $model_after['ticket_status_id'] ) {
                $content = 'Status anternancy to: <strong>' . $model->status->name . "</strong>. <br>  Review: <br> " . $data['content'];
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
}
