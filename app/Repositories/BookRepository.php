<?php

namespace App\Repositories;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BookRepository implements BookRepositoryInterface
{
    protected $imageUploadService;

    public function __construct(ImageService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    /**
     * Retrieve all books.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        //return Book::all();
        return Book::with('author', 'library', 'media')->get();
    }

    /**
     * Find a book by its ID.
     *
     * @param int $id
     * @return Model|null
     */
    public function find($id): ?Model
    {
        return Book::with('author', 'library', 'media')->find($id);
    }

    /**
     * Store a new book.
     *
     * @param StoreBookRequest $request
     * @return Model
     */
    public function create(StoreBookRequest $request): Model
    {
        $book = Book::create($request->validated());

        // Check if an image is uploaded and upload it
        if ($request->hasFile('image')) {
            $this->imageUploadService->uploadImage($book, $request->file('image'), 'book');
        }

        // Library information add to pivot table
        if ($request->has('library_id')) {
            $book->library()->attach($request->input('library_id')); 
        }

        $book->load(['author', 'library', 'media']);
        
        return $book;
    }

    /**
     * Update an existing book.
     *
     * @param UpdateBookRequest $request
     * @param Model $model
     * @return Model
     */
    public function update(UpdateBookRequest $request, Model $model): Model
    {
        $model->update($request->validated());

        // update library pivot table
        if ($request->has('library_id')) {
            $model->library()->sync([$request->input('library_id')]);  
        }

        // update author information
        if ($request->has('author_id')) {
            $model->author()->sync([$request->input('author_id')]); 
        }

        $model->load('library', 'author');

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
        $media = $model->getMedia('book');

        // Check if media items exist
        if (!$media) {
            return response()->json(['message' => __('app.media_not_found')], 404); 
        }

        // Check if a new image file has been uploaded
        if ($request->hasFile('image')) {
            $this->imageUploadService->updateImage($model, $request->file('image'), 'book');
        }

        // Load the media relationship to include media data in the response
        $model->load('media');

        return $model;    
    }

    /**
     * Delete a book by its ID.
     *
     * @param int $id
     * @return void
     */
    public function delete($id): void
    {
        $book = $this->find($id);
        if ($book) {
            $book->library()->detach();
            $book->author()->detach();
            $book->delete();
        }
    }
}
