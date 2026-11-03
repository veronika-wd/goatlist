<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class WishController extends Controller
{
    public function index()
    {
        return view('admin.wishes.index');
    }
}
