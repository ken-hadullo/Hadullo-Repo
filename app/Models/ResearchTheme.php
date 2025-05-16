<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ResearchTheme extends Model
{
    public $timestamps = true;
    public $table = 'research_themes';
    
    use HasFactory, Sluggable;

    protected $fillable = ['name'];

    // Many-to-many relationship between ResearchTheme and User
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // One-to-many relationship between ResearchTheme and Document
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    // Slug for SEO
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }
}


