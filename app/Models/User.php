<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'group_id',
        'email',
        'phone1',
        'skype',
        'whatsapp',
        'hangout',
        'job_title',
        'branch_location',
        'phone2',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_dev' => 'boolean',
    ];


    protected $dates = [
    ];

    function clients()
    {
        return $this->belongsToMany(Client::class, 'client_user');
    }

    function group()
    {
        return $this->belongsTo(Group::class);
    }

    function attachments()
    {
        return $this->hasMany(TicketFile::class);
    }


    public function canAuthInPanel()
    {
        return collect(['1', '2']);
    }

    public function getFirstNameAttribute()
    {
        $names = explode(' ', $this->name);

        if (is_array($names)) {

            return $names[0];
        } else {
            return $this->name;
        }
    }

    public function getNameWithDocumentNumberAttribute()
    {
        return $this->name . ' (' . $this->document_number . ')';
    }

    public function isAdmin()
    {
        return ($this->group_id == \App\Models\Group::CLIENT || $this->group_id == \App\Models\Group::DEVELOPER);
    }

    public function isClient()
    {
        return ($this->group_id == \App\Models\Group::CLIENT);
    }

    function types()
    {
        return $this->belongsToMany(Type::class, 'user_types', 'user_id', 'type_id');
    }

}
