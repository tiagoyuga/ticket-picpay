<?php
/**
 * @package    Services
 ****************************************************
 * @date       02/29/2020 11:49 AM
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\TicketActivity;
use App\Models\TicketComment;
use App\Models\TicketFile;
use App\Rlustosa\GenericUpload;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TicketCommentService
{

    private function buildQuery(): Builder
    {

        $query = TicketComment::query();

        $query->when(request('id'), function ($query, $id) {

            return $query->whereId($id);
        });

        $query->when(request('search'), function ($query, $search) {

            return $query->where('name', 'LIKE', '%' . $search . '%');
        });

        return $query;
    }

    public function paginate(int $limit): LengthAwarePaginator
    {

        return $this->buildQuery()->paginate($limit);
    }

    public function all(): Collection
    {

        return $this->buildQuery()->get();
    }

    public function find(int $id): ?TicketComment
    {

        //return Cache::remember('TicketComment_find_' . $id, config('cache.cache_time'), function () use ($id) {
        return TicketComment::find($id);
        //});
    }

    public function create(array $data): TicketComment
    {

        return DB::transaction(function () use ($data) {

            $model = new TicketComment();
            $data['user_id'] = \Auth::id();
            $model->fill($data);
            #$model->user_creator_id = \Auth::id();
            #$model->user_updater_id = \Auth::id();

//            if($data['send_to']) {
//                switch ($data['send_to']){
//                    case 'all':
//
//                    case 'members':
//                    case 'client':
//                    case 'admin':
//                    case 'cto':
//                    case 'dev':
//                }
//            }

            $model->save();

            $activity = new TicketActivity();
            $activity->user_id = \Auth::id();
            $activity->ticket_id = $data['ticket_id'];
            $activity->activity = "Comment left at ". \Carbon\Carbon::parse($model->created_at)->format('m-d-Y H:i:s');
            $activity->before = json_encode($model->ticket->toArray());
            $activity->after = json_encode($model->ticket->toArray());
            $activity->save();

            $this->upload($model->ticket);


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

    public function update(array $data, TicketComment $model): TicketComment
    {

        $model->fill($data);
        #$model->user_updater_id = \Auth::id();
        $model->save();

        return $model;
    }

    public function delete(TicketComment $model): ?bool
    {
        #$model->user_eraser_id = \Auth::id();
        $model->save();

        return $model->delete();
    }

    public function lists(): array
    {
        //return Cache::remember('TicketComment_lists', config('cache.cache_time'), function () {

        return TicketComment::orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
        //});
    }
}
