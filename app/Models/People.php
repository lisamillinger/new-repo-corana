<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class People extends Model
{
    use HasFactory;

    protected $fillable = ['firstName', 'lastName', 'birthday', 'gender', 'sv_number', 'address',
        'email', 'password', 'telephone_number', 'isVaccinated', 'isAdmin'];

    public function vaccination() : BelongsTo{
        return $this->belongsTo(Vaccination::class);
    }


}
