<?php
/**
 * @package    Services
 ****************************************************
 * @date       09/12/2019 09:48:30
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\Type;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TypeService
{

    public function paginate(int $limit): LengthAwarePaginator
    {

        return $this->buildQuery()->paginate($limit);
    }

    private function buildQuery(): Builder
    {

        $query = Type::query();

        $query->when(request('id'), function ($query, $id) {

            return $query->whereId($id);
        });

        $query->when(request('search'), function ($query, $search) {

            return $query->where('id', 'LIKE', '%' . $search . '%');
        });

        return $query;
    }

    public function all(): Collection
    {

        return $this->buildQuery()->get();
    }

    public function find(int $id): ?Type
    {

        //return Cache::remember('Type_find_' . $id, config('cache.cache_time'), function () use ($id) {
        return Type::find($id);
        //});
    }

    public function create(array $data): Type
    {

        return DB::transaction(function () use ($data) {

            $model = new Type();
            $model->fill($data);
            #$model->user_creator_id = \Auth::id();
            #$model->user_updater_id = \Auth::id();
            $model->save();

            return $model;
        });
    }

    public function update(array $data, Type $model): Type
    {

        $model->fill($data);
        #$model->user_updater_id = \Auth::id();
        $model->save();

        return $model;
    }

    public function delete(Type $model): ?bool
    {
        #$model->user_eraser_id = \Auth::id();
        $model->save();

        return $model->delete();
    }

    public function lists(): array
    {
        //return Cache::remember('Type_lists', config('cache.cache_time'), function () {

        return Type::orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
        //});
    }
}
