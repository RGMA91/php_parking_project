<?php

require_once(__DIR__ . "/../repository/ParkingRepository.php");
require_once(__DIR__ . "/../dto/ParkingDTO.php");
require_once(__DIR__ . "/../model/Parking.php");

class ParkingService {

    private $parkingRepository;

    public function __construct() {
        $this->parkingRepository = new ParkingRepository();
    }

    public function getParkingList() {
        $parkingList = $this->parkingRepository->getParkingList();
        $parkingDtoList = $this->getParkingDtoList($parkingList);
        return $parkingDtoList;
    }

    function mapParkingToDTO(Parking $parking): ParkingDTO {
    return new ParkingDTO(
        $parking->id,
        $parking->name,
        $parking->capacity
    );
    }

    public function getParkingDTOList($parkingList) {
        $dtoList = [];
        foreach ($parkingList as $parking) {
            $dtoList[] = $this->mapParkingToDTO($parking);
        }
        return $dtoList;
    }


}