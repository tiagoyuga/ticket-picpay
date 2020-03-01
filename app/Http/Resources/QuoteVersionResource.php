<?php
/**
 * @package    Resources
 ****************************************************
 * @date       02/28/2020 7:40 AM
 */

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuoteVersionResource extends JsonResource
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
            'user_id' => $this->user_id,
            'previous' => $this->previous,
            'current' => $this->current,
        ];
    }
}
