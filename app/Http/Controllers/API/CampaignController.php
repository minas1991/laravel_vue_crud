<?php

declare (strict_types = 1);

namespace App\Http\Controllers\API;

use App\Http\Requests\CampaignRequest;
use App\Repositories\CampaignRepository;
use Illuminate\Http\JsonResponse;

class CampaignController extends APIController
{
    /**
     * Associated repository manager
     *
     * @var CampaignRepository $repository
     */
    protected $repository;

    /**
     * The __construct magic method
     *
     * @param  CampaignRepository $repository
     */
    public function __construct(CampaignRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CampaignRequest $request
     *
     * @return JsonResponse
     */
    public function store(CampaignRequest $request): JsonResponse
    {
        return $this->response($this->repository->create($request->all()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CampaignRequest  $request
     * @param  int|string  $id
     *
     * @return JsonResponse
     */
    public function update(CampaignRequest $request, int | string $id): JsonResponse
    {
        return $this->response($this->repository->update($request->all(), $id));
    }
}
