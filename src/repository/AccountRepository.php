<?php

require_once(__DIR__ . "/../../configuration/DatabaseConfiguration.php");
require_once(__DIR__ . "/../model/Account.php");


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

            // Check for duplicate entry error (MySQL error code 1062)
            if ($e->getCode() == 23000 && strpos($e->getMessage(), '1062') !== false) {
                http_response_code(409);
                echo json_encode(['error' => 'Conflict: Email already registered']);
                exit;
            }

            throw $e;
        }
    }

    public function getAccountByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM account WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Account(
                $row['id'],
                $row['email'],
                $row['passhash'],
                $row['role'],
                $row['created_at'],
                $row['updated_at'],
                $row['deleted']
            );
        }
        return null;
    }

}


?>