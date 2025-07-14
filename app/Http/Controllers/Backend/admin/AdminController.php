<?php

namespace App\Http\Controllers\Backend\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
       public function profile()
    {
        $admin = Auth::user();  
        return view('backend.admin.profile', compact('admin'));
    }

}
