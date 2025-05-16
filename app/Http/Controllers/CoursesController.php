<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function ViewCourses()    {
        //$articles= User::latest()->paginate(6);
        $courses= Course::latest()->cursorPaginate(8);
        return view('dashboard.admin.courses.index', compact('courses'));
     }

     public function createCourses()
     {
         return view('dashboard.admin.courses.index');
     }
}
