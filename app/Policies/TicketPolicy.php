<?php
/**
 * @package    Controller
 ****************************************************
 * @date       02/29/2020 11:48 AM
 */

declare(strict_types=1);

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view any ticket.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

        return true;
    }

    public function changeStatus(User $user, Ticket $ticket)
    {
        if($user->is_client)
            return false;

        return true;
    }


    /**
     * Determine whether the user can create ticket.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {

        if($user->group_id != 3 || $user->clients()->count() < 1)
            return false;

        return true;
    }

    /**
     * Determine whether the user can update the ticket.
     *
     * @param User $user
     * @param Ticket $ticket
     * @return mixed
     */
    public function update(User $user, Ticket $ticket)
    {

        return true;
    }

    /**
     * Determine whether the user can delete the ticket.
     *
     * @param User $user
     * @param Ticket $ticket
     * @return mixed
     */
    public function delete(User $user, Ticket $ticket)
    {

        return true;
    }
}
