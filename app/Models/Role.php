<?php

namespace App\Models;
//use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Role extends Model
{
    public $table = 'roles';
    use HasFactory, Sluggable;
    protected $fillable = ['name'];
	
	// We have a role and it hasMany users
   


public function users()
{
    return $this->hasMany(User::class, 'role_id'); // A role has many users
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
