<?php
/**
 * @package    Controller
 ****************************************************
 * @date       02/29/2020 11:49 AM
 */

declare(strict_types=1);

namespace App\Policies;

use App\Models\TicketComment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketCommentPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view any ticketComment.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

        return true;
    }

    /**
     * Determine whether the user can create ticketComment.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {

        return true;
    }

    /**
     * Determine whether the user can update the ticketComment.
     *
     * @param User $user
     * @param TicketComment $ticketComment
     * @return mixed
     */
    public function update(User $user, TicketComment $ticketComment)
    {

        return true;
    }

    /**
     * Determine whether the user can delete the ticketComment.
     *
     * @param User $user
     * @param TicketComment $ticketComment
     * @return mixed
     */
    public function delete(User $user, TicketComment $ticketComment)
    {

        return true;
    }
}
