<?php

namespace Controller;

include "Traits/ResponseFormatter.php";
include "Controllers/Controller.php";

use Traits\ResponseFormatter;

class ProductController extends Controller{
    use ResponseFormatter;

    public function __construct() {
        $this->controllerName = "Get All Products";
        $this->controllerMethod = "GET";
    }

    public function getAllProduct() {
        $dummyData = [
            "Air Mineral",
            "Kebab",
            "Bakso",
            "Jus Jambu"
        ];

        $response = [
            "controller_attribute" => $this ->getControllerAttribute(),
            "product" => $dummyData
        ];

        return $this->responseFormatter(200, "Success", $response);
    }
};