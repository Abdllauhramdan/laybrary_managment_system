<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReviewController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Authors Routes
Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/authors/{author}', [AuthorController::class, 'show']);
Route::post('/authors', [AuthorController::class, 'store']);
Route::put('/authors/{author}', [AuthorController::class, 'update']);
Route::delete('/authors/{author}', [AuthorController::class, 'destroy']);
Route::post('/authors/{author}/restore', [AuthorController::class, 'restore']);
Route::delete('/authors/{author}/force', [AuthorController::class, 'forceDelete']);

// Books Routes
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{book}', [BookController::class, 'show']);
Route::post('/books', [BookController::class, 'store']);
Route::put('/books/{book}', [BookController::class, 'update']);
Route::delete('/books/{book}', [BookController::class, 'destroy']);
Route::post('/books/{book}/restore', [BookController::class, 'restore']);
Route::delete('/books/{book}/force', [BookController::class, 'forceDelete']);

// Customers Routes
Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{customer}', [CustomerController::class, 'show']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::put('/customers/{customer}', [CustomerController::class, 'update']);
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy']);
Route::post('/customers/{customer}/restore', [CustomerController::class, 'restore']);
Route::delete('/customers/{customer}/force', [CustomerController::class, 'forceDelete']);

// Reviews Routes
Route::get('/reviews', [ReviewController::class, 'index']);
Route::get('/reviews/{review}', [ReviewController::class, 'show']);
Route::post('/reviews/books/{book}', [ReviewController::class, 'storeForBook']);
Route::post('/reviews/authors/{author}', [ReviewController::class, 'storeForAuthor']);
Route::put('/reviews/{review}', [ReviewController::class, 'update']);
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);
Route::post('/reviews/{review}/restore', [ReviewController::class, 'restore']);
Route::delete('/reviews/{review}/force', [ReviewController::class, 'forceDelete']);

//MIDDELWARES
// Route::middleware(['log', 'transaction'])->group(function () {
//     Route::apiResource('books', BookController::class);
//     Route::apiResource('authors', AuthorController::class);
//     Route::apiResource('users', UserController::class);

//     // Example of using authorization middleware
//     Route::post('books/{book}/review', [BookReviewController::class, 'store'])
//          ->middleware('authorize:create-review');
// });







// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthorController;
// use App\Http\Controllers\BookController;
// use App\Http\Controllers\CustomerController;
// use App\Http\Controllers\ReviewController;

// // Routes for Users
// Route::post('/users/register', [UserController::class, 'register']);
// Route::post('/users/login', [UserController::class, 'login']);
// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/users/profile', [UserController::class, 'show']);
//     Route::put('/users/profile', [UserController::class, 'update']);
// });

// // Routes for Authors
// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('/authors', [AuthorController::class, 'store']);
//     Route::put('/authors/{author}', [AuthorController::class, 'update']);
//     Route::delete('/authors/{author}', [AuthorController::class, 'destroy']);
// });
// Route::get('/authors', [AuthorController::class, 'index']);
// Route::get('/authors/{author}', [AuthorController::class, 'show']);

// // Routes for Books
// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('/books', [BookController::class, 'store']);
//     Route::put('/books/{book}', [BookController::class, 'update']);
//     Route::delete('/books/{book}', [BookController::class, 'destroy']);
// });
// Route::get('/books', [BookController::class, 'index']);
// Route::get('/books/{book}', [BookController::class, 'show']);

// // Routes for Reviews
// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('/reviews/books/{book}', [ReviewController::class, 'storeForBook']);
//     Route::post('/reviews/authors/{author}', [ReviewController::class, 'storeForAuthor']);
//     Route::put('/reviews/{review}', [ReviewController::class, 'update']);
//     Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);
// });
// Route::get('/reviews', [ReviewController::class, 'index']);

// // Routes for Notifications
// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/notifications', [NotificationController::class, 'index']);
//     Route::put('/notifications/{notification}/read', [NotificationController::class, 'markAsRead']);
// });
