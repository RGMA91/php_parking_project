<?php

require_once(__DIR__ . "/../../configuration/DatabaseConfiguration.php");

class UserRepository {

    private $pdo;

    public function __construct()
    {
        $db = new DatabaseConfiguration();
        $this->pdo = $db->getDBConnection();
    }

    

}