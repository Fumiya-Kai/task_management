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

    protected $dates = [
        'report_time',
    ];

    public function getReports()
    {
        return $this->get();
    }

    public function saveNew($input)
    {
        $this->fill($input)->save();
    }

    public function saveUpdated($reportId,$input)
    {
        $this->find($reportId)->fill($input)->save();
    }
}
