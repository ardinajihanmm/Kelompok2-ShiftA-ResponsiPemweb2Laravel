<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        return UserResource::collection(
            $query->latest()->paginate(10)
        );
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        return (new UserResource($user))
            ->additional([
                'success' => true,
                'message' => 'User berhasil dibuat',
            ])
            ->response()
            ->setStatusCode(201);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(
        UpdateUserRequest $request,
        User $user
    ) {
        $user->update(
            $request->validated()
        );

        return (new UserResource(
            $user->fresh()
        ))->additional([
            'success' => true,
            'message' => 'User berhasil diperbarui',
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus',
        ], 200);
    }
}