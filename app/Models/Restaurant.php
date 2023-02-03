<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Dish;
use App\Models\Type;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Restaurant extends Model
{
    use HasFactory;

    protected $guarded = [];

    // link to dishes
    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }

    // link to user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // link to types
    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class);
    }
}
