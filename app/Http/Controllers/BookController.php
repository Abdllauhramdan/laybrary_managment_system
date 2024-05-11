<?php

namespace App\Http\Controllers;

use App\Models\Customer; // استخدم نموذج Customer بدلاً من User
use Illuminate\Support\Facades\Mail;
use App\Models\Book;
use App\Http\Resources\BookResource;
use App\Http\Requests\BookRequest;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        try {
            $books = Cache::remember('books_list', 60, function () {
            return $this->customeResponse(BookResource::collection($books), "Books retrieved successfully", 200);
            });
        }
    
    catch (\Throwable $th) {
            Log::error("Failed to fetch books: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to fetch books", 500);
        }
    }

    public function store(BookRequest $request)
    {
        try {
            $book = Book::create($request->validated());

            $customers = Customer::all();
            foreach ($customers as $customer) {
                Mail::to($customer->email)->queue(new NewBookNotification($book));
            }
        
            return $this->customeResponse(new BookResource($book), "Book created successfully", 201);
        } catch (\Throwable $th) {
            Log::error("Failed to create book: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to create book", 500);
        }
    }

    public function show(Book $book)
    {
        try {
            return $this->customeResponse(new BookResource($book), "Book details retrieved", 200);
        } catch (\Throwable $th) {
            Log::error("Failed to retrieve book: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to retrieve book", 500);
        }
    }

    public function update(BookRequest $request, Book $book)
    {
        try {
            $book->update($request->validated());
            return $this->customeResponse(new BookResource($book), "Book updated successfully", 200);
        } catch (\Throwable $th) {
            Log::error("Failed to update book: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to update book", 500);
        }
    }

    public function destroy(Book $book)
    {
        try {
            $book->delete();
            return $this->customeResponse(null, "Book deleted successfully", 204);
        } catch (\Throwable $th) {
            Log::error("Failed to delete book: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to delete book", 500);
        }
    }

    public function restore($id)
    {
        try {
            $book = Book::withTrashed()->findOrFail($id);
            $book->restore();
            return $this->customeResponse(new BookResource($book), "Book restored successfully", 200);
        } catch (\Throwable $th) {
            Log::error("Failed to restore book: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to restore book", 500);
        }
    }

    public function forceDelete(Book $book)
    {
        try {
            $book->forceDelete();
            return $this->customeResponse(null, "Book permanently deleted", 200);
        } catch (\Throwable $th) {
            Log::error("Failed to permanently delete book: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to permanently delete book", 500);
        }
    }
}


