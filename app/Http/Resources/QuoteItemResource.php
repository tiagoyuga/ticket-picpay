<?php
/**
 * @package    Resources
 ****************************************************
 * @date       02/28/2020 7:40 AM
 */

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuoteItemResource extends JsonResource
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
            'quote_id' => $this->quote_id,
            'description' => $this->description,
            'hours' => $this->hours,
            'estimated_deliver_time' => $this->estimated_deliver_time,
            'development_cost' => $this->development_cost,
            'number' => $this->number,
            'name' => $this->name,
            'estimated_cost' => $this->estimated_cost,
            'client_description' => $this->client_description,
            'by_hour' => $this->by_hour,
            'sale_hours' => $this->sale_hours,
            'hourly_rate' => $this->hourly_rate,
        ];
    }
}
