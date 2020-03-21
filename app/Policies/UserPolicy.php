<?php
/**
 * @package    Controller
 ****************************************************
 * @date       09/12/2019 10:25:33
 */

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\Models\User as AuthUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any user.
     *
     * @param AuthUser $authUser
     * @return mixed
     */
    public function viewAny(AuthUser $authUser)
    {
        if($authUser->is_admin || $authUser->isClientAdmin)
        return true;
    }

    /**
     * Determine whether the user can create user.
     *
     * @param AuthUser $authUser
     * @return mixed
     */
    public function create(AuthUser $authUser)
    {

        return true;
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param AuthUser $authUser
     * @param User $user
     * @return mixed
     */
    public function update(AuthUser $authUser, User $user)
    {

        if($authUser->is_client)
            return false;

        return true;
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param AuthUser $authUser
     * @param User $user
     * @return mixed
     */
    public function delete(AuthUser $authUser, User $user)
    {
        if($authUser->is_client)
            return false;
        return true;
    }

    public function profile(User $user)
    {
        return $user->id === \Auth::id();
    }
}
