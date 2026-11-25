<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shelter extends Model
{
    use HasFactory;
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
