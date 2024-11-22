<?php
trait ApiResponseFormatter {
    public function formatResponse($status, $data = null, $message = "") {
        return json_encode([
            "status" => $status,
            "data" => $data,
            "message" => $message
        ]);
    }
}
?>
