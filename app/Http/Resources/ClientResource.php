<?php
/**
 * @package    Resources
 ****************************************************
 * @date       02/28/2020 7:30 AM
 */

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'advert_id' => $this->advert_id,
            'seller_id' => $this->seller_id,
            'project_manager_id' => $this->project_manager_id,
            'company_name' => $this->company_name,
            'contact_name' => $this->contact_name,
            'cell_phone' => $this->cell_phone,
            'additional_phone' => $this->additional_phone,
            'project_scope' => $this->project_scope,
            'follow_up' => $this->follow_up,
            'status' => $this->status,
            'lead_status' => $this->lead_status,
            'priority' => $this->priority,
            'email' => $this->email,
            'credit_amount' => $this->credit_amount,
            'text_credit_history' => $this->text_credit_history,
        ];
    }
}
