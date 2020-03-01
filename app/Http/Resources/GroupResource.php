<?php
/**
 * @package    Resources
 ****************************************************
 * @date       02/25/2020 9:07 PM
 */

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
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
            'kind' => $this->kind,
            'users_count' => $this->users_count,
            'view_users' => $this->view_users,
            'view_groups' => $this->view_groups,
            'view_links' => $this->view_links,
            'view_daily_hours' => $this->view_daily_hours,
            'view_adverts' => $this->view_adverts,
            'view_clients' => $this->view_clients,
            'view_projects' => $this->view_projects,
            'view_invoices' => $this->view_invoices,
            'view_daily_activities' => $this->view_daily_activities,
            'view_quotes' => $this->view_quotes,
            'view_tasks' => $this->view_tasks,
            'view_business_dev' => $this->view_business_dev,
        ];
    }
}
