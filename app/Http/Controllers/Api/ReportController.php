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
        $query = Report::with(['user', 'facility'])->latest();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(fn ($q) => $q->where('title', 'like', "%{$search}%")->orWhere('description', 'like', "%{$search}%"));
        }
        if ($request->filled('status')) $query->where('status', $request->status);
        if ($request->filled('priority')) $query->where('priority', $request->priority);
        return ReportResource::collection($query->paginate($request->integer('per_page', 10)));
    }

    public function store(StoreReportRequest $request)
    {
        $data = $request->validated();
        $report = Report::create([
            'user_id' => $request->user()->id,
            'facility_id' => $data['facility_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'photo_path' => $request->file('photo')->store('report-photos', 'public'),
            'priority' => 'medium',
            'status' => 'menunggu',
        ]);
        $report->load(['user', 'facility']);
<<<<<<< HEAD
        return (new ReportResource($report))->response()->setStatusCode(201);
=======

        return (new ReportResource($report))
            ->response()
            ->setStatusCode(201);
>>>>>>> 1717ffa512633c16920fb88b20f0261f3cbe0646
>>>>>>> 11b79d0503820be29c9e99fff948bef4cce0607b
    }

    public function show(Report $report)
    {
        $report->load(['user', 'facility', 'comments']);
<<<<<<< HEAD
        return new ReportResource($report);
    }

    public function update(UpdateReportRequest $request, Report $report)
    {
        $report->update($request->validated());
        $report->load(['user', 'facility']);
        return new ReportResource($report);
=======

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
>>>>>>> 11b79d0503820be29c9e99fff948bef4cce0607b
    }

    public function destroy(Request $request, Report $report)
    {
        if ($request->user()->role !== 'admin' && $report->user_id !== $request->user()->id) {
            return response()->json(['success' => false, 'message' => 'Anda tidak memiliki akses'], 403);
        }
        $report->delete();
        return response()->json(['success' => true, 'message' => 'Laporan berhasil dihapus.']);
    }
}
