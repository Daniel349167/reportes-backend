<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateReportJob;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function generateReport(Request $request)
    {
        $request->validate([
            'title'      => 'required|string',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        GenerateReportJob::dispatch(
            $request->title,
            $request->start_date,
            $request->end_date
        );

        return response()->json([
            'message' => 'Reporte en proceso'
        ], 200);
    }

    public function listReports()
    {
        $reports = Report::orderBy('created_at', 'desc')->get();
        return response()->json($reports);
    }

    public function getReport($id)
    {
        $report = Report::findOrFail($id);
        return response()->json($report);
    }
}
