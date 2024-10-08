<?php

namespace App\Interfaces;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface BookRepositoryInterface
{
    /**
    * Retrieve all books.
    *
    * @return Collection
    */
    public function all();

    /**
    * Find a book by its ID.
    *
    * @param int $id
    * @return Model|null
    */
    public function find($id);

    /**
    * Store a new book.
    *
    * @param StoreBookRequest $request
    * @return Model
    */
    public function create(StoreBookRequest $request): Model;

    /**
    * Update an existing book.
    *
    * @param UpdateBookRequest $request
    * @param Model $model
    * @return Model
    */
    public function update(UpdateBookRequest $request, Model $model): Model;


    /**
    * Get versions of the model.
    *
    * @param int $id
    * @return Model|null
    */
    public function getVersion($id);

    /**
    * Update the media for a given book.
    *
    * @param Request $request
    * @param Model $model
    * @return \Illuminate\Http\JsonResponse
    */
    public function updateMedia(Request $request, Model $model);
    
    /**
    * Delete a book by its ID.
    *
    * @param int $id
    * @return void
    */
    public function delete($id);
}
