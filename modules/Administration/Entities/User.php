<?php

namespace Modules\Administration\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Administration\Notifications\ResetPasswordNotification;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use HasPermissions;

    public $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'phone', 'password', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_full_name',
        'profile_gender',
        'profile_birthday',
        'profile_address',
        'profile_photo_url',
    ];

    /**
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function getProfileFullNameAttribute()
    {
        return $this->attributes['profile_full_name'] ?? "Noname";
    }

    public function getProfileGenderAttribute()
    {
        return $this->attributes['profile_gender'] ?? "Unknown";
    }

    public function getProfileBirthdayAttribute()
    {
        return $this->attributes['profile_birthday'] ?? "Unknown";
    }

    public function getProfileAddressAttribute()
    {
        return $this->attributes['profile_address'] ?? "Unknown";
    }

    public function getProfilePhotoUrlAttribute()
    {
        return !empty($this->attributes['profile_photo_url']) ? getUrlFile($this->attributes['profile_photo_url']) : '';
    }
}
