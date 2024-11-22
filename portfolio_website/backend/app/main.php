<?php
require_once "C:/laragon/www/portfolio_website/backend/app/Routes/ProjectRoutes.php";

// Mengizinkan asal tertentu
header("Access-Control-Allow-Origin: *"); // Sesuaikan dengan asal frontend Anda
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE"); // Metode yang diizinkan
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Header tambahan yang diizinkan

// Jika method OPTIONS (preflight request)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}
?>
