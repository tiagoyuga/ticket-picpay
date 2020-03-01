<?php
/**
 * @package    Services
 ****************************************************
 * @date       02/29/2020 11:47 AM
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\TicketStatus;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TicketStatusService
{

    private function buildQuery(): Builder
    {

        $query = TicketStatus::query();

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

    public function find(int $id): ?TicketStatus
    {

        //return Cache::remember('TicketStatus_find_' . $id, config('cache.cache_time'), function () use ($id) {
        return TicketStatus::find($id);
        //});
    }

    public function create(array $data): TicketStatus
    {

        return DB::transaction(function () use ($data) {

            $model = new TicketStatus();
            $model->fill($data);
            #$model->user_creator_id = \Auth::id();
            #$model->user_updater_id = \Auth::id();
            $model->save();

            return $model;
        });
    }

    public function update(array $data, TicketStatus $model): TicketStatus
    {

        $model->fill($data);
        #$model->user_updater_id = \Auth::id();
        $model->save();

        return $model;
    }

    public function delete(TicketStatus $model): ?bool
    {
        #$model->user_eraser_id = \Auth::id();
        $model->save();

        return $model->delete();
    }

    public function lists(): array
    {
        //return Cache::remember('TicketStatus_lists', config('cache.cache_time'), function () {

        return TicketStatus::orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
        //});
    }
}
