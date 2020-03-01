<?php
/**
 * @package    Resources
 ****************************************************
 * @date       02/28/2020 7:44 AM
 */

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
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
            'project_id' => $this->project_id,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'programmer_hours' => $this->programmer_hours,
            'analyses_hours' => $this->analyses_hours,
            'extra_hours' => $this->extra_hours,
            'brl_amount' => $this->brl_amount,
            'usd_amount' => $this->usd_amount,
            'sale_value' => $this->sale_value,
            'equity_amount' => $this->equity_amount,
            'cash_amount' => $this->cash_amount,
            'paid' => $this->paid,
            'hours' => $this->hours,
            'by_hour' => $this->by_hour,
            'sale_hours' => $this->sale_hours,
            'hourly_rate' => $this->hourly_rate,
            'estimated_deliver_time' => $this->estimated_deliver_time,
            'has_cto' => $this->has_cto,
            'client_description' => $this->client_description,
            'number' => $this->number,
            'cto_percent' => $this->cto_percent,
            'cto_hours' => $this->cto_hours,
        ];
    }
}
