<?php

declare (strict_types = 1);

namespace App\Repositories;

use App\Models\Banner;

class BannerRepository extends BaseRepository
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
     * @param Model $model Illuminate\Database\Eloquent\Model
     */
    public function __construct(Banner $model)
    {
        $this->model = $model;
    }
}
