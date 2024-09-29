<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'biography' => $this->biography,
            'media' => $this->whenLoaded('media', function () {
                return $this->media->map(function ($mediaItem) {
                    return [
                        'author_id' => $mediaItem->model_id,
                        'file_name' => $mediaItem->file_name,
                        'mime_type' => $mediaItem->mime_type,
                        'created_at' => $mediaItem->created_at->format('Y-m-d H:i:s'),
                    ];
                });
            }),
        ];
    }
}
