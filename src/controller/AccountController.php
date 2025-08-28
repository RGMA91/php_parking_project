<?php

require_once(__DIR__ . "/../service/AccountService.php");

class AccountController {

    private $accountService;

    public function __construct() {
        $this->accountService = new AccountService();
    }

    public function showRegisterForm() {
        include __DIR__ . '/../../views/register.php';
    }

    public function showLoginForm() {
        include __DIR__ . '/../../views/login.php';
    }

    public function create(){
        $name = filter_input(INPUT_POST, "name", FILTER_UNSAFE_RAW);
        $surname = filter_input(INPUT_POST, "surname", FILTER_UNSAFE_RAW);
        $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_NUMBER_INT);
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $repeated_password = filter_input(INPUT_POST, "repeatedPassword", FILTER_SANITIZE_SPECIAL_CHARS);

        if ($password != $repeated_password) {
            echo "<p style='color:red;'>Passwords do not match.</p>";
            return;
        }

        $this->accountService->createUserAccount($name, $surname, $phone, $email, $password);
    }

    public function authenticate(){
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        $this->accountService->authenticateUserAndReturnJwt($email, $password);
    }

}