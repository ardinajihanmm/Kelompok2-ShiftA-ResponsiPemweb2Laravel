<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    protected $fillable = [
        'user_id', 'facility_id', 'title', 'description', 'photo_path', 'priority', 'status',
    ];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function facility(): BelongsTo { return $this->belongsTo(Facility::class); }
    public function comments(): HasMany { return $this->hasMany(Comment::class); }
}
