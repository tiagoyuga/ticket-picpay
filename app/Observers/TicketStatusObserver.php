<?php
/**
 * @package    Observers
 ****************************************************
 * @date       02/29/2020 11:47 AM
 */

declare(strict_types=1);

namespace App\Observers;

use App\Models\TicketStatus;

class TicketStatusObserver
{

    /**
     * Handle the ticketStatus "creating" event.
     *
     * @param  \App\Models\TicketStatus  $ticketStatus
     * @return void
     */
    public function creating(TicketStatus $ticketStatus)
    {

        $ticketStatus->user_creator_id = \Auth::id();
        //$ticketStatus->user_updater_id = \Auth::id();
    }


    /**
     * Handle the ticketStatus "updating" event.
     *
     * @param  \App\Models\TicketStatus  $ticketStatus
     * @return void
     */
    public function updating(TicketStatus $ticketStatus)
    {

        $ticketStatus->user_updater_id = \Auth::id();
    }


    /**
     * Handle the ticketStatus "deleting" event.
     *
     * @param  \App\Models\TicketStatus  $ticketStatus
     * @return void
     */
    public function deleting(TicketStatus $ticketStatus)
    {

        $ticketStatus->user_eraser_id = \Auth::id();
        $ticketStatus->timestamps = false;
        $ticketStatus->save();
    }
}
