<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class User extends Authenticatable
{

    use HasFactory, Notifiable, HasRoles, SoftDeletes, SoftCascadeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    // protected $guard_name = 'api';

    protected $fillable = [
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'mobile_number',
        'email',
        'email_address',
        'affiliation',
        'password',
        'login_code',
        'classification',
        'api_token',
        'registrant_id',
        'prc_no',
        'hospital_affiliation',
        'name_on_cert',
        'position',
    ];

    /**
     * The attributes that are soft deleted relationships.
     *
     * @var array
     */
    protected $softCascade = [
        'profile',
        'messages',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'api_token',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_number_verified_at' => 'datetime',
    ];

    public function profile()
    {

        return $this->hasOne(UserProfile::class);
    }

    public function messages()
    {

        return $this->hasMany(UserMessage::class);
    }

    public function booth()
    {

        return $this->hasOne(Booth::class);
    }

    public function boothMessages()
    {

        return $this->hasMany(UserMessage::class);
    }

    public function events()
    {

        return $this->hasMany(UserEvent::class);
    }

    public function answers()
    {

        return $this->hasMany(QuestionAnswer::class);
    }

    public function webinars()
    {

        return $this->hasMany(UserWebinar::class);
    }

    public function fellowships()
    {

        return $this->hasMany(UserFellowship::class);
    }

    public function chats()
    {

        return $this->hasMany(ChatMessage::class);
    }

    public function chat_messages()
    {

        return $this->hasMany(ChatMessage::class);
    }

    public function activities()
    {

        return $this->hasMany(UserActivity::class);
    }
}
