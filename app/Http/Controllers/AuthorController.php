<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Interfaces\AuthorRepositoryInterface;
use App\Traits\RespondsWithJson;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    use RespondsWithJson;
    protected $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
    * Display a listing of the authors.
    *
    */
    public function index()
    {
        $authors = $this->authorRepository->all();
        return AuthorResource::collection($authors);
    }

    /**
    * Display the specified author.
    *
    * @param int $id
    * @return JsonResponse
    */
    public function show($id): JsonResponse
    {
        $author = $this->authorRepository->find($id);

        if ($author) {
            return $this->successResponse(__('app.author_found'), new AuthorResource($author));
        }

        return $this->errorResponse(__('app.author_not_found'), 404);
    }

    /**
    * Store a newly created author.
    *
    * @param StoreAuthorRequest $request
    * @return JsonResponse
    */
    public function store(StoreAuthorRequest $request): JsonResponse
    {
        $author = $this->authorRepository->create($request);

        return $this->successResponse(__('app.author_added'), new AuthorResource($author));
    }

    /**
    * Update the specified author.
    *
    * @param UpdateAuthorRequest $request
    * @param int $id
    * @return JsonResponse
    */
    public function update(UpdateAuthorRequest $request, $id): JsonResponse
    {
        $author = $this->authorRepository->find($id);

        if ($author) {
            $updatedAuthor = $this->authorRepository->update($request, $author);
            return $this->successResponse(__('app.author_updated'), new AuthorResource($updatedAuthor));
        }

        return $this->errorResponse(__('app.author_not_found'), 404);
    }

    /**
    * Remove the specified author.
    *
    * @param int $id
    * @return JsonResponse
    */
    public function destroy($id): JsonResponse
    {
        $author = $this->authorRepository->find($id);

        if (!$author) {
            return $this->errorResponse(__('app.author_not_found'), 404);
        }

        $this->authorRepository->delete($id);
        return $this->successResponse(__('app.author_deleted'));
    }
}
