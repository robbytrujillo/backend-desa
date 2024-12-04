<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\PermissionResource;
// use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //
    public function index() {
        // get permissions
        $permissions = Permission::when(request()->search, function($permissions) {
            $permissions = $permissions->where('name', 'like', '%'. request()->search() . '%');
        })->latest()->paginate(5);
    }
}
