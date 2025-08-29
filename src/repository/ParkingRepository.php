<?php

require_once(__DIR__ . "/../../configuration/DatabaseConfiguration.php");
require_once(__DIR__ . "/../model/Parking.php");

class ParkingRepository {
    private $pdo;

    public function __construct()
    {
        $db = new DatabaseConfiguration();
        $this->pdo = $db->getDBConnection();
    }

    public function getParkingList(){
        $stmtGetParkingList = $this->pdo->prepare("SELECT id, name, capacity FROM parking WHERE deleted = false");
        $stmtGetParkingList->execute();

        $parkings = [];
        while ($row = $stmtGetParkingList->fetch(PDO::FETCH_ASSOC)) {
            $parkings[] = new Parking(
            $row['id'],
            $row['name'],
            $row['capacity'],
            $row['created_at'] ?? null,
            $row['updated_at'] ?? null,
            $row['deleted'] ?? false
            );
        }
        
        return $parkings;
    }


}