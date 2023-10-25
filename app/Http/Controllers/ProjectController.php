<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Error;
use Inertia\Inertia;
use Throwable;

class ProjectController extends Controller
{

    private $projectRepository;

    public function __construct(ProjectRepository $projectRepository){
        $this->projectRepository = $projectRepository;
    }
    public function index(){
        $projetos = ProjectResource::collection($this->projectRepository->getAllProjects());        
        return Inertia::render('Projects/Index', [
            'projetos' => $projetos,
        ]);
    }

    public function create(){
        return Inertia::render('Projects/Create');
    }

    public function store(StoreProjectRequest $request){

        try {
            $this->projectRepository->storeProject($request->validated());
            return redirect()->route('projects.index')->with('success', 'Project created successfully!');
        } catch (\Exception $e) {
            throw $e->getMessage();
        }
    }

    public function show($id){
        $project = $this->projectRepository->getProject($id);
        return Inertia::render('Projects/Show', compact('project'));
    }

    public function edit($id){
        $project = $this->projectRepository->getProject($id);
        return Inertia::render('Projects/Edit', compact('project'));
    }

    public function update(StoreProjectRequest $request, $id){
        try {
            $project = $this->projectRepository->updateProject($id, $request->validated());        
            return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id){
        $this->projectRepository->deleteProject($id);
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully!');
    }
}
