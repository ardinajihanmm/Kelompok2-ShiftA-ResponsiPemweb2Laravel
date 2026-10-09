<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with(['user', 'facility'])
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $reports,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'facility_id' => 'required|exists:facilities,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $report = Report::create([
            'user_id' => $request->user()->id,
            'facility_id' => $validated['facility_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'status' => 'menunggu',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dibuat',
            'data' => $report->load(['user', 'facility']),
        ], 201);
    }

    public function show(Report $report)
    {
        $report->load(['user', 'facility', 'comments']);

        return response()->json([
            'success' => true,
            'data' => $report,
        ]);
    }

    public function update(Request $request, Report $report)
    {
        $validated = $request->validate([
            'facility_id' => 'sometimes|exists:facilities,id',
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'priority' => 'sometimes|in:low,medium,high',
            'status' => 'sometimes|in:menunggu,diproses,selesai,ditolak',
        ]);

        $report->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil diperbarui',
            'data' => $report->fresh()->load(['user', 'facility']),
        ]);
    }

    public function destroy(Report $report)
    {
        $report->delete();

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dihapus',
        ]);
    }
}