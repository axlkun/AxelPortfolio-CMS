<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(Request $request){

        $limit = $request->get('limit',-1);
        $projects = Project::latest();

        if($limit > 0){
            $projects = $projects->simplePaginate($limit);
        }else{
            $projects = $projects->get();
        }
        
        return ProjectResource::collection($projects);
    }

    public function show(Request $request, Project $project){
        return new ProjectResource($project);
    }
}
