<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'title',
        'content',
        'report_time'
    ];

    public function getReports()
    {
        return $this->get();
    }
}