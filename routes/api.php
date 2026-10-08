<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Api\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Api\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Api\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Api\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Api\PublicApi\BannerController;
use App\Http\Controllers\Api\PublicApi\CategoryController;
use App\Http\Controllers\Api\PublicApi\FaqController;
use App\Http\Controllers\Api\PublicApi\ProductController;
use App\Http\Controllers\Api\PublicApi\SettingController;
use App\Http\Controllers\Api\PublicApi\TestimonialController;
use Illuminate\Support\Facades\Route;

// ── Public Routes (CI/CD Tested) ──
Route::middleware('throttle:60,1')->group(function () {
    Route::get('/settings', [SettingController::class, 'index']);
    Route::get('/banners', [BannerController::class, 'index']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{slug}', [ProductController::class, 'show']);
    Route::get('/testimonials', [TestimonialController::class, 'index']);
    Route::get('/faqs', [FaqController::class, 'index']);
});

// ── Auth Routes ──
Route::post('/login', [AuthController::class, 'login']);

// Test endpoint to verify token header reception
Route::get('/test-auth', function (\Illuminate\Http\Request $request) {
    return response()->json([
        'header' => $request->header('Authorization'),
        'user' => $request->user(),
    ]);
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // ── Admin Routes ──
    Route::prefix('admin')->group(function () {
        Route::put('/profile/password', [AuthController::class, 'updatePassword']);
        Route::get('/dashboard', [DashboardController::class, 'index']);

        // Categories
        Route::get('/categories', [AdminCategoryController::class, 'index']);
        Route::post('/categories', [AdminCategoryController::class, 'store']);
        Route::put('/categories/{category}', [AdminCategoryController::class, 'update']);
        Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy']);

        // Products
        Route::get('/products', [AdminProductController::class, 'index']);
        Route::post('/products', [AdminProductController::class, 'store']);
        Route::put('/products/{product}', [AdminProductController::class, 'update']);
        Route::delete('/products/{product}', [AdminProductController::class, 'destroy']);
        Route::post('/products/{product}/images', [AdminProductController::class, 'storeImages']);
        Route::delete('/products/{product}/images/{image}', [AdminProductController::class, 'destroyImage']);

        // Banners
        Route::get('/banners', [AdminBannerController::class, 'index']);
        Route::post('/banners', [AdminBannerController::class, 'store']);
        Route::put('/banners/{banner}', [AdminBannerController::class, 'update']);
        Route::delete('/banners/{banner}', [AdminBannerController::class, 'destroy']);

        // Settings
        Route::get('/settings', [AdminSettingController::class, 'index']);
        Route::put('/settings', [AdminSettingController::class, 'update']);
        Route::post('/settings/upload-image', [AdminSettingController::class, 'uploadImage']);

        // Testimonials
        Route::get('/testimonials', [AdminTestimonialController::class, 'index']);
        Route::post('/testimonials', [AdminTestimonialController::class, 'store']);
        Route::put('/testimonials/{testimonial}', [AdminTestimonialController::class, 'update']);
        Route::delete('/testimonials/{testimonial}', [AdminTestimonialController::class, 'destroy']);

        // FAQs
        Route::get('/faqs', [AdminFaqController::class, 'index']);
        Route::post('/faqs', [AdminFaqController::class, 'store']);
        Route::put('/faqs/{faq}', [AdminFaqController::class, 'update']);
        Route::delete('/faqs/{faq}', [AdminFaqController::class, 'destroy']);
    });
});
