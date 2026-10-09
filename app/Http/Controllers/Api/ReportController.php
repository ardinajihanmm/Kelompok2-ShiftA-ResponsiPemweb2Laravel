<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
=======
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Http\Resources\ReportResource;
>>>>>>> 1717ffa512633c16920fb88b20f0261f3cbe0646
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
<<<<<<< HEAD
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
=======
    public function index(Request $request)
    {
        $query = Report::with(['user', 'facility'])
            ->latest();

        // Search judul atau deskripsi
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $perPage = $request->integer('per_page', 10);

        $reports = $query->paginate($perPage);

        return ReportResource::collection($reports);
    }

    public function store(StoreReportRequest $request)
    {
        $report = Report::create([
            'user_id' => $request->user()->id,
            'facility_id' => $request->facility_id,
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => 'menunggu',
        ]);

        $report->load(['user', 'facility']);

        return (new ReportResource($report))
            ->response()
            ->setStatusCode(201);
>>>>>>> 1717ffa512633c16920fb88b20f0261f3cbe0646
    }

    public function show(Report $report)
    {
        $report->load(['user', 'facility', 'comments']);

<<<<<<< HEAD
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
=======
        return new ReportResource($report);
    }

    public function update(
        UpdateReportRequest $request,
        Report $report
    ) {
        $report->update($request->validated());

        $report->load(['user', 'facility']);

        return new ReportResource($report);
>>>>>>> 1717ffa512633c16920fb88b20f0261f3cbe0646
    }

    public function destroy(Report $report)
    {
        $report->delete();

        return response()->json([
<<<<<<< HEAD
            'success' => true,
            'message' => 'Laporan berhasil dihapus',
=======
            'message' => 'Laporan berhasil dihapus.',
>>>>>>> 1717ffa512633c16920fb88b20f0261f3cbe0646
        ]);
    }
}