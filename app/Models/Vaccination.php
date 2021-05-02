<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Vaccination extends Model
{

    use HasFactory;

    protected $fillable = ['key', 'information', 'date', 'max_registrations', 'current_registrations',
        'isFull'];


    public function locations() : HasMany {
        return $this->hasMany(Location::class);
    }


    public function people() : HasMany {
        return $this->hasMany(People::class);
    }
}

