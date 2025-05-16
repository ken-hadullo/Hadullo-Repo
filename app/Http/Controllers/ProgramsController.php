<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\School;
use Illuminate\Support\Str;

class ProgramsController extends Controller
{
    public function ViewPrograms()    {
        //$articles= User::latest()->paginate(6);
        $programs= Program::latest()->cursorPaginate(8);
        return view('dashboard.admin.programs.index', compact('programs'));
     }

     public function createPrograms()
     {
        $schools = School::orderBy('name', 'ASC')->get();
        return view('dashboard.admin.programs.create', compact('schools'));
     }


     public function StorePrograms(Request $request)    {

        $request->validate([
            'full_name' => "required",
            'short_name' => "required",
            'program_id' => "required",
            'schools_id' => "required"
        ]);

    //Grabbing Required Posts Data
    $full_name = $request->input('full_name');
    if(Program::latest()->first() !== null){
      $programId = Program::latest()->first()->id + 1;
     } else{
         $programId = 1;
     }

    $slug = Str::slug($full_name, '-') . '-' . $programId;
    $short_name = $request->input('short_name');
    $program_id = $request->input('program_id');
    $schools_id = $request->input('schools_id');



    //Enabling CRUD operations with table
    $program = new Program();
    $program->full_name = $full_name;
    $program->short_name = $short_name;
    $program->slug = $slug;
    $program->program_id = $program_id;
    $program->schools_id = $schools_id;
    $program->save();


    return redirect()->route('programs.index')->with('status', 'Program added successfully');

    //dd($program);


    }


}
