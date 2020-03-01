<?php
/**
 * @package    Resources
 ****************************************************
 * @date       02/25/2020 8:08 PM
 */

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DevSkillCategoryResource extends JsonResource
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
            'name' => $this->name,
            'active' => $this->active,
        ];
    }
}
