<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Services\ItemService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\BaseController;

class ItemController extends BaseController
{
    protected ItemService $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    /**
     * GET /api/items
     */
    public function index(): JsonResponse
    {
        $items = $this->itemService->all();

        return response()->json([
            'status' => 'success',
            'data' => $items,
            'message' => 'Berhasil mengambil semua data item',
        ]);
    }

    /**
     * GET /api/items/{id}
     */
    public function show(int $id): JsonResponse
    {
        $item = $this->itemService->find($id);

        return response()->json([
            'status' => 'success',
            'data' => $item,
            'message' => 'Berhasil mengambil detail item',
        ]);
    }

    /**
     * POST /api/items
     */
    public function store(StoreItemRequest $request): JsonResponse
    {
        $item = $this->itemService->create(
            $request->validated()
        );

        return response()->json([
            'status' => 'success',
            'data' => $item,
            'message' => 'Item berhasil ditambahkan',
        ], 201);
    }

    /**
     * PUT /api/items/{id}
     */
    public function update(
        UpdateItemRequest $request,
        int $id
    ): JsonResponse {

        $item = $this->itemService->update(
            $id,
            $request->validated()
        );

        return response()->json([
            'status' => 'success',
            'data' => $item,
            'message' => 'Item berhasil diperbarui',
        ]);
    }

    /**
     * DELETE /api/items/{id}
     */
    public function destroy(int $id): JsonResponse
    {
        $item = $this->itemService->find($id);

        $this->itemService->delete($id);

        return response()->json([
            'status' => 'success',
            'data' => $item,
            'message' => 'Item berhasil dihapus',
        ]);
    }
}