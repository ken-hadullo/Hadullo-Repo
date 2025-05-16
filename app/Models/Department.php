<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Department extends Model
{
    public $timestamps = true;
    public $table = 'departments';
    use HasFactory, Sluggable;
    protected $fillable = ['name'];


// We have a Department and it hasMany users

   public function users() {
    return $this->belongsToMany(User::class);
}

    public function sluggable():array
    {

        return [
            'slug'=>[
                'source' => 'name'
            ]
        ];

    }
}
