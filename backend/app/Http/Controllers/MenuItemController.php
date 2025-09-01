<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = MenuItem::with('category');

        // Filter by category if provided
        if ($request->has('category_id')) {
            $query->byCategory($request->category_id);
        }

        // Filter by availability if provided
        if ($request->has('available')) {
            $query->available();
        }

        // Search by name if provided
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $menuItems = $query->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $menuItems
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'icon' => 'nullable|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'is_available' => 'boolean',
                'sort_order' => 'integer|min:0'
            ]);

            $menuItem = MenuItem::create($validated);
            $menuItem->load('category');

            return response()->json([
                'success' => true,
                'data' => $menuItem,
                'message' => 'Menu item created successfully'
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuItem $menuItem): JsonResponse
    {
        $menuItem->load('category');
        
        return response()->json([
            'success' => true,
            'data' => $menuItem
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MenuItem $menuItem): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'icon' => 'nullable|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'is_available' => 'boolean',
                'sort_order' => 'integer|min:0'
            ]);

            $menuItem->update($validated);
            $menuItem->load('category');

            return response()->json([
                'success' => true,
                'data' => $menuItem,
                'message' => 'Menu item updated successfully'
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuItem $menuItem): JsonResponse
    {
        try {
            $menuItem->delete();

            return response()->json([
                'success' => true,
                'message' => 'Menu item deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting menu item'
            ], 500);
        }
    }

    /**
     * Get menu items by category.
     */
    public function byCategory(Category $category): JsonResponse
    {
        $menuItems = $category->activeMenuItems()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $menuItems,
            'category' => $category
        ]);
    }
}
