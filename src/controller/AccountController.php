<?php

require_once(__DIR__ . "/../service/AccountService.php");

class AccountController {
    public function showRegisterForm() {
        include __DIR__ . '/../../views/register.php';
    }

    public function showLoginForm() {
        include __DIR__ . '/../../views/login.php';
    }

    public function create()
    {
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $repeated_password = filter_input(INPUT_POST, "repeatedPassword", FILTER_SANITIZE_SPECIAL_CHARS);

        syslog(LOG_EMERG, "parameters: $email, $password, $repeated_password");

        if ($password != $repeated_password) {
            echo "<p style='color:red;'>Passwords do not match.</p>";
            return;
        }

        $accountService = new AccountService();
        $accountService->createUserAccount($email, $password);
    }

}