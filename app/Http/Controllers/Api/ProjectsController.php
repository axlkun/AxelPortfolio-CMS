<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ProjectResourceIndex;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(Request $request)
    {

        $limit = $request->get('limit');
        $projectsQuery = Project::latest()->where('status', true);

        if ($limit) {
            $projects = $projectsQuery->simplePaginate($limit);
        } else {
            $projects = $projectsQuery->get();
        }

        return ProjectResourceIndex::collection($projects);
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
            ->where('status', true)
            ->simplePaginate(3);

        return ProjectResource::collection($projects);
    }
}
