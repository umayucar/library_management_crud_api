<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'author_id' => $this->author_id,
            'title' => $this->title,
            'description' => $this->description,
            'publication_year' => $this->publication_year,
            'publisher' => $this->publisher, 
            'page_count' => $this->page_count, 
            'created_at' => $this->created_at->format('Y-m-d H:i:s'), 
            'author' => $this->whenLoaded('author', function () {
                return [
                    'id' => $this->author->id,
                    'name' => $this->author->name,
                    'biography' => $this->author->biography,
                ];
            }),
            'library' => $this->library->map(function ($library) {
                return [
                    'id' => $library->id,
                    'name' => $library->name,
                    'location' => $library->location,
                ];
            }),
            'media' => $this->whenLoaded('media', function () {
                return $this->media->map(function ($mediaItem) {
                    return [
                        'book_id' => $mediaItem->model_id,
                        'file_name' => $mediaItem->file_name,
                        'mime_type' => $mediaItem->mime_type,
                        'created_at' => $mediaItem->created_at->format('Y-m-d H:i:s'),
                    ];
                });
            }),
        ];
    }
}
