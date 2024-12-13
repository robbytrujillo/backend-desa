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
        $pages = Page::when(request()->searc, function ($pages) {
            $pages = $pages->where('title', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);

        // append query string to pagination links 
        $pages->appends(['search' => request()->search]);

        // return with Api Resource
        return new PageResource(true, 'List Data Pages', $pages);
    }
}
