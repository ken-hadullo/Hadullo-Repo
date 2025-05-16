<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\VerificationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\NewsPost;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use Carbon\Carbon;

class FrontEndController extends Controller
{

  public function HomePage(){
    return view('front.home.index');
}

public function AboutPage(){
  return view('front.about.index');
}



}
