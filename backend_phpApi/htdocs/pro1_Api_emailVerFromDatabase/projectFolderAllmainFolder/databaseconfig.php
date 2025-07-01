<?php

$databaseconfig = new mysqli("localhost", 'root', '', 'signup');
if ($databaseconfig->connect_error) {
    http_response_code(500); // Internal Server Error
    echo json_encode([
        "success" => false,
        "message" => "Database connection failed"
    ]);
    exit;
}
?>