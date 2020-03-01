<?php
/**
 * @package    Resources
 ****************************************************
 * @date       02/29/2020 11:49 AM
 */

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            'ticket_id' => $this->ticket_id,
            'content' => $this->content,
        ];
    }
}
