<?php

namespace App\Repositories;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Interfaces\AuthorRepositoryInterface;
use App\Models\Author;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
    public function create(StoreAuthorRequest $request): Model
    {
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
