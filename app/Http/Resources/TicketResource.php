<?php
/**
 * @package    Resources
 ****************************************************
 * @date       02/29/2020 11:48 AM
 */

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'client_id' => $this->client_id,
            'user_client_id' => $this->user_client_id,
            'cto_id' => $this->cto_id,
            'dev_id' => $this->dev_id,
            'ticket_status_id' => $this->ticket_status_id,
            'subject' => $this->subject,
            'content' => $this->content,
            'priority' => $this->priority,
        ];
    }
}
