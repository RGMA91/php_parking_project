<?php

require_once(__DIR__ . "/../service/ParkingService.php");

class ParkingController {

    private $parkingService;

    public function __construct() {
        $this->parkingService = new ParkingService();
    }

    public function getParkingList() {
        $parkingList = $this->parkingService->getParkingList();
        return $parkingList;
    }
}