<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Report;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private function denyUnlessAccessible(Request $request, Report $report)
    {
        if (! $report->isAccessibleBy($request->user())) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses',
            ], 403);
        }

        return null;
    }

    public function index(Request $request, Report $report)
    {
        if ($denied = $this->denyUnlessAccessible($request, $report)) {
            return $denied;
        }

        $comments = $report->comments()
            ->with('user:id,name,role')
            ->latest()
            ->paginate(10);

        return CommentResource::collection($comments)
            ->additional([
                'success' => true,
            ]);
    }

    public function store(StoreCommentRequest $request, Report $report)
    {
        if ($denied = $this->denyUnlessAccessible($request, $report)) {
            return $denied;
        }

        $comment = $report->comments()->create([
            'user_id' => $request->user()->id,
            'comment' => $request->comment,
        ]);

        $comment->load('user:id,name,role');

        return (new CommentResource($comment))
            ->additional([
                'success' => true,
                'message' => 'Tanggapan berhasil ditambahkan',
            ])
            ->response()
            ->setStatusCode(201);
    }

    public function update(StoreCommentRequest $request, Comment $comment)
    {
        if ($comment->user_id !== $request->user()->id && $request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses',
            ], 403);
        }

        $comment->update($request->validated());
        $comment->load('user:id,name,role');

        return (new CommentResource($comment))
            ->additional([
                'success' => true,
                'message' => 'Tanggapan berhasil diperbarui',
            ]);
    }

    public function destroy(Request $request, Comment $comment)
    {
        if ($comment->user_id !== $request->user()->id && $request->user()->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses',
            ], 403);
        }

        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tanggapan berhasil dihapus',
        ], 200);
    }
}
