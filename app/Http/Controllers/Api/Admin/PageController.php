<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Page;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    /**
     * Display a listing of the resource
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // get pages
        $pages = Page::when(request()->search, function ($pages) {
            $pages = $pages->where('title', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);

        // append query string to pagination links 
        $pages->appends(['search' => request()->search]);

        // return with Api Resource
        return new PageResource(true, 'List Data Pages', $pages);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) { 
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // create page
        $page = Page::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'user_id' => auth()->guard('api')->user()->id
        ]);

        if ($page) {
            // return success with Api Resource
            return new PageResource(true, 'Data Page Berhasil Disimpan', $page);
        }

        // return failed with Api Resource
        return new PageResource(false, 'Data Page Gagal Disimpan!', null);   
    }

    
}
