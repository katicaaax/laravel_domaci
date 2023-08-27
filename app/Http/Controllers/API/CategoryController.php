<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{
    public function index() {
        return Category::all();
    }

    public function show($id) {
        $category = Category::find($id);
        if(!$category) return response()->json(['message' => 'Not found'], 404);

        return response()->json(['data' => $category], 200);
    }

    public function store(CategoryStoreRequest $request) {
        $category = Category::create($request->validated());

        return response()->json(['data' => $category], 200);
    }

    public function update(Request $request, $id) {
        $category = Category::find($id);
        if(!$category) return response()->json(['message' => 'Not found'], 404);

        $category->update($request->all());
        return response()->json(['data' => $category], 200);
    }

    public function delete($id) {
        $category = Category::find($id);
        if(!$category) return response()->json(['message' => 'Not found'], 404);

        $success = $category->delete();
        if($success)
            return response()->json(['message' => 'Deletion successful'], 200);

        return response()->json(['message' => 'Deletion failed'], 500);
    }
}
