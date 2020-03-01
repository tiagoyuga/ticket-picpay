<?php
/**
 * @package    Resources
 ****************************************************
 * @date       02/28/2020 7:40 AM
 */

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuoteResource extends JsonResource
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
            'client_id' => $this->client_id,
            'seller_id' => $this->seller_id,
            'cto_id' => $this->cto_id,
            'project_manager_id' => $this->project_manager_id,
            'admin_id' => $this->admin_id,
            'budget' => $this->budget,
            'hours' => $this->hours,
            'estimated_deliver_time' => $this->estimated_deliver_time,
            'viewed' => $this->viewed,
            'development_cost' => $this->development_cost,
            'release_to_client' => $this->release_to_client,
            'status' => $this->status,
            'quote_status' => $this->quote_status,
            'number' => $this->number,
            'payment_description' => $this->payment_description,
            'estimated_cost' => $this->estimated_cost,
            'deleted' => $this->deleted,
            'countdown' => $this->countdown,
            'expired' => $this->expired,
            'pdf' => $this->pdf,
            'kind' => $this->kind,
            'text' => $this->text,
            'estimated_cost_percent' => $this->estimated_cost_percent,
            'estimated_cost_amount' => $this->estimated_cost_amount,
            'estimated_cost_equity' => $this->estimated_cost_equity,
        ];
    }
}
