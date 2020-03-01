<?php
/**
 * @package    Observers
 ****************************************************
 * @date       16/12/2019 15:48:42
 */

declare(strict_types=1);

namespace App\Observers;

use App\Models\Type;
use Auth;

class TypeObserver
{

    /**
     * Handle the type "creating" event.
     *
     * @param Type $type
     * @return void
     */
    public function creating(Type $type)
    {

        $type->user_creator_id = Auth::id();
        //$type->user_updater_id = \Auth::id();
    }


    /**
     * Handle the type "updating" event.
     *
     * @param Type $type
     * @return void
     */
    public function updating(Type $type)
    {

        $type->user_updater_id = Auth::id();
    }


    /**
     * Handle the type "deleting" event.
     *
     * @param Type $type
     * @return void
     */
    public function deleting(Type $type)
    {

        $type->user_eraser_id = Auth::id();
        $type->timestamps = false;
        $type->save();
    }
}
