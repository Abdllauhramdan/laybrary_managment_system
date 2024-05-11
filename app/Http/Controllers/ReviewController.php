<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Resources\ReviewResource;
use App\Http\Requests\ReviewRequest;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        try {
            $reviews = Review::all();
            return $this->customeResponse(ReviewResource::collection($reviews), "Reviews retrieved successfully", 200);
        } catch (\Throwable $th) {
            Log::error("Failed to fetch reviews: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to fetch reviews", 500);
        }
    }

    public function store(ReviewRequest $request)
    {
        try {
            $review = Review::create($request->validated());
            return $this->customeResponse(new ReviewResource($review), "Review added successfully", 201);
        } catch (\Throwable $th) {
            Log::error("Failed to add review: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to add review", 500);
        }
    }

    public function show(Review $review)
    {
        try {
            return $this->customeResponse(new ReviewResource($review), "Review details retrieved", 200);
        } catch (\Throwable $th) {
            Log::error("Failed to retrieve review: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to retrieve review", 500);
        }
    }

    public function update(ReviewRequest $request, Review $review)
    {
        try {
            $review->update($request->validated());
            return $this->customeResponse(new ReviewResource($review), "Review updated successfully", 200);
        } catch (\Throwable $th) {
            Log::error("Failed to update review: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to update review", 500);
        }
    }

    public function destroy(Review $review)
    {
        try {
            $review->delete();
            return $this->customeResponse(null, "Review deleted successfully", 204);
        } catch (\Throwable $th) {
            Log::error("Failed to delete review: " . $th->getMessage());
            return $this->customeResponse(null, "Failed to delete review", 500);
        }
    }

    public function restore($id)
{
    try {
        $review = Review::withTrashed()->findOrFail($id);
        $review->restore();
        return $this->customeResponse(new ReviewResource($review), 'Review restored successfully', 200);
    } catch (\Throwable $th) {
        Log::error("Failed to restore review: " . $th->getMessage());
        return $this->customeResponse(null, "Failed to restore review", 500);
    }
}

public function forceDelete(Review $review)
{
    try {
        if ($review->trashed()) { // Ensure the review is soft deleted before attempting a force delete
            $review->forceDelete();
            return $this->customResponse(null, "Review permanently deleted successfully", 200);
        } else {
            return $this->customResponse(null, "Review is not deleted. Use delete first.", 400);
        }
    } catch (\Throwable $th) {
        Log::error("Failed to permanently delete review: " . $th->getMessage());
        return $this->customResponse(null, "Failed to permanently delete review", 500);
    }
}
}

