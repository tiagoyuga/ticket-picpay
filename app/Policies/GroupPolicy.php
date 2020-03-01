<?php
/**
 * @package    Controller
 ****************************************************
 * @date       02/25/2020 9:07 PM
 */

declare(strict_types=1);

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view any group.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

        return true;
    }

    /**
     * Determine whether the user can create group.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {

        return true;
    }

    /**
     * Determine whether the user can update the group.
     *
     * @param User $user
     * @param Group $group
     * @return mixed
     */
    public function update(User $user, Group $group)
    {

        return true;
    }

    /**
     * Determine whether the user can delete the group.
     *
     * @param User $user
     * @param Group $group
     * @return mixed
     */
    public function delete(User $user, Group $group)
    {

        return true;
    }
}
