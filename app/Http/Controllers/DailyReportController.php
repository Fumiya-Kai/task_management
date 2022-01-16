<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DailyReportController extends Controller
{
    public function __construct()
    {
        return;
    }

    public function index()
    {
        $reports = $this->report->get();
        return view('index', compact('reports'));
    }
}
