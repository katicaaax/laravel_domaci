<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookStoreRequest;

class BookController extends Controller
{
    public function index() {
        return response()->json(['data' => Book::with(['user', 'author', 'category'])->get()]); //vraca za svaku knjigu usera, autora i kategoriju koje postoje u bazi
    }

    public function show($id) {
        $book = Book::with(['user', 'author', 'category'])->find($id);
        if(!$book) return response()->json(['message' => 'Not found'], 404);

        return response()->json(['data' => $book], 200);
    }

    public function store(BookStoreRequest $request) {
        $book = Book::create($request->validated()); //samo ono sto je validirano

        return response()->json(['data' => $book], 200);
    }

    public function update(Request $request, $id) {
        $book = Book::with(['user', 'author', 'category'])->find($id);
        if(!$book) return response()->json(['message' => 'Not found'], 404);

        $book->update($request->all());
        return response()->json(['data' => $book], 200);
    }

    public function delete($id) {
        $book = Book::find($id);
        if(!$book) return response()->json(['message' => 'Not found'], 404);

        $success = $book->delete();
        if($success)
            return response()->json(['message' => 'Deletion successful'], 200);

        return response()->json(['message' => 'Deletion failed'], 500);
    }
}