<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matched extends Model
{
    protected $table = 'matched_users';

    protected $fillable = [
        'matched_emails',
        'matched_names',
        'score'
    ];

    protected $casts = [
        'matched_emails' => 'array',
        'matched_names' => 'array',
    ];
}

