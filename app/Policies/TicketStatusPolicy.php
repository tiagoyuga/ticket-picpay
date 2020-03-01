<?php
/**
 * @package    Controller
 ****************************************************
 * @date       02/29/2020 11:47 AM
 */

declare(strict_types=1);

namespace App\Policies;

use App\Models\TicketStatus;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketStatusPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view any ticketStatus.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

        return true;
    }

    /**
     * Determine whether the user can create ticketStatus.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {

        return true;
    }

    /**
     * Determine whether the user can update the ticketStatus.
     *
     * @param User $user
     * @param TicketStatus $ticketStatus
     * @return mixed
     */
    public function update(User $user, TicketStatus $ticketStatus)
    {

        return true;
    }

    /**
     * Determine whether the user can delete the ticketStatus.
     *
     * @param User $user
     * @param TicketStatus $ticketStatus
     * @return mixed
     */
    public function delete(User $user, TicketStatus $ticketStatus)
    {

        return true;
    }
}
