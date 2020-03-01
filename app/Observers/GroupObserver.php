<?php
/**
 * @package    Observers
 ****************************************************
 * @date       02/25/2020 9:07 PM
 */

declare(strict_types=1);

namespace App\Observers;

use App\Models\Group;

class GroupObserver
{

    /**
     * Handle the group "creating" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function creating(Group $group)
    {

        $group->user_creator_id = \Auth::id();
        //$group->user_updater_id = \Auth::id();
    }


    /**
     * Handle the group "updating" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function updating(Group $group)
    {

        $group->user_updater_id = \Auth::id();
    }


    /**
     * Handle the group "deleting" event.
     *
     * @param  \App\Models\Group  $group
     * @return void
     */
    public function deleting(Group $group)
    {

        $group->user_eraser_id = \Auth::id();
        $group->timestamps = false;
        $group->save();
    }
}
