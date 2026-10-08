<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Report;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Report $report)
    {
        $comments = $report->comments()
            ->with('user:id,name,role')
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $comments,
        ]);
    }

    public function store(Request $request, Report $report)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $comment = $report->comments()->create([
            'user_id' => $request->user()->id,
            'comment' => $validated['comment'],
        ]);

        $comment->load('user:id,name,role');

        return response()->json([
            'success' => true,
            'message' => 'Tanggapan berhasil ditambahkan',
            'data' => $comment,
        ], 201);
    }

    public function update(Request $request, Comment $comment)
    {
        if ($comment->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak dapat mengubah tanggapan ini',
            ], 403);
        }

        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $comment->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Tanggapan berhasil diperbarui',
            'data' => $comment,
        ]);
    }

    public function destroy(Request $request, Comment $comment)
    {
        if (
            $comment->user_id !== $request->user()->id &&
            $request->user()->role !== 'admin'
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses',
            ], 403);
        }

        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tanggapan berhasil dihapus',
        ]);
    }
}