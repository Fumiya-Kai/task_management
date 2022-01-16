<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class DailyReportController extends Controller
{
    private $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function index()
    {
        $reports = $this->report->getReports();
        return view('index', compact('reports'));
    }
}