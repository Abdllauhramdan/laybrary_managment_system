<?php


namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Resources\AuthorResource;
use App\Http\Requests\AuthorRequest;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Log;

class AuthorController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        try {
            $authors = Cache::remember('authors_list', 60, function () {
                return Author::all();
            });
            return $this->customeResponse(AuthorResource::collection($authors), "Authors retrieved successfully", 200);
        } catch (\Throwable $th) {
            Log::error("Failed to fetch authors: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to fetch authors", 500);
        }
    }

    public function store(AuthorRequest $request)
    {
        try {
            $author = Author::create($request->validated());
            return $this->customeResponse(new AuthorResource($author), "Author created successfully", 201);
        } catch (\Throwable $th) {
            Log::error("Failed to create author: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to create author", 500);
        }
    }

    public function show(Author $author)
    {
        try {
            return $this->customeResponse(new AuthorResource($author), "Author details retrieved", 200);
        } catch (\Throwable $th) {
            Log::error("Failed to retrieve author: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to retrieve author", 500);
        }
    }

    public function update(AuthorRequest $request, Author $author)
    {
        try {
            $author->update($request->validated());
            return $this->customeResponse(new AuthorResource($author), "Author updated successfully", 200);
        } catch (\Throwable $th) {
            Log::error("Failed to update author: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to update author", 500);
        }
    }

    public function destroy(Author $author)
    {
        try {
            $author->delete();
            return $this->customeResponse(null, "Author deleted successfully", 204);
        } catch (\Throwable $th) {
            Log::error("Failed to delete author: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to delete author", 500);
        }
    }


    public function restore($id)
    {
        try {
            $author = Author::withTrashed()->findOrFail($id);
            $author->restore();
            return $this->customResponse(new AuthorResource($author), "Author restored successfully");
        } catch (\Throwable $th) {
            Log::error("Failed to restore author: " . $th->getMessage());
            return $this->customResponse(null, "Failed to restore author", 500);
        }
    }

    public function forceDelete(Author $author)
    {
        try {
            if ($author->trashed()) { // تأكد من أن الكاتب محذوف مؤقتًا قبل الحذف النهائي
                $author->forceDelete();
                return $this->customResponse(null, "Author permanently deleted successfully", 200);
            } else {
                return $this->customResponse(null, "Author is not deleted. Use delete first.", 400);
            }
        } catch (\Throwable $th) {
            Log::error("Failed to permanently delete author: " . $th->getMessage());
            return $this->customResponse(null, "Failed to permanently delete author", 500);
        }
    }
}
