<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Document extends Model
{
    use HasFactory;

    // Specify the database table name
    protected $table = 'documents';

    protected $fillable = [
        'proposal_title',
        'slug',
        'research_role',
        'proposal_level',
        'comments',
        'document_path',
        'ethical_approval_path',
        'payment_receipt_path',
        'applicants_cvs_path',
        'research_plan_path'
    ];

    /**
     * Boot method to automatically generate a slug when saving a document.
     */
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
}
