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
<<<<<<< HEAD
=======
>>>>>>> 1717ffa512633c16920fb88b20f0261f3cbe0646
>>>>>>> 11b79d0503820be29c9e99fff948bef4cce0607b
>>>>>>> 5f287d4ee30cd078aa0738cb9042e57796871337
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
