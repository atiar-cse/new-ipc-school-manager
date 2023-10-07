<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Book;
use App\Http\Requests\Admin\StoreBookRequest;
use App\Http\Requests\Admin\UpdateBookRequest;
use App\Services\ImageUploaderService;
use Exception;
use DB;

class BookController extends Controller
{
    public function index()
    {
        return Book::with('category', 'groups')->paginate();
    }
    public function store(StoreBookRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($request->hasFile('book_image')) {
                $uploadedImage = $request->file('book_image');
                $imagePath = ImageUploaderService::upload($uploadedImage, 'images/books/thumbnail');
                $request->merge(['thumbnail' => $imagePath]);
            }

            if ($request->hasFile('book_file')) {
                $uploadedImage = $request->file('book_file');
                $imagePath = ImageUploaderService::upload($uploadedImage, 'images/books/files');
                $request->merge(['file' => $imagePath]);
            }
            $book = Book::create($request->all());
            $book_group = [];
            if ($request->has('group_id')) {
                if ($request->input('group_id')) {
                    foreach ($request->input('group_id') as $group) {
                        $book_group[] = [
                            'book_id' => $book->id,
                            'group_id' => $group,
                            'created_at' => time(),
                        ];
                    }
                }
            }
            if (!empty($book_group)) {
                DB::table('book_group')->insert($book_group);
            }
            DB::commit();
            return response()->json([
                'success'   => true,
                'message'   => 'Book has been created successfully',
                'data'      => $book
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success'   => false,
                'message'   =>  $e->getMessage(),
                'data'      => $book
            ], 500);
        }
    }
    public function show(Book $book)
    {
        return $book::with('category', 'groups')->first();
    }
    public function update(UpdateBookRequest $request, Book $book)
    {
        try {
            DB::beginTransaction();

            if ($request->hasFile('book_image')) {
                $uploadedImage = $request->file('book_image');
                $imagePath = ImageUploaderService::upload($uploadedImage, 'images/books/thumbnail');
                $request->merge(['thumbnail' => $imagePath]);
            }

            if ($request->hasFile('book_file')) {
                $uploadedImage = $request->file('book_file');
                $imagePath = ImageUploaderService::upload($uploadedImage, 'images/books/files');
                $request->merge(['file' => $imagePath]);
            }
            $book->update($request->all());

            $book_group = [];
            if ($request->has('group_id')) {
                if ($request->input('group_id')) {

                    DB::table('book_group')->where('book_id', $book->id)->delete();

                    foreach ($request->input('group_id') as $group) {
                        $book_group[] = [
                            'book_id' => $book->id,
                            'group_id' => $group,
                            'created_at' => time(),
                        ];
                    }
                }
            }

            if (!empty($book_group)) {
                \DB::table('book_group')->insert($book_group);
            }

            DB::commit();
            return response()->json([
                'success'   => true,
                'message'   => 'Book has been created successfully',
                'data'      => $book
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success'   => false,
                'message'   =>  $e->getMessage(),
                'data'      => $book
            ], 500);
        }
    }
    public function destroy(Book $book)
    {
        $book->delete();
        if (!empty($book->thumbnail)) {
            unlink(storage_path('app/public/' . $book->thumbnail));
        }
        if (!empty($book->file)) {
            unlink(storage_path('app/public/' . $book->file));
        }
        return response()->json([
            'success'   => true,
            'message'   => 'Book has been deleted successfully',
            'data'      => $book
        ], 200);
    }
}
