<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shelter extends Model
{
    protected $fillable = [
        'name',
        'city',
        'phone',
        'email',
    ];

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }
}
