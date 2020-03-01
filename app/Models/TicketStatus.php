<?php
/**
 * @package    Controller
 ****************************************************
 * @date       02/29/2020 11:47 AM
 */

declare(strict_types=1);

namespace App\Models;

use App\Traits\CreationDataTrait;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class TicketStatus extends Model
{

    const UNDER_DEVELOPMENT = 3;
    const CLIENT_REVIEW = 2;
    const CTO_REVIEW = 1;
    const ONHOLD = 0;
    const COMPLETED = 4;

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
    protected $table = 'ticket_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'order',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    /*protected $guarded = [
        'name',
        'order',
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

    # Accessors & Mutators
}
