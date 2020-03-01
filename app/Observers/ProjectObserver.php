<?php
/**
 * @package    Observers
 ****************************************************
 * @date       02/28/2020 7:41 AM
 */

declare(strict_types=1);

namespace App\Observers;

use App\Models\Project;

class ProjectObserver
{

    /**
     * Handle the project "creating" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function creating(Project $project)
    {

        $project->user_creator_id = \Auth::id();
        //$project->user_updater_id = \Auth::id();
    }


    /**
     * Handle the project "updating" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function updating(Project $project)
    {

        $project->user_updater_id = \Auth::id();
    }


    /**
     * Handle the project "deleting" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function deleting(Project $project)
    {

        $project->user_eraser_id = \Auth::id();
        $project->timestamps = false;
        $project->save();
    }
}
