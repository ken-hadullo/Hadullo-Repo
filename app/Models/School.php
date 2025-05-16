<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
//use Spatie\Permission\Traits\HasRoles;

class School extends Model
{
    public $timestamps = true;
    public $table = 'schools';
    use HasFactory, Sluggable;
    protected $fillable = ['name'];


// We have a school and it hasMany users

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
