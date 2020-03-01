<?php
/**
 * @package    Services
 ****************************************************
 * @date       02/28/2020 7:30 AM
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\Client;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ClientService
{

    private function buildQuery(): Builder
    {

        $query = Client::query();

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

    public function find(int $id): ?Client
    {

        //return Cache::remember('Client_find_' . $id, config('cache.cache_time'), function () use ($id) {
        return Client::find($id);
        //});
    }

    public function create(array $data): Client
    {

        return DB::transaction(function () use ($data) {

            $model = new Client();
            $model->fill($data);
            #$model->user_creator_id = \Auth::id();
            #$model->user_updater_id = \Auth::id();
            $model->save();

            return $model;
        });
    }

    public function update(array $data, Client $model): Client
    {

        $model->fill($data);
        #$model->user_updater_id = \Auth::id();
        $model->save();

        return $model;
    }

    public function delete(Client $model): ?bool
    {
        #$model->user_eraser_id = \Auth::id();
        $model->save();

        return $model->delete();
    }

    public function lists(): array
    {
        //return Cache::remember('Client_lists', config('cache.cache_time'), function () {

        return Client::orderBy('company_name')
            ->pluck('company_name', 'id')
            ->toArray();
        //});
    }
}
