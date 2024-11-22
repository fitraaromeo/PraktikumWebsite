<?php
require_once "C:/laragon/www/portfolio_website/backend/app/Config/DatabaseConfigurations.php";
require_once "C:/laragon/www/portfolio_website/backend/app/Controller/ProjectController.php";
require_once "C:/laragon/www/portfolio_website/backend/app/Traits/ApiResponseFormatter.php";

$db = (new DatabaseConfiguration())->getConnection();
$controller = new ProjectController($db);

class Routes {
    use ApiResponseFormatter;

    private $controller;

    public function __construct($controller) {
        $this->controller = $controller;
    }

    public function handleRequest() {
        // Ambil metode dan endpoint
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Routing berdasarkan metode dan parameter
        if ($method === 'GET') {
            // Cek apakah ada ID yang diminta
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $response = $this->controller->getProjectById($id);

                if ($response['status'] === 'success') {
                    echo $this->formatResponse("success", $response['data'], $response['message']);
                } else {
                    echo $this->formatResponse("error", null, $response['message']);
                }
            } else {
                // Tidak ada ID, ambil semua proyek
                $projects = $this->controller->getAllProjects();
                echo $this->formatResponse("success", $projects, "Projects retrieved successfully.");
            }
        } elseif ($method === 'POST') {
            // Menangani pembuatan proyek baru
            $data = json_decode(file_get_contents("php://input"));
            if ($data) {
                $result = $this->controller->createProject($data);
                echo $this->formatResponse("success", null, $result["message"]);
            } else {
                echo $this->formatResponse("error", null, "Invalid input data.");
            }
        } elseif ($method === 'PUT') {
            // Menangani pembaruan proyek
            $data = json_decode(file_get_contents("php://input"));
            if ($data) {
                $result = $this->controller->updateProject($data);
                echo $this->formatResponse("success", null, $result["message"]);
            } else {
                echo $this->formatResponse("error", null, "Invalid input data.");
            }
        } elseif ($method === 'DELETE') {
            // Menangani penghapusan proyek
            $data = json_decode(file_get_contents("php://input"));
            if ($data && isset($data->id)) {
                $result = $this->controller->deleteProject($data->id);
                echo $this->formatResponse("success", null, $result["message"]);
            } else {
                echo $this->formatResponse("error", null, "Project ID is required.");
            }
        } else {
            // Metode tidak didukung
            echo $this->formatResponse("error", null, "Method not allowed.");
        }
    }
}

$routes = new Routes($controller);
$routes->handleRequest();
?>
