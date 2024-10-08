<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Interfaces\BookRepositoryInterface;
use App\Models\Book;
use App\Traits\RespondsWithJson;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use RespondsWithJson;

    protected $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display a listing of the books.
     *
     */
    public function index()
    {
        $books = $this->bookRepository->all();
        return BookResource::collection($books);
    }

    /**
     * Display the specified book.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $book = $this->bookRepository->find($id);

        if ($book) {
            return $this->successResponse(__('app.book_found'), new BookResource($book));
        }
        return $this->errorResponse(__('app.book_not_found'), 404);
    }

    /**
     * Store a newly created book.
     *
     * @param StoreBookRequest $request
     * @return JsonResponse
     */
    public function store(StoreBookRequest $request): JsonResponse
    {
        $book = $this->bookRepository->create($request);
        return $this->successResponse(__('app.book_added'), new BookResource($book));
    }

    /**
     * Update the specified book.
     *
     * @param UpdateBookRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateBookRequest $request, $id): JsonResponse
    {
        $book = $this->bookRepository->find($id);

        if ($book) {
            $updatedBook = $this->bookRepository->update($request, $book);
            return $this->successResponse(__('app.book_updated'), new BookResource($updatedBook));
        }
        return $this->errorResponse(__('app.book_not_found'), 404);
    }

    /**
     * Remove the specified book.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $book = $this->bookRepository->find($id);

        if (!$book) {
            return $this->errorResponse(__('app.book_not_found'), 404);
        }

        $this->bookRepository->delete($id);
        return $this->successResponse(__('app.book_deleted'));
    }

    /**
    * Update the specified image.
    *
    * @param Request $request
    * @param int $id
    * @return JsonResponse
    */
    public function updateMedia(Request $request, Book $book)
    {
        $updated = $this->bookRepository->updateMedia($request, $book);
        return response()->json(['message' => __('app.media_updated'), 'author' => new BookResource($updated)]); 
    }

    /**
    * Get the books' versions based on the provided author ID.
    *
    * @param int $id The unique identifier of the author whose versions are to be retrieved.
    *
    */
    public function getVersions($id)
    {
        return $this->bookRepository->getVersion($id);
    }
}
