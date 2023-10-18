<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectsController extends Controller
{
    public function index(){

        return Inertia::render('Projects/Index',[
            'projects' => ProjectResource::collection(Project::latest()->simplePaginate(10))
        ]);
    }
}
