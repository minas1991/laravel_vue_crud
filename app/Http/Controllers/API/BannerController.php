<?php

declare (strict_types = 1);

namespace App\Http\Controllers\API;

use App\Http\Requests\BannerRequest;
use App\Repositories\BannerRepository;
use Illuminate\Http\JsonResponse;

class BannerController extends APIController
{
    /**
     * Associated repository manager
     *
     * @var BannerRepository $repository
     */
    protected $repository;

    /**
     * The __construct magic method
     *
     * @param  BannerRepository $repository
     */
    public function __construct(BannerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BannerRequest $request
     *
     * @return JsonResponse
     */
    public function store(BannerRequest $request): JsonResponse
    {
        return $this->response($this->repository->create($request->all()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BannerRequest  $request
     * @param  int|string  $id
     *
     * @return JsonResponse
     */
    public function update(BannerRequest $request, int | string $id): JsonResponse
    {
        return $this->response($this->repository->update($request->all(), $id));
    }
}
