<?php
/**
 * @package    Services
 ****************************************************
 * @date       02/29/2020 11:49 AM
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\TicketComment;
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
            $model->fill($data);
            #$model->user_creator_id = \Auth::id();
            #$model->user_updater_id = \Auth::id();
            $model->save();

            return $model;
        });
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
