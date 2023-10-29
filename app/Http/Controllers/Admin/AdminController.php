<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin\Admin;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
}
