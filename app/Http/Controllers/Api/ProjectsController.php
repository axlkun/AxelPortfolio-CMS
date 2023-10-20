<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(Request $request){
        $projects = Project::latest()->simplePaginate($request->get('limit',4));

        return ProjectResource::collection($projects);
    }

    public function show(Request $request, Project $project){
        return new ProjectResource($project);
    }
}
