<?php
/**
 * @package    Resources
 ****************************************************
 * @date       02/28/2020 7:41 AM
 */

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'programmer_id' => $this->programmer_id,
            'quote_id' => $this->quote_id,
            'name' => $this->name,
            'contract' => $this->contract,
            'url' => $this->url,
            'description' => $this->description,
            'priority' => $this->priority,
            'status' => $this->status,
            'dollar_quotation' => $this->dollar_quotation,
            'budget_amount' => $this->budget_amount,
            'sale_value' => $this->sale_value,
            'programmer_hours' => $this->programmer_hours,
            'analyses_hours' => $this->analyses_hours,
            'hours' => $this->hours,
            'brl_amount' => $this->brl_amount,
            'usd_amount' => $this->usd_amount,
            'completed_at' => $this->completed_at,
            'deposit' => $this->deposit,
            'kind' => $this->kind,
        ];
    }
}
