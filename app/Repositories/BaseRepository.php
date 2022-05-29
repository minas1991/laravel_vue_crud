<?php

declare (strict_types = 1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    /**
     * Eloquent model instance
     *
     * @var Model $model
     */
    protected $model;

    /**
     * Load default class dependencies.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all recources
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->get();
    }

    /**
     * Find recource by id
     *
     * @param  int|string $id
     *
     * @return Model
     */
    public function find(int | string $id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Create a new recource
     *
     * @param  array $data
     *
     * @return Model
     */
    public function create(array $data): Model
    {
        $this->model->fill($data);
        $this->model->save();

        return $this->model->fresh();
    }

    /**
     * Update recource by id
     *
     * @param  array $data
     * @param  int|string $id
     *
     * @return Model
     */
    public function update(array $data, int | string $id): Model
    {
        $this->model = $this->find($id);
        $this->model->fill($data);
        $this->model->save();

        return $this->model;
    }

    /**
     * Delete recource by id
     *
     * @param  int|string $id
     *
     * @return bool
     */
    public function delete(int | string $id): bool
    {
        return (bool) $this->model->destroy($id);
    }
}
