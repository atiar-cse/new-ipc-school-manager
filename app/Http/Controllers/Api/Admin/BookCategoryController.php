<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BookCategory;
use App\Http\Requests\Admin\StoreBookCategoryRequest;
use App\Http\Requests\Admin\UpdateBookCategoryRequest;

class BookCategoryController extends Controller
{
    public function index()
    {
        return BookCategory::paginate();
    }

    public function store(StoreBookCategoryRequest $request)
    {
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
        $category->update($request->all());
        return response()->json([
            'success'   => true,
            'message'   => 'Book category has been updated successfully',
            'data'      => $category
        ], 200);
    }
    public function destroy(BookCategory $category)
    {
        $category->delete();
        return response()->json([
            'success'   => true,
            'message'   => 'Book category has been deleted successfully',
            'data'      => $category
        ], 200);
    }
}
