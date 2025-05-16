<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
//class DocumentReview extends Model
class DocumentReview extends Pivot
{
    use HasFactory;

    
    protected $table = 'document_reviews'; // Optional if table name matches convention
    
    public $timestamps = true; // Only if your pivot table has timestamps

    protected $fillable = [
        'reviewer_id',        
        'document_id', // Ensure it's included
        'assigned_at',
        'approved_at',
        'sdcs_response',
        'status',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    protected $attributes = [
        'status' => 'pending',
    ];

    /**
     * Get the reviewer (user)
     */
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    /**
     * Get the associated document
     */
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }

    /**
     * Scope for pending reviews
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for completed reviews
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope for overdue reviews
     */
    public function scopeOverdue($query)
    {
        return $query->where('status', '!=', 'completed')
                    ->whereDate('assigned_at', '<', now()->subDays(7));
    }
}
