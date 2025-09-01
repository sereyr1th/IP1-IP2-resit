<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public API routes (no authentication required)
Route::prefix('v1')->group(function () {
    
    // Categories routes
    Route::apiResource('categories', CategoryController::class);
    
    // Menu items routes
    Route::apiResource('menu-items', MenuItemController::class);
    
    // Additional menu item routes
    Route::get('categories/{category}/menu-items', [MenuItemController::class, 'byCategory']);
    
    // Simple route for getting all menu items with category info
    Route::get('menu', function () {
        $menuItems = \App\Models\MenuItem::with('category')
            ->where('is_available', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'price' => (float) $item->price,
                    'category' => $item->category->name,
                    'icon' => $item->icon ?? '🍽️'
                ];
            });
            
        return response()->json($menuItems);
    });
});
