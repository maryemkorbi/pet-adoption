<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Animal extends Model
{
    use HasFactory;

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
        'photo',
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

    public function adoptionRequests(): HasMany
    {
        return $this->hasMany(AdoptionRequest::class);
    }

    public function scopeAvailable(Builder $query): void
    {
        $query->where('status', 'available');
    }

    public function scopeOfSpecies(Builder $query, ?string $species): void
    {
        if ($species) {
            $query->where('species', $species);
        }
    }

    public function scopeSearch(Builder $query, ?string $term): void
    {
        if ($term) {
            $query->where('name', 'like', '%'.$term.'%');
        }
    }
}
