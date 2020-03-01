<?php
/**
 * @package    Observers
 ****************************************************
 * @date       02/29/2020 11:48 AM
 */

declare(strict_types=1);

namespace App\Observers;

use App\Models\Ticket;

class TicketObserver
{

    /**
     * Handle the ticket "creating" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function creating(Ticket $ticket)
    {

        $ticket->user_creator_id = \Auth::id();
        //$ticket->user_updater_id = \Auth::id();
    }


    /**
     * Handle the ticket "updating" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function updating(Ticket $ticket)
    {

        $ticket->user_updater_id = \Auth::id();
    }


    /**
     * Handle the ticket "deleting" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function deleting(Ticket $ticket)
    {

        $ticket->user_eraser_id = \Auth::id();
        $ticket->timestamps = false;
        $ticket->save();
    }
}
