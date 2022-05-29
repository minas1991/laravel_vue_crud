<?php

declare (strict_types = 1);

namespace App\Http\Controllers\API;

use App\Repositories\BaseRepository;
use Illuminate\Http\JsonResponse;

class APIController
{
    /**
     * Base repository manager
     *
     * @var BaseRepository $repository
     */
    protected $repository;

    /**
     * The __construct magic method
     *
     * @param  BaseRepository $repository
     */
    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->response($this->repository->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int|string  $id
     *
     * @return JsonResponse
     */
    public function show(int | string $id): JsonResponse
    {
        return $this->response($this->repository->find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int|string  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int | string $id): \Illuminate\Http\Response
    {
        return $this->repository->delete($id) ? response()->noContent(204) : response()->noContent(304);
    }

    /**
     * Return json format
     *
     * @param  mixed $result
     * @param  int   $status
     *
     * @return JsonResponse
     */
    public function response(mixed $result = null, int $status = 200): JsonResponse
    {
        return response()->json(
            array('data' => $result),
            $status
        );
    }
}
