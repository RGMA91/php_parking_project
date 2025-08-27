<?php

require_once(__DIR__ . "/../../configuration/DatabaseConfiguration.php");

class AccountRepository
{

    private $pdo;

    public function __construct()
    {
        $db = new DatabaseConfiguration();
        $this->pdo = $db->getDBConnection();
    }

    public function createAccountAndUserTransaction($name, $surname, $phone, $email, $passhash)
    {
        try {
            $beginTransaction = $this->pdo->prepare("START TRANSACTION");
            $beginTransaction->execute();

            $stmtInsertAccount = $this->pdo->prepare("INSERT INTO account (email, passhash, role) VALUES (:email, :passhash, :role)");
            $stmtInsertAccount->execute([
                ':email' => $email,
                ':passhash' => $passhash,
                ':role' => 'user'
            ]);

            $stmtGetInsertedAccountId = $this->pdo->prepare("SELECT id FROM account WHERE email = :email");
            $stmtGetInsertedAccountId->execute([
                ':email' => $email
            ]);
            $accountId = $stmtGetInsertedAccountId->fetchColumn();

            print('accountId: ' . $accountId);

            $stmtInsertUser = $this->pdo->prepare("INSERT INTO user (account_id, name, surname, phone) VALUES (:account_id, :name, :surname, :phone)");
            $stmtInsertUser->execute([
                ':account_id' => $accountId,
                ':name' => $name,
                ':surname' => $surname,
                ':phone'=> $phone
            ]);

            $commit = $this->pdo->prepare("COMMIT;");
            $commit->execute();

        } catch (PDOException $e) {

            $rollback = $this->pdo->prepare("ROLLBACK;");
            $rollback->execute();

            throw $e;
        }
    }

}


?>