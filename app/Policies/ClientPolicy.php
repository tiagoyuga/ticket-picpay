<?php
/**
 * @package    Controller
 ****************************************************
 * @date       02/28/2020 7:30 AM
 */

declare(strict_types=1);

namespace App\Policies;

use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view any client.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

        return true;
    }

    /**
     * Determine whether the user can create client.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {

        return true;
    }

    /**
     * Determine whether the user can update the client.
     *
     * @param User $user
     * @param Client $client
     * @return mixed
     */
    public function update(User $user, Client $client)
    {

        return true;
    }

    /**
     * Determine whether the user can delete the client.
     *
     * @param User $user
     * @param Client $client
     * @return mixed
     */
    public function delete(User $user, Client $client)
    {

        return true;
    }

    public function userCanChat(User $user, Client $client)
    {
        if(\Auth::user()->is_admin || \Auth::user()->is_cto)
            return true;
        return ($client->usersTypeUser->contains($user->id));
    }
}
