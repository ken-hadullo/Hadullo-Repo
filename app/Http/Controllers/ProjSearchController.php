<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ProjectMan;
use App\Models\ProjCat;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ProjSearchController extends Controller
{
    public function AdminSearchProjects(Request $request)
     {

        $projects = DB::table('projects');
        //$projects = ProjectMan::all();

        //$keyword = $searchterm = hadullo;

        if ($request->searchterm !=null){
            $projects = $projects->orWhere('projects.title', 'like','%'.$request->searchterm.'%');
            $projects = $projects->orWhere('users.name', 'like','%'.$request->searchterm.'%');
            $projects = $projects->orWhere('projects.author', 'like','%'.$request->searchterm.'%');

            $projects = $projects->orWhere('projects.abstract', 'like','%'.$request->searchterm.'%');
            $projects = $projects->orWhere('projcats.proj_cat', 'like','%'.$request->searchterm.'%');
        }

        $projects = $projects

        ->select('projects.*', 'users.name as postedBy', 'projcats.proj_cat as catName' )
        ->leftJoin('users', 'users.id', 'projects.user_id')
        ->leftJoin('projcats', 'projcats.id', 'projects.proj_cat_id')
        //->get();
        //dd($projects);
        ->paginate(5);

    return view('dashboard.admin.projects.search.index')->with('projects', $projects);

}



}
