<?php
/**
 * @package    Services
 ****************************************************
 * @date       02/29/2020 11:48 AM
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\Ticket;
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
            $model->uid = strtoupper(substr(uniqid(), 0, 4) . \Carbon\Carbon::now()->format('m-d-Y'));
            $model->ticket_status_id = 1;
            $model->save();

            return $model;
        });
    }


    public function update(array $data, Ticket $model): Ticket
    {

        $model->fill($data);
        #$model->user_updater_id = \Auth::id();
        $model->save();

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
