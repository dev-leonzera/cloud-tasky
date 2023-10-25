<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class ProjectController extends Controller
{
    public function index(){
        $projetos = Project::all();        

        return Inertia::render('Projects/Index', compact('projetos'));
    }

    public function create(){
        return Inertia::render('Projects/Create');
    }

    public function store(StoreProjectRequest $request){
        
        Project::create($request->validated());

        return redirect()->route('projects.index')->with('success', 'Project created successfully!');
    }

    public function show(Project $project){
        return Inertia::render('Projects/Show', compact('project'));
    }

    public function edit($id){
        $project = Project::find($id);
        return Inertia::render('Projects/Edit', compact('project'));
    }

    public function update(Request $request, $id){
        $project = Project::find($id);
        $project->update($request->all());
        return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
    }

    public function destroy($id){
        $project = Project::find($id);
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully!');
    }
}
