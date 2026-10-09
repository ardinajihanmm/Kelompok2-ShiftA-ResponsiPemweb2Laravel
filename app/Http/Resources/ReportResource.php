<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ReportResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'photo_path' => $this->photo_path,
            'photo_url' => $this->photo_path ? Storage::disk('public')->url($this->photo_path) : null,
            'priority' => $this->priority,
            'status' => $this->status,
            'user' => $this->whenLoaded('user', fn () => ['id' => $this->user->id, 'name' => $this->user->name, 'email' => $this->user->email]),
            'facility' => $this->whenLoaded('facility', fn () => ['id' => $this->facility->id, 'name' => $this->facility->name, 'location' => $this->facility->location]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
