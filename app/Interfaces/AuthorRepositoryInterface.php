<?php

namespace App\Interfaces;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use Illuminate\Database\Eloquent\Model;

interface AuthorRepositoryInterface 
{
    /**
    * Retrieve all authors.
    *
    * @return Collection
    */
    public function all();

    /**
    * Find an author by their ID.
    *
    * @param int $id
    * @return Model|null
    */
    public function find($id);

    /**
    * Store a new author.
    *
    * @param StoreAuthorRequest $request
    * @return Model
    */
    public function create(StoreAuthorRequest $request): Model;

    /**
    * Update an existing author.
    *
    * @param UpdateAuthorRequest $request
    * @param Model $model
    * @return Model
     */
    public function update(UpdateAuthorRequest $request, Model $model): Model;

    /**
    * Delete an author by their ID.
    *
    * @param int $id
    * @return void
    */
    public function delete($id);
}
