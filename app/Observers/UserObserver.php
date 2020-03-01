<?php
/**
 * @package    Observers
 ****************************************************
 * @date       09/12/2019 10:25:33
 */

declare(strict_types=1);

namespace App\Observers;

use App\Models\User;
use Auth;

class UserObserver
{

    /**
     * Handle the user "creating" event.
     *
     * @param User $user
     * @return void
     */
    public function creating(User $user)
    {

        $user->user_creator_id = Auth::id();
        //$user->user_updater_id = \Auth::id();
    }


    /**
     * Handle the user "updating" event.
     *
     * @param User $user
     * @return void
     */
    public function updating(User $user)
    {

        $user->user_updater_id = Auth::id();
    }


    /**
     * Handle the user "deleting" event.
     *
     * @param User $user
     * @return void
     */
    public function deleting(User $user)
    {

        $user->user_eraser_id = Auth::id();
        $user->timestamps = false;
        $user->save();
    }
}
