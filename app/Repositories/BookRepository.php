<?php

namespace App\Repositories;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
        return Book::all();
    }

    /**
     * Find a book by its ID.
     *
     * @param int $id
     * @return Model|null
     */
    public function find($id): ?Model
    {
        return Book::find($id);
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
            $book->delete();
        }
    }
}
