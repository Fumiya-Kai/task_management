<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function index()
    {
        $reports = $this->report->getReports();
        return view('report.index', compact('reports'));
    }

    public function create()
    {
        return view('report.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $this->report->saveNew($input);
        return redirect()->route('report.index');
    }
}
