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

class UserService
{

    private function buildQuery(): Builder
    {

        $query = User::orderByDesc('id');

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

    public function find(int $id): ?User
    {

        //return Cache::remember('User_find_' . $id, config('cache.cache_time'), function () use ($id) {
        return User::find($id);
        //});
    }

    public function create(array $data): User
    {

        return DB::transaction(function () use ($data) {

            $model = new User();
            $model->fill($data);

            if (!empty($data["password"])) {
                $model->password = Hash::make($data["password"]);
            }

            if (!empty($data["commission_percent"])) {
                $model->commission_percent = floatval(str_replace(',', '.', $data["commission_percent"]));
            }

            $model->save();

            $types = Type::find(array_merge([$data["type"]], [Type::CLIENT]));

            $model->types()->attach($types);

            return $model;

        });
    }

    public function update(array $data, User $model): User
    {

        $model->fill($data);

        if (!empty($data["password"])) {
            $model->password = Hash::make($data["password"]);
        }
        if (!empty($data["commission_percent"])) {
            $model->commission_percent = floatval(str_replace(',', '.', $data["commission_percent"]));
        }

        $model->save();

        return $model;
    }

    public function updateProfile(array $data, User $model): User
    {

        $model->fill($data);

        if (!empty($data["password"])) {
            $model->password = Hash::make($data["password"]);
        }

        $model->save();

        Address::updateOrCreate([
            'addressable_type' => User::class,
            'addressable_id' => $model->id
        ], $data);

        if (!empty($data['bank'])) {
            $this->saveBankAccount($data, $model->id);
        }

        return $model;
    }

    public function updateSkills(array $data, User $model): User
    {
        if(!empty($data['skill'])) {

            foreach($data['skill'] as $id=>$value) {

                Qualification::updateOrCreate(
                    ['skill_id' => intval($id), 'user_id' => intval($model->id)],
                    ['proficiency' => $value]
                );
            }

        }


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

        return User::orderBy('name')
            ->where('group_id', "!=", Group::CLIENT)
            ->pluck('name', 'id')
            ->toArray();
        //});
    }

    public function listsClients(): array
    {
        //return Cache::remember('User_lists', config('cache.cache_time'), function () {

        return User::orderBy('users.name')
            ->whereGroupId(3)
            ->pluck('users.name', 'users.id')
            ->toArray();
        //});
    }

    public function listsDevs(): array
    {
        //return Cache::remember('User_lists', config('cache.cache_time'), function () {

        return User::orderBy('name')
            ->whereGroupId(5)
            ->pluck('name', 'id')
            ->toArray();
        //});
    }

    private function saveBankAccount($data, $user_id)
    {

        foreach($data['bank'] as $bank) {

            if(!empty($bank['id']) && isset($bank['remove'])) {

                BankAccount::destroy($bank['id']);

            }else if (isset($bank['country'])){

                if(($bank['country'] == 'brazil'
                    && !empty($bank['agency'])
                    && !empty($bank['cpf'])
                    && !empty($bank['number'])
                 )||
                ($bank['country'] == 'usa'
                    && !empty($bank['name_usa'])
                    && !empty($bank['routing'])
                    && !empty($bank['number_usa'])
                ) ||
                (
                    $bank['country'] == 'paypal'
                    && !empty($bank['email'])
                    && !empty($bank['description'])
                )){

                    if($bank['country'] == 'usa'){
                        $bank['name'] = $bank['name_usa'];
                        $bank['number'] = $bank['number_usa'];
                    }

                    $bank['user_id'] = $user_id;

                    BankAccount::create($bank);
                }

            }


        }

    }

    public function registerDev($data)
    {

        return DB::transaction(function () use ($data) {

            $group = Group::whereName('Developer')->first();

            $model = new User();
            $model->name = $data['name'];
            $model->group_id = $group->id;
            $model->email = $data['email'];
            $model->password = Hash::make($data["password"]);
            $model->save();

            $address = new Address();
            $address->fill($data);
            $address->addressable_id = $model->id;
            $address->addressable_type = User::class;
            $address->save();

            if (!empty($data['bank'])) {
                $this->saveBankAccount($data, $model->id);
            }

            if (!empty($data['skill'])) {
                $this->updateSkills($data, $model);
            }

            if(!empty($data['resume'])){
                $path = GenericUpload::store(request()->file('resume'), 'users');
                $attach = new TicketFile();
                $attach->file = $path;
                $attach->user_id = $model->id;
                $attach->save();
            }

            return $model;

        });

    }


    public function storeResume()
    {

        return DB::transaction(function ()  {

            if(!empty(request()->file('resume'))){

                $path = GenericUpload::store(request()->file('resume'), 'users');
                $attach = new TicketFile();
                $attach->file = $path;
                $attach->user_id = \Auth::id();
                $attach->save();

            }

        });

    }

    public function listUsersOfCompany($client_id)
    {
        return User::join('client_user', 'client_user.user_id', 'users.id')
            ->where('client_user.client_id', $client_id)
            ->get();
    }

}
