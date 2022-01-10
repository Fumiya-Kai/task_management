<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'task',
        'target_id',
        'start',
        'end_schedule',
        'end',
        'order'
    ];

    public function target()
    {
        return $this->belongsTo(Target::class, 'target_id');
    }
}
