<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Interfaces\AuthorRepositoryInterface;
use App\Models\Author;
use App\Traits\RespondsWithJson;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
    */
    public function store(StoreAuthorRequest $request)
    {
        $author = $this->authorRepository->create($request);

        if ($author === false) {
            return $this->errorResponse(__('app.author_exists'), 409);
        }

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


    /**
    * Update the specified image.
    *
    * @param Request $request
    * @param int $id
    * @return JsonResponse
    */
    public function updateMedia(Request $request, Author $author)
    {
        $updated = $this->authorRepository->updateMedia($request, $author);
        return response()->json(['message' => __('app.media_updated'), 'author' => new AuthorResource($updated)]);     
    }

    /**
    * Get the author's versions based on the provided author ID.
    *
    * @param int $id The unique identifier of the author whose versions are to be retrieved.
    *
    */
    public function getVersions($id)
    {
        return $this->authorRepository->getVersion($id);
    }
}
