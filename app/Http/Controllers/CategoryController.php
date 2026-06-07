<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;

class CategoryController extends BaseController
{
    protected CategoryService $svc;

public function __construct(CategoryService $svc)
{
    $this->svc = $svc;
}
    public function index()
    {
        return response()->json(Category::all());
    }

    public function store(StoreCategoryRequest $req)
{
    $cat = $this->svc->create($req->validated());

    return response()->json([
        'status' => 'success',
        'data' => $cat,
        'message' => 'Kategori berhasil dibuat'
    ], 201);
}

    public function show($id)
{
    try {

        $cat = $this->svc->find($id);

        return response()->json([
            'status' => 'success',
            'data' => $cat,
            'message' => 'Berhasil menarik satu data kategori'
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'status' => 'error',
            'data' => null,
            'message' => $e->getMessage()
        ], 404);
    }
}

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json($category);
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Kategori berhasil dihapus'
        ]);
    }
}