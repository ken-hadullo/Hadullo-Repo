<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Document extends Model
{
    use HasFactory;

    // Specify the database table name
    protected $table = 'documents';


    protected $casts = [
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'assigned_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'approved_at',
        'rejected_at',
        'assigned_at',
        'proposal_title',
        'status',
        'rejection_message',
        'research_role_id',
        'school_id',
        'department_id',
        'proposal_level_id',
        'proposal_doc_path',
        'ethical_approval_path',
        'payment_receipt_path',
        'plagiarism_report_path',
        'applicants_cv_path',
        'comments',
        'slug',  // Added slug to fillable
    ];


     // Enable timestamps
     public $timestamps = true;

    // Status Constants
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = -1;
    const STATUS_UNDER_REVIEW = 2;
    const STATUS_DISCUSSION = 3;
    const STATUS_VERDICT = 4;

    // Status Labels for Readability
    public static function getStatusLabel($status)
    {
        $statuses = [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_APPROVED => 'Approved',
            self::STATUS_REJECTED => 'Rejected',
            self::STATUS_UNDER_REVIEW => 'Under Review',
            self::STATUS_DISCUSSION => 'Discussion',
            self::STATUS_VERDICT => 'Verdict',
        ];

        return $statuses[$status] ?? 'Unknown';
    }



public function reviews()
{
    return $this->hasMany(DocumentReview::class, 'document_id');
}

public function review()
    {
        return $this->hasOne(DocumentReview::class, 'document_id');
    }

    // Define the school relationship
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function department()
{
    return $this->belongsTo(Department::class);
}

    // Define the correct relationship: A document belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function researchRole()
    {
        return $this->belongsTo(\App\Models\ResearchRole::class, 'research_role_id');
    }

    // Relationship to ProposalLevel
    public function proposalLevel()
    {
        return $this->belongsTo(PropoLevel::class);
    }

    // Define relationship: A document belongs to a proposal level
    public function plevel()
    {
        return $this->belongsTo(PropoLevel::class, 'proposal_level_id');
    }

 

// Define the assigned reviewers relationship
public function assignedReviewers()
{
     
    return $this->belongsToMany(User::class, 'document_reviews', 'document_id', 'reviewer_id')
                ->using(DocumentReview::class)
                ->withPivot(['status', 'assigned_at'])
                ->withTimestamps();
}





public function reviewers()
{
    return $this->belongsToMany(User::class, 'document_reviews', 'document_id', 'reviewer_id')
        ->withPivot('assigned_at', 'status', 'match_score')
        ->withTimestamps();
}





 protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($document) {
            $baseSlug = Str::slug($document->proposal_title, '-');
            $slug = $baseSlug;
            $count = 1;

            while (self::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count;
                $count++;
            }

            $document->slug = $slug;
        });
    }


    // Relationship to the reviewer (who is also a user)
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }


//public function reviews()
//{
   // return $this->hasMany(User::class, 'document_id');
//}

public function author()
{
    return $this->belongsTo(User::class, 'reviewer_id');
}





}
