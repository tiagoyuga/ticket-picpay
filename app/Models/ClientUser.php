<?php
/**
 * @package    Controller
 ****************************************************
 * @date       02/28/2020 7:30 AM
 */

declare(strict_types=1);

namespace App\Models;

use App\Traits\CreationDataTrait;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class ClientUser extends Model
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
    #protected $table = 'user_client';
    protected $table = 'client_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'client_id',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    /*protected $guarded = [
        'user_id',
        'advert_id',
        'seller_id',
        'project_manager_id',
        'company_name',
        'contact_name',
        'cell_phone',
        'additional_phone',
        'project_scope',
        'status',
        'lead_status',
        'priority',
        'email',
        'credit_amount',
        'text_credit_history',
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
        return $this->belongsTo(User::class, 'client_id');
    }

    function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function scopeIsClientInThisCompany($query, $client_id)
    {
        return $query->select('client_user.*')
            ->where('client_user.client_id','=', $client_id)
            ->where('client_user.user_id','=', \Auth::id())
            ->get();
    }

    # Accessors & Mutators
}
