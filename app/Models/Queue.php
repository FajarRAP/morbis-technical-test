<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $fillable = [
        'number',
        'status',
        'date',
        'served_at',
        'completed_at',
    ];

    protected $casts = [
        'date' => 'date',
        'served_at' => 'datetime',
        'completed_at' => 'datetime',
    ];
}
