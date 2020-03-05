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
        'additional_email',
        'phone1',
        'phone2',
        'skype',
        'whatsapp',
        'hangout',
        'job_title',
        'branch_location',
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

    public function getIsAdminAttribute()
    {
        return ($this->group_id == \App\Models\Group::ADMIN);
    }

    public function getIsDevAttribute()
    {
        return ($this->group_id == \App\Models\Group::DEVELOPER);
    }

    public function getIsCtoAttribute()
    {
        return ($this->group_id == \App\Models\Group::CTO);
    }

    public function getIsClientAttribute()
    {
        return ($this->group_id == \App\Models\Group::CLIENT);
    }

    function types()
    {
        return $this->belongsToMany(Type::class, 'user_types', 'user_id', 'type_id');
    }

    public function userTypes()
    {
        return $this->hasMany(UserType::class, 'user_id');
    }

    public function isClientAdmim()
    {
        $userTypes = $this->userTypes();
        #dd($this->id, $userTypes->pluck('type_id')->toArray());
        if($userTypes) {
            return (in_array(Type::ADMIN, $userTypes->pluck('type_id')->toArray()));
        }

        return false;

       /* $userTypes = UserType::where('user_id', $this->id)->get();
        #dd($this->id, $userTypes->pluck('type_id')->toArray());
        if($userTypes) {
            return (in_array(Type::ADMIN, $userTypes->pluck('type_id')->toArray()));
        }

        return false;*/


    }

    public function clientUser()
    {
        return $this->hasMany(ClientUser::class, 'user_id');
    }

    public function checkCanSharePublicRegisterLink()
    {
        if ($this->getIsClientAttribute() && $this->isClientAdmim()) {

            return ($this->clientUser());
        }

        return false;
    }

}
