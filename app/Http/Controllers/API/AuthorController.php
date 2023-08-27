<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Requests\AuthorStoreRequest;

class AuthorController extends Controller
{
    public function index() {
        return Author::all();
    }

    public function show($id) {
        $author = Author::find($id);
        if(!$author) return response()->json(['message' => 'Not found'], 404);

        return response()->json(['data' => $author], 200);
    }

    public function store(AuthorStoreRequest $request) {
        $author = Author::create($request->validated());

        return response()->json(['data' => $author], 200);
    }

    public function update(Request $request, $id) {
        $author = Author::find($id);
        if(!$author) return response()->json(['message' => 'Not found'], 404);

        $author->update($request->all());
        return response()->json(['data' => $author], 200);
    }

    public function delete($id) {
        $author = Author::find($id);
        if(!$author) return response()->json(['message' => 'Not found'], 404);

        $success = $author->delete();
        if($success)
            return response()->json(['message' => 'Deletion successful'], 200);

        return response()->json(['message' => 'Deletion failed'], 500);
    }
}
