<?php
require_once 'C:/laragon/www/portfolio_website/backend/app/Models/Project.php';

class ProjectController {
    private $project;

    public function __construct($db) {
        $this->project = new Project($db);
    }

    // Handle Read
    public function getAllProjects() {
        $stmt = $this->project->read();
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $projects;
    }

    // Handle Get by ID
    public function getProjectById($id) {
        $this->project->id = $id; // Set ID proyek
        $project = $this->project->getById();

        if ($project) {
            return [
                "status" => "success",
                "data" => $project,
                "message" => "Project found."
            ];
        }

        return [
            "status" => "error",
            "message" => "Project not found."
        ];
    }

    // Handle Create
    public function createProject($data) {
        $this->project->title = $data->title;
        $this->project->description = $data->description;

        if ($this->project->create()) {
            return ["message" => "Project created successfully."];
        }
        return ["message" => "Failed to create project."];
    }

    //Handle Update
    public function updateProject($data) {
        $this->project->id = $data->id;
        $this->project->title = $data->title;
        $this->project->description = $data->description;
    
        if ($this->project->update()) {
            return ["message" => "Project updated successfully."];
        }
        return ["message" => "Failed to update project."];
    }

    // Handle Delete
    public function deleteProject($id) {
        $this->project->id = $id;

        if ($this->project->delete()) {
            return ["message" => "Project deleted successfully."];
        }
        return ["message" => "Failed to delete project."];
    }
}
?>
