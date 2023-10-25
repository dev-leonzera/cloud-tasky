<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository{

    private $project;

    public function __construct(Project $project){
        $this->project = $project;
    }

    public function getAllProjects(){
        return $this->project->paginate(10);
    }

    public function getProject($id){
        $project = Project::with('creator')->find($id);

        return $project;
    }

    public function storeProject($data){
        return $this->project->create($data);
    }

    public function updateProject($id, $data){
        $project = $this->project->find($id);

        return $project->update($data);
    }

    public function deleteProject($id){
        $project = $this->project->find($id);
        return $project->delete();
    }
}