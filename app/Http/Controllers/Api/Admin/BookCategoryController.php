<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BookCategory;
use App\Http\Requests\Admin\StoreBookCategoryRequest;
use App\Http\Requests\Admin\UpdateBookCategoryRequest;
use App\Services\ImageUploaderService;
use DB;

class BookCategoryController extends Controller
{
    public function index()
    {
        return BookCategory::paginate();
    }

    public function store(StoreBookCategoryRequest $request)
    {
        if ($request->hasFile('icon_image')) {
            $uploadedImage = $request->file('icon_image');
            $imagePath = ImageUploaderService::upload($uploadedImage, 'images/books/categories');
            $request->merge(['icon' => $imagePath]);
        }
        $bookCategory = BookCategory::create($request->all());

        return response()->json([
            'success'   => true,
            'message'   => 'Book category has been created successfully',
            'data'      => $bookCategory
        ], 200);
    }
    public function show(BookCategory $category)
    {
        return $category;
    }
    public function update(UpdateBookCategoryRequest $request, BookCategory $category)
    {
        if ($request->hasFile('icon_image')) {
            $uploadedImage = $request->file('icon_image');
            $imagePath = ImageUploaderService::upload($uploadedImage, 'images/books/categories');
            $request->merge(['icon' => $imagePath]);
        }
        $category->update($request->all());
        return response()->json([
            'success'   => true,
            'message'   => 'Book category has been updated successfully',
            'data'      => $category
        ], 200);
    }
    public function destroy(BookCategory $category)
    {
        if (!empty($category->icon)) {
            unlink(storage_path('app/public/' . $category->icon));
        }
        $category->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'Book category has been deleted successfully',
            'data'      => $category
        ], 200);
    }

    // Get Category Dropdown Option List
    public function getCategoryDropdownList()
    {
        $results = DB::table('book_categories')
            ->selectRaw('name AS title, id AS value')
            ->get();

        return $results;
    }
}
