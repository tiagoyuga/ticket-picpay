<?php
/**
 * @package    Controller
 ****************************************************
 * @date       02/25/2020 9:07 PM
 */

declare(strict_types=1);

namespace App\Models;

use App\Traits\CreationDataTrait;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class Group extends Model
{
    use SoftDeletes;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'kind',
        'users_count',
        'view_users',
        'view_groups',
        'view_links',
        'view_daily_hours',
        'view_adverts',
        'view_clients',
        'view_projects',
        'view_invoices',
        'view_daily_activities',
        'view_quotes',
        'view_tasks',
        'view_business_dev',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    /*protected $guarded = [
        'name',
        'kind',
        'users_count',
        'view_users',
        'view_groups',
        'view_links',
        'view_daily_hours',
        'view_adverts',
        'view_clients',
        'view_projects',
        'view_invoices',
        'view_daily_activities',
        'view_quotes',
        'view_tasks',
        'view_business_dev',
    ];*/

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    # Query Scopes

    # Relationships

    function users()
    {
        return $this->hasMany(User::class);
    }

    # Accessors & Mutators
}
