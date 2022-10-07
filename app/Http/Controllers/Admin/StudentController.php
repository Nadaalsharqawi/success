<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index()
    {
        $data = User::where('type','student')->orderBy('id', 'desc')->get();
        return view('admin.students.index',compact('data'));
    }
}
