<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(Request $request)
    {

        $limit = $request->get('limit');
        $projects = Project::latest();

        if ($limit) {
            $projects = $projects->simplePaginate($limit);
        } else {
            $projects = $projects->get();
        }

        return ProjectResource::collection($projects);
    }

    public function show(Request $request, Project $project)
    {
        return new ProjectResource($project);
    }

    public function relatedProjects(Request $request, Project $project)
    {
        $slug = $project->slug;

        $projects = Project::latest()
            ->where('slug', '!=', $slug)
            ->simplePaginate(3);

        return ProjectResource::collection($projects);
    }
}
