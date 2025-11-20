<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'company',
        'location',
        'description',
        'salary',
        'job_type',
        'user_id',
        'posted_at',
    ];

    protected $casts = [
        'posted_at' => 'datetime',
    ];

    // --- Relationships ---
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // --- Query Scopes ---
    /**
     * Scope for searching across title, company, and location.
     */
    public function scopeSearch(Builder $query, ?string $searchTerm)
{
    if (!$searchTerm) {
        return $query;  // return the original query
    }

    return $query->where(function ($q) use ($searchTerm) {
        $q->where('title', 'LIKE', "%{$searchTerm}%")
          ->orWhere('company', 'LIKE', "%{$searchTerm}%")
          ->orWhere('location', 'LIKE', "%{$searchTerm}%");
    });
}
}