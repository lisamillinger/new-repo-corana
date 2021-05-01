<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;


    protected $fillable = [
        'post_code', 'city', 'address'];


    public function vaccination() : BelongsTo {
        return $this->belongsTo(Vaccination::class);
    }
}
