<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\VerificationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use Carbon\Carbon;

class FrontEndController extends Controller
{

     //public function Front(){
        //return view('front.home.index');
    //}



	 public function HomePage()    {

        //$articles= User::latest()->paginate(6);
        //$members= User::latest()->get();
        //$members=User::orderBy('roles_id',  'ASC')->get();

        //$members=User::whereBetween('roles_id',[$min, $max])->orderBy('roles_id')->get();

        return view('front.home.index', compact('members'));

     }

	 public function Membership()    {
       //$articles= User::latest()->paginate(6);
       $members= User::latest()->cursorPaginate(8);
       return view('front.membership.index', compact('members'));

    }




    public function VisionMission(){
        return view('front.vision-mission.index');
    }

    public function Mandate(){
        return view('front.mandate.index');
    }

    public function Contact(){
        return view('front.contact.index');
    }


     // using Route Model binding
     public function SingleMember(User $member)
          {
     return view('front.members.index', compact('member'));
     }





     // search Projects for the FE
    public function FrontSearchProjects(Request $request)
     {

        $articles = DB::table('projects');
        //$projects = projectMan::all();

        if ($request->searchterm !=null){
            $articles = $articles->orWhere('projects.title', 'like','%'.$request->searchterm.'%');
            $articles = $articles->orWhere('users.name', 'like','%'.$request->searchterm.'%');
            $articles = $articles->orWhere('projects.author', 'like','%'.$request->searchterm.'%');
            $articles = $articles->orWhere('projects.abstract', 'like','%'.$request->searchterm.'%');

        }

        $articles = $articles

        ->select('projects.*', 'users.name as postedBy', 'projcats.proj_cat as catName' )
        ->leftJoin('users', 'users.id', 'projects.user_id')
        ->leftJoin('projcats', 'projcats.id', 'projects.proj_cat_id')
        //->get();
        //dd($projects);
        ->paginate(5);

    return view('front.projects.search.index')->with('articles', $articles);

}

        // using Route Model binding for single searched project

        public function SingleProjectSearch(ProjectMan $project)
        {
        return view('front.projects.search.single', compact('project'));
       }



}
