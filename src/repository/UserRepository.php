<?php

require_once(__DIR__ . "/../../configuration/DatabaseConfiguration.php");

class UserRepository {

    private $pdo;

    public function __construct()
    {
        $db = new DatabaseConfiguration();
        $this->pdo = $db->getDBConnection();
    }

    public function getUserIdByAccountId($accountId): int{
        $stmtGetUserIdByAccountId = $this->pdo->prepare("SELECT id FROM user WHERE account_id = :account_id");
        $stmtGetUserIdByAccountId->execute([
            ':account_id' => $accountId
        ]);
        $userId = $stmtGetUserIdByAccountId->fetchColumn();
        return $userId;
    }

    

}