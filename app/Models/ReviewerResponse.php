<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewerResponse extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_id',
         'reviewer_id', 
        'sdcs_response',
        'psmt_response',
        'usmd_response',
        'mpin_response',
        'rrpr_response',
        'icps_response',
        'cprp_response',
        'ccid_response',
        'aoic_response',
    ];
}
