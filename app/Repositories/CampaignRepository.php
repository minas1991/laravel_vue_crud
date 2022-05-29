<?php

declare (strict_types = 1);

namespace App\Repositories;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CampaignRepository extends BaseRepository
{
    /**
     * Eloquent model instance
     *
     * @var Campaign $model
     */
    protected $model;

    /**
     * Load default class dependencies.
     *
     * @param Campaign $model
     */
    public function __construct(Campaign $model)
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
        $data = parent::all();
        $data->map(function ($row) {
            $row->status = $row->getStatus();
            return $row;
        });

        return $data;
    }

    /**
     * Create a new recource
     *
     * @param  array $data
     *
     * @return Campaign
     */
    public function create(array $data): Campaign
    {
        DB::beginTransaction();

        // Save model with relation data
        $this->model->fill($data);
        $this->model->save();

        $this->model->saveBanners($data['banners'] ?? []);
        $this->model->saveMetadata($data['metadata'] ?? []);

        DB::commit();

        return $this->model->fresh();
    }

    /**
     * Update recource by id
     *
     * @param  array $data
     * @param  int|string $id
     *
     * @return Campaign
     */
    public function update(array $data, int | string $id): Campaign
    {
        DB::beginTransaction();

        // Save model with relation data
        $this->model = $this->find($id);
        $this->model->fill($data);
        $this->model->save();

        $this->model->saveBanners($data['banners'] ?? []);
        $this->model->saveMetadata($data['metadata'] ?? []);

        DB::commit();

        return $this->model;
    }
}
