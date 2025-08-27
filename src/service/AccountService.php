<?php

require_once(__DIR__ . "/../repository/AccountRepository.php");

class AccountService {
    private $accountRepository; 

    public function __construct() {

        $this->accountRepository = new AccountRepository();
    }

    public function createUserAccount($name, $surname, $phone, $email, $password) {
        $hashpass = password_hash($password, PASSWORD_BCRYPT);
        syslog(LOG_EMERG,"hashpass: $hashpass ");
        $this->accountRepository->createAccountAndUserTransaction($name, $surname, $phone, $email, $hashpass);
    }

}

?>
