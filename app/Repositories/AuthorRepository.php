<?php

namespace App\Repositories;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Interfaces\AuthorRepositoryInterface;
use App\Models\Author;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AuthorRepository implements AuthorRepositoryInterface
{
    protected $imageUploadService;

    public function __construct(ImageService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }
    /**
     * Retrieve all authors.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        //return Author::all();
        return Author::with('media')->get();
    }

    /**
     * Find an author by their ID.
     *
     * @param int $id
     * @return Model|null
     */
    public function find($id): ?Model
    {
        return Author::with('media')->find($id);
    }

    /**
     * Store a new author.
     *
     * @param StoreAuthorRequest $request
     * @return Model
     */
    public function create(StoreAuthorRequest $request)
    {
        // existing user control
        $existingAuthor = Author::where('name', $request->name)->first();

        // if user exists, return false
        if ($existingAuthor) {
            return false; 
        }

        $author = Author::create($request->validated());

        // Check if an image is uploaded and upload it
        if ($request->hasFile('image')) {
            $this->imageUploadService->uploadImage($author, $request->file('image'), 'author');
        }

        // get author information with the uploaded image. 
        $author->load('media'); 

        return $author;
    }

    /**
     * Update an existing author.
     *
     * @param UpdateAuthorRequest $request
     * @param Model $model
     * @return Model
     */
    public function update(UpdateAuthorRequest $request, Model $model): Model
    {
        $model->update($request->validated());
        return $model;
    }

    /**
    * Update the media for a given book.
    *
    * @param Request $request
    * @param Model $model
    * @return \Illuminate\Http\JsonResponse
    */
    public function updateMedia(Request $request, Model $model)
    {
        // Retrieve the existing media items associated with the book
        $media = $model->getMedia('author');

        // Check if media items exist
        if (!$media) {
            return response()->json(['message' => __('app.media_not_found')], 404); 
        }

        // Check if a new image file has been uploaded
        if ($request->hasFile('image')) {
            $this->imageUploadService->updateImage($model, $request->file('image'), 'author');
        }

        // Load the media relationship to include media data in the response
        $model->load('media');

        return $model;     
    }


    /**
    * Get versions for the author by its ID.
    *
    * @param int $id
    */
    public function getVersion($id)
    {
        $author = $this->find($id);
    
        if (!$author) {
            return response()->json(['error' => __('app.author_not_found')], 404); 
        }
    
        $versions = $author->versions;
    
        if ($versions->isEmpty()) {
            return response()->json(['error' => __('app.version_not_found')], 404); 
        }
    
        $formattedVersions = $versions->map(function ($version) {
            $modelData = unserialize($version->model_data);
            return [
                'version_id' => $version->version_id,
                'versionable_id' => $version->versionable_id,
                'user_id' => $version->user_id,
                'data' => $modelData,
                'created_at' => $version->created_at->format('Y-m-d H:i:s'),
            ];
        });
    
        return response()->json([
            'success' => true,
            'message' => __('app.version_found'),
            'data' => $formattedVersions
        ]);
    }
    

    /**
    * Delete an author by their ID.
    *
    * @param int $id
    * @return void
    */
    public function delete($id): void
    {
        $author = $this->find($id);
        if ($author) {
            $author->delete();
        }
    }
}
