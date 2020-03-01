<?php
declare(strict_types=1);

namespace App\Policies;

use App\Models\Configuration;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfigurationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any Configuration.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

        return $user->is_dev;
    }

    /**
     * Determine whether the user can create Configuration.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {

        return $user->is_dev;
    }

    /**
     * Determine whether the user can update the Configuration.
     *
     * @param User $user
     * @param Configuration $Configuration
     * @return mixed
     */
    public function update(User $user, Configuration $Configuration)
    {

        return $user->is_dev;
    }

    /**
     * Determine whether the user can delete the Configuration.
     *
     * @param User $user
     * @param Configuration $Configuration
     * @return mixed
     */
    public function delete(User $user, Configuration $Configuration)
    {

        return false;
    }
}
