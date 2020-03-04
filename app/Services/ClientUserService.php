<?php
/**
 * @package    Services
 ****************************************************
 * @date       02/25/2020 8:56 PM
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\Address;
use App\Models\ClientUser;
use App\Models\TicketFile;
use App\Models\BankAccount;
use App\Models\Group;
use App\Models\Qualification;
use App\Models\Type;
use App\Models\User;
use App\Rlustosa\GenericUpload;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientUserService
{

    private function buildQuery(): Builder
    {

        $query = Clientuser::orderByDesc('id');

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

    public function find(int $id): ?Clientuser
    {

        //return Cache::remember('User_find_' . $id, config('cache.cache_time'), function () use ($id) {
        return Clientuser::find($id);
        //});
    }

    public function create(array $data): Clientuser
    {

        return DB::transaction(function () use ($data) {

            $model = new Clientuser();
            $model->fill($data);

            $model->save();

            return $model;
        });
    }

    public function update(array $data, Clientuser $model): Clientuser
    {

        $model->fill($data);

        $model->save();

        return $model;
    }

    public function delete(User $model): ?bool
    {
        #$model->user_eraser_id = \Auth::id();
        $model->save();

        return $model->delete();
    }

    public function lists(): array
    {
        //return Cache::remember('User_lists', config('cache.cache_time'), function () {

        return Clientuser::orderBy('name')
            ->where('group_id', "!=", Group::CLIENT)
            ->pluck('name', 'id')
            ->toArray();
        //});
    }

    public function listsClients(): array
    {
        //return Cache::remember('User_lists', config('cache.cache_time'), function () {

        return Clientuser::orderBy('users.name')
            ->whereGroupId(3)
            ->pluck('users.name', 'users.id')
            ->toArray();
        //});
    }

}
