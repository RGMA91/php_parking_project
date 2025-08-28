<?php

require_once(__DIR__ . "/../service/AuthorizationService.php");

class AuthorizationController {

    private $authorizationService;

    public function __construct() {
        $this->authorizationService = new AuthorizationService();
    }

    // Validate JWT
    public function validate() {
        $input = json_decode(file_get_contents('php://input'), true);
        $jwt = $input['jwt'] ?? '';

        $isValid = $this->authorizationService->validateJwt($jwt);
        header('Content-Type: application/json');
        if ($isValid == false) {
            echo json_encode(['valid' => false]);
        }
        else {
            echo json_encode(['valid' => true]);
        }

    }



}