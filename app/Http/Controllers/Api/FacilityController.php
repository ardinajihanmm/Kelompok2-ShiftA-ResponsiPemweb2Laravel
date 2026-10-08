<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use App\Http\Resources\FacilityResource;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index(Request $request)
    {
        $query = Facility::with('category')
            ->latest();

        // Search berdasarkan nama atau lokasi
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Pagination
        $facilities = $query->paginate(
            $request->integer('per_page', 10)
        );

        return FacilityResource::collection($facilities);
    }

    public function store(StoreFacilityRequest $request)
    {
        $facility = Facility::create(
            $request->validated()
        );

        $facility->load('category');

        return (new FacilityResource($facility))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Facility $facility)
    {
        $facility->load('category');

        return new FacilityResource($facility);
    }

    public function update(
        UpdateFacilityRequest $request,
        Facility $facility
    ) {
        $facility->update(
            $request->validated()
        );

        $facility->load('category');

        return new FacilityResource($facility);
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();

        return response()->json([
            'message' => 'Fasilitas berhasil dihapus.',
        ]);
    }
}