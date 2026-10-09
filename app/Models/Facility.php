<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facility extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'location',
        'description',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
<<<<<<< HEAD

=======
>>>>>>> 1717ffa512633c16920fb88b20f0261f3cbe0646
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}