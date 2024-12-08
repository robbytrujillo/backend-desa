<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // get categories
        $categories = Category::when(request()->search, function ($categories) {
            $categories = $categories->where('name', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);

        // append query string to pagination links
        $categories->appends(['search' => request()->search]);

        // return with Api Resource
        return new CategoryResource(true, 'List Data Categories', $categories);  
    }

        /**
        * Store a newly created resource in storage
        * 
        * @param \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
        */
        public function store(Request $request) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:categories',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // create category
            $category = Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
            ]);

            if ($category) {
                // return success with Api Resource
                return new CategoryResource(true, 'Data Category Berhasil Disimpan!', $category);
            }

            // return failed with Api Resource
            return new CategoryResource(false, 'Data Category Gagal Disimpan!', null);
        }

}
