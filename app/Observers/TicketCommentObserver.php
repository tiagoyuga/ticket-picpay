<?php
/**
 * @package    Observers
 ****************************************************
 * @date       02/29/2020 11:49 AM
 */

declare(strict_types=1);

namespace App\Observers;

use App\Models\TicketComment;

class TicketCommentObserver
{

    /**
     * Handle the ticketComment "creating" event.
     *
     * @param  \App\Models\TicketComment  $ticketComment
     * @return void
     */
    public function creating(TicketComment $ticketComment)
    {

        $ticketComment->user_creator_id = \Auth::id();
        //$ticketComment->user_updater_id = \Auth::id();
    }


    /**
     * Handle the ticketComment "updating" event.
     *
     * @param  \App\Models\TicketComment  $ticketComment
     * @return void
     */
    public function updating(TicketComment $ticketComment)
    {

        $ticketComment->user_updater_id = \Auth::id();
    }


    /**
     * Handle the ticketComment "deleting" event.
     *
     * @param  \App\Models\TicketComment  $ticketComment
     * @return void
     */
    public function deleting(TicketComment $ticketComment)
    {

        $ticketComment->user_eraser_id = \Auth::id();
        $ticketComment->timestamps = false;
        $ticketComment->save();
    }
}
