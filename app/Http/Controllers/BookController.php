<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Interfaces\BookRepositoryInterface;
use App\Traits\RespondsWithJson;
use Illuminate\Http\JsonResponse;

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
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $books = $this->bookRepository->all();
        return response()->json($books);
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
            return response()->json($book);
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
        return $this->successResponse(__('app.book_added'), $book);
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
            return $this->successResponse(__('app.book_updated'), $updatedBook);
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
}
