<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Project;
use App\Actions\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;

class ProjectsController extends Controller
{
    public function index(){

        return Inertia::render('Projects/Index',[
            'projects' => ProjectResource::collection(Project::latest()->simplePaginate(10))
        ]);
    }

    public function create(){
        return Inertia::render('Projects/Create',[
            'edit' => false,
            'project' => new ProjectResource(new Project())
        ]);
    }

    public function store(Request $request, UploadFile $uploadFile){
        $data = $request->validate([
            'image' => ['nullable','image','max:3000'],
            'title' => ['required','string','max:255'],
            'slug' => ['required','string', Rule::unique(Project::class)],
            'technologies' => ['required','array'],
            'company' => ['required','string','max:100'],
            'repo_link' => ['nullable','url'],
            'website_link' => ['nullable','url'],
            'summary' => ['required','string','max:255'],
            'description' => ['required','string'],
        ]);

        $data['image'] = $uploadFile->setFile($request->file('image'))
        ->setUploadPath((new Project())->uploadFolder())
        ->execute();

        $data['technologies'] = json_encode($request->input('technologies'));

        Project::create($data);

        return redirect()->route('projects.index')
        ->with('success','Project stored successfully');
    }

    public function edit(Project $project){
        return Inertia::render('Projects/Create',[
            'edit' => true,
            'project' => new ProjectResource($project)
        ]);
    }

    public function update(Request $request, Project $project, UploadFile $uploadFile){
        $data = $request->validate([
            'image' => ['nullable','image','max:3000'],
            'title' => ['required','string','max:255'],
            'slug' => ['required','string', Rule::unique(Project::class)->ignore($project->id)], //ignorar registro actual
            'technologies' => ['required','array'],
            'company' => ['required','string','max:100'],
            'repo_link' => ['nullable','url'],
            'website_link' => ['nullable','url'],
            'summary' => ['required','string','max:255'],
            'description' => ['required','string']
        ]);

        $data['image'] = $project->image;
        $data['technologies'] = json_encode($request->input('technologies'));

        if($request->file('image')){
            $project->deletePhoto();

            $data['image'] = $uploadFile->setFile($request->file('image'))
            ->setUploadPath($project->uploadFolder())
            ->execute();
        }

        $project->update($data);
        return redirect()->route('projects.index')
        ->with('success','Project updated successfully');
    }

    public function destroy(Project $project){
        $project->deletePhoto();
        $project->delete();

        return redirect()->route('projects.index')
        ->with('success','Project deleted successfully');
    }
}
