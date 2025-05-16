<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropoLevel extends Model
{
    use HasFactory;

    protected $table = 'proposal_levels'; // Explicit table name

    protected $fillable = ['name']; // Only the required fields

    public $timestamps = true;

    /**
     * Define a many-to-many relationship with the User model.
     * 
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'proposal_level_user', 'proposal_level_id', 'user_id');
    }

    // Add a name attribute if it exists
    public function getLevelName()
    {
        return $this->name; // Assuming 'level_name' is a column in the proposal_levels table
    }
}
