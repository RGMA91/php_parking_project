<?php

require_once(__DIR__ . "/../repository/AccountRepository.php");
require_once(__DIR__ . "/AuthorizationService.php");


class AccountService {
    private $accountRepository;

    private $authorizationService;

    public function __construct() {
        $this->accountRepository = new AccountRepository();
        $this->authorizationService = new AuthorizationService();
    }

    public function createUserAccount($name, $surname, $phone, $email, $password) {
        $hashpass = password_hash($password, PASSWORD_BCRYPT);
        syslog(LOG_EMERG,"hashpass: $hashpass ");
        $this->accountRepository->createAccountAndUserTransaction($name, $surname, $phone, $email, $hashpass);
    }

    public function authenticateUserAndReturnJwt($email, $password) {

        $account = $this->accountRepository->getAccountByEmail($email);

        if (password_verify($password, $account->passhash)) {
            $jwt = $this->authorizationService->generateJWT($email, $password, $account->role);
            echo 'Password is valid!, JWT: '. $jwt;
        } else {
            echo 'Invalid password.';
        }

    }

}

?>
