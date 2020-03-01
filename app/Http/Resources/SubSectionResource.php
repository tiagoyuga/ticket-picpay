<?php
/**
 * @package    Resources
 ****************************************************
 * @date       02/28/2020 7:44 AM
 */

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubSectionResource extends JsonResource
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
            'section_id' => $this->section_id,
            'name' => $this->name,
            'description' => $this->description,
            'estimated_deliver_time' => $this->estimated_deliver_time,
            'hours' => $this->hours,
            'sale_value' => $this->sale_value,
            'equity_amount' => $this->equity_amount,
            'cash_amount' => $this->cash_amount,
            'sale_hours' => $this->sale_hours,
            'hourly_rate' => $this->hourly_rate,
            'by_hour' => $this->by_hour,
            'paid' => $this->paid,
            'has_cto' => $this->has_cto,
            'client_description' => $this->client_description,
        ];
    }
}
