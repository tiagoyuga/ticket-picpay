<?php
/**
 * @package    Controller
 ****************************************************
 * @date       02/29/2020 11:48 AM
 */

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
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
    protected $table = 'tickets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid',
        'client_id',
        'user_id',
        'cto_id',
        'dev_id',
        'ticket_status_id',
        'subject',
        'content',
        'priority',
        'dev_estimated_time',
        'dev_hour_spent',
        'cto_hours',
        'payment_status',
        'payment_date',
    ];


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    /*protected $guarded = [
        'client_id',
        'user_client_id',
        'cto_id',
        'dev_id',
        'ticket_status_id',
        'subject',
        'content',
        'priority',
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
    protected $dates = ['payment_date'];

    # Query Scopes

    # Relationships

    function status()
    {
        return $this->belongsTo(TicketStatus::class, 'ticket_status_id', 'id');
    }

    function userClient()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    function cto()
    {
        return $this->belongsTo(User::class, 'cto_id', 'id');
    }

    function dev()
    {
        return $this->belongsTo(User::class, 'dev_id', 'id');
    }

    function comments()
    {
        return $this->hasMany(TicketComment::class);
    }

    function activities()
    {
        return $this->hasMany(TicketActivity::class);
    }

    function files()
    {
        return $this->hasMany(TicketFile::class);
    }

    # Accessors & Mutators
}
