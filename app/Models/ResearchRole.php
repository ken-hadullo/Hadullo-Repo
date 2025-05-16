<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ResearchRole extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'research_roles';
    public $timestamps = true;

    protected $fillable = ['title', 'slug']; // Added 'slug' to fillable

    /**
     * Relationship: Many-to-Many with Users
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'research_role', 'research_role_id', 'user_id')
            ->withTimestamps(); // Ensure timestamps are maintained in pivot
    }

    /**
     * Sluggable Configuration
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}


