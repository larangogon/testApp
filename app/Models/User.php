<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active'
    ];

    /**
     * The attributes that should be hidden for serialization.
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
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * @param $role
     */
    public function asignarRol($role): void
    {
        $this->roles()
            ->sync($role, false);
    }

    /**
     * @return mixed
     */
    public function tieneRol()
    {
        return $this->roles
            ->flatten()
            ->pluck('name')
            ->unique();
    }

    /**
     * @return mixed
     */
    public function getCacheUser()
    {
        return Cache::remember('users', now()->addDay(), function () {
            return $this->all();
        });
    }

    /**
     * @param $query
     * @param $search
     * @return void
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('name', 'LIKE', "%$search%");
        }
    }

    /**
     * @param $query
     * @param $role
     * @return void
     */
    public function scopeRole($query, $role)
    {
        if (empty($role)) {
            return;
        }

        return  $query->whereHas('roles', function ($query) use ($role) {
            $query->where('name', $role);
        });
    }
}
