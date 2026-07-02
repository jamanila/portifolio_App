<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', fn () => response()->json(['status' => 'ok']));

Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:6,1');
Route::post('/contact', [ContactMessageController::class, 'store']);

Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
Route::apiResource('technologies', TechnologyController::class)->only(['index', 'show']);
Route::apiResource('projects', ProjectController::class)->only(['index', 'show']);
Route::apiResource('products', ProductController::class)->only(['index', 'show']);
Route::apiResource('services', ServiceController::class)->only(['index', 'show']);
Route::apiResource('testimonials', TestimonialController::class)->only(['index', 'show']);
Route::apiResource('blogs', BlogController::class)->only(['index', 'show']);
Route::get('/social-links', [SocialLinkController::class, 'index']);
Route::get('/settings', [SettingController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'me']);

    Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);
    Route::apiResource('technologies', TechnologyController::class)->except(['index', 'show']);
    Route::apiResource('projects', ProjectController::class)->except(['index', 'show']);
    Route::delete('/projects/{project}/images/{image}', [ProjectController::class, 'destroyImage']);
    Route::apiResource('products', ProductController::class)->except(['index', 'show']);
    Route::delete('/products/{product}/images/{image}', [ProductController::class, 'destroyImage']);
    Route::apiResource('services', ServiceController::class)->except(['index', 'show']);
    Route::apiResource('testimonials', TestimonialController::class)->except(['index', 'show']);
    Route::apiResource('blogs', BlogController::class)->except(['index', 'show']);
    Route::post('/social-links', [SocialLinkController::class, 'store']);
    Route::put('/social-links/{social_link}', [SocialLinkController::class, 'update']);
    Route::delete('/social-links/{social_link}', [SocialLinkController::class, 'destroy']);
    Route::put('/settings', [SettingController::class, 'update']);

    Route::apiResource('contact-messages', ContactMessageController::class)->only(['index', 'show', 'update', 'destroy']);

    Route::post('/uploads', [UploadController::class, 'store']);
});
