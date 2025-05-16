<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, HasRoles, Sluggable, Notifiable;

    protected $table = 'users';
    

    // Correct fields for the User model
    protected $fillable = [
        'name',
        'email',
        'password',
        'staff_std_id',
        'role_id',
        'department_id',
        'research_theme_id',
        'profile_updated',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'profile_updated' => 'boolean', // Add this line
    ];


    // Define relationship: A user has many documents
    public function documents()
    {
        return $this->hasMany(Document::class, 'user_id');
    }

    public function schoolName()
        {
        return $this->belongsTo(School::class, 'school_id', 'id');
		}

    public function departmentName()
        {
        return $this->belongsTo(Department::class, 'department_id', 'id');
		}

        public function specializationName()
        {
        return $this->belongsTo(ResearchTheme::class, 'research_theme_id', 'id');
		}

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id'); // Ensure 'role_id' is the correct foreign key
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


public function school()
{
    return $this->belongsTo(School::class, 'school_id'); // Ensure correct foreign key
}

public function department()
    {
        return $this->belongsTo(Department::class, 'department_id'); // Ensure correct foreign key
    }

   


    public function assignedPapers()
    {
        return $this->belongsToMany(Document::class, 'document_reviews', 'reviewer_id', 'document_id')
            ->withPivot('assigned_at', 'status') // Include additional pivot fields if needed
            ->withTimestamps();
    }

    public function assignedDocuments()
{
    return $this->hasMany(DocumentReview::class, 'reviewer_id');
}

}