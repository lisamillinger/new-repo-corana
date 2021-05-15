<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class People extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $fillable = ['id', 'firstName', 'lastName', 'birthday', 'gender', 'sv_number', 'address',
        'email', 'password', 'telephone_number', 'isVaccinated', 'isAdmin'];

    public function vaccination(){
        return $this->belongsToMany(Vaccination::class);
    }


    protected $hidden = [
        'password', 'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return ['people' => ['id' => $this->id, 'isAdmin' => $this->isAdmin, 'sv_number' => $this->sv_number]];
    }
}
