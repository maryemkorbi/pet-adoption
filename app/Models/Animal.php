<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Animal extends Model
{
    public const SPECIES = ['cat', 'dog', 'rabbit', 'bird', 'other'];

    public const GENDERS = ['male', 'female'];

    public const STATUSES = ['available', 'reserved', 'adopted'];

    protected $fillable = [
        'shelter_id',
        'name',
        'species',
        'breed',
        'age',
        'gender',
        'description',
        'vaccinated',
    ];

    protected function casts(): array
    {
        return [
            'vaccinated' => 'boolean',
        ];
    }

    public function shelter(): BelongsTo
    {
        return $this->belongsTo(Shelter::class);
    }
}
