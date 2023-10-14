<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Book;
use App\Models\Admin\Tag;
use App\Http\Requests\Admin\StoreBookRequest;
use App\Http\Requests\Admin\UpdateBookRequest;
use App\Services\ImageUploaderService;
use Exception;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query       = $request->get('q');
        $status      = intval($request->get('status'));

        return Book::with('category')
            ->when($request->filled('status'), function ($qry) use ($status) {
                $qry->where('disabled', $status);
            })
            ->when(!empty($query), function ($qry) use ($query) {
                $qry->where('name', 'like', '%' . $query . '%');
            })
            ->paginate();
    }
    public function store(StoreBookRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($request->hasFile('book_image')) {
                $uploadedImage = $request->file('book_image');
                $imagePath = ImageUploaderService::upload($uploadedImage, 'images/books/thumbnail');
                $request->merge(['thumbnail' => $imagePath]);
            } else if ($request->filled('book_image')) {
                //handle base64 encoded images here 
                $base64image = $request['book_image'];
                @list($type, $file_data) = explode(';', $base64image);
                @list(, $file_data) = explode(',', $file_data);
                $type = explode(";", explode("/", $base64image)[1])[0];
                $name = time() . uniqid() . '.' . $type;
                $path = 'images/books/thumbnail/' . $name;
                Storage::disk('public')->put($path, base64_decode($file_data));

                $request->merge(['thumbnail' => $name]);
            }

            if ($request->hasFile('book_file')) {
                $uploadedImage = $request->file('book_file');
                $imagePath = ImageUploaderService::upload($uploadedImage, 'images/books/files');
                $request->merge(['file' => $imagePath]);
            }
            $book = Book::create($request->all());

            $book_group = [];
            if ($request->has('group_ids')) {
                if ($request->input('group_ids')) {
                    foreach ($request->input('group_ids') as $group_id) {
                        $book_group[] = [
                            'book_id' => $book->id,
                            'group_id' => $group_id,
                            'created_at' => Carbon::now(),
                        ];
                    }
                }
            }
            if (!empty($book_group)) {
                DB::table('book_group')->insert($book_group);
            }

            if ($request->input('tags')) {
                $book_tag = [];
                foreach ($request->input('tags') as $input_tag) {
                    $tag = Tag::where('name', $input_tag)->first();
                    if ($tag) {
                        $book_tag[] = ['book_id' => $book->id, 'tag_id' => $tag->id];
                    } else {
                        $new_tag = DB::table('tags')->insertGetId(['name' => $input_tag]);

                        $book_tag[] = ['book_id' => $book->id, 'tag_id' => $new_tag];
                    }
                }
                DB::table('book_tag')->insert($book_tag);
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
                // 'data'      => $book
            ], 500);
        }
    }
    public function show(Book $book)
    {
        return Book::where('id', $book->id)->with('category', 'groups', 'tags')->first();
        // return $book->with('category', 'groups', 'tags')->first();
    }
    public function update(UpdateBookRequest $request, Book $book)
    {
        try {
            DB::beginTransaction();
            if ($request->hasFile('book_image')) {
                //delete previous image
                if (!empty($book->thumbnail)) {
                    unlink(storage_path('app/public/' . $book->thumbnail));
                }
                $uploadedImage = $request->file('book_image');
                $imagePath = ImageUploaderService::upload($uploadedImage, 'images/books/thumbnail');
                $request->merge(['thumbnail' => $imagePath]);
            }

            if ($request->hasFile('book_file')) {
                //delete previous file
                if (!empty($book->file)) {
                    unlink(storage_path('app/public/' . $book->file));
                }
                $uploadedImage = $request->file('book_file');
                $imagePath = ImageUploaderService::upload($uploadedImage, 'images/books/files');
                $request->merge(['file' => $imagePath]);
            }
            $book->update($request->all());

            $book_group = [];
            if ($request->has('group_ids')) {
                if ($request->input('group_ids')) {

                    DB::table('book_group')->where('book_id', $book->id)->delete();

                    foreach ($request->input('group_ids') as $group) {
                        $book_group[] = [
                            'book_id' => $book->id,
                            'group_id' => $group,
                            'updated_at' => Carbon::now(),
                        ];
                    }
                }
            }

            if (!empty($book_group)) {
                \DB::table('book_group')->insert($book_group);
            }

            if ($request->input('tags')) {

                DB::table('book_tag')->where('book_id', $book->id)->delete();
                $book_tag = [];

                foreach ($request->input('tags') as $input_tag) {
                    $tag = Tag::where('name', $input_tag)->first();

                    if ($tag) {
                        $book_tag[] = ['book_id' => $book->id, 'tag_id' => $tag->id];
                    } else {
                        $new_tag = DB::table('tags')->insertGetId(['name' => $input_tag]);
                        $book_tag[] = ['book_id' => $book->id, 'tag_id' => $new_tag];
                    }
                }
                DB::table('book_tag')->insert($book_tag);
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
