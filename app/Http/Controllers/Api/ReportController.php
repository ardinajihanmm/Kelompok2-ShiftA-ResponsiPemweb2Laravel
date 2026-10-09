<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
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
    }

    public function show(Report $report)
    {
        $report->load(['user', 'facility', 'comments']);

        return new ReportResource($report);
    }

    public function update(
        UpdateReportRequest $request,
        Report $report
    ) {
        $report->update($request->validated());

        $report->load(['user', 'facility']);

        return new ReportResource($report);
    }

    public function destroy(Report $report)
    {
        $report->delete();

        return response()->json([
            'message' => 'Laporan berhasil dihapus.',
        ]);
    }
}