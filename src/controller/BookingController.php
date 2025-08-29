<?php

require_once(__DIR__ . "/../service/BookingService.php");

class BookingController {

    private $bookingService;

    public function __construct() {
        $this->bookingService = new BookingService();
    }

    public function getBookingForm() {
        include __DIR__ . '/../../views/booking.php';
    }

    public function create() {
        $inputParkingId = filter_input(INPUT_POST, "parking-id", FILTER_UNSAFE_RAW);
        $inputAccessTime = filter_input(INPUT_POST, "access-time", FILTER_UNSAFE_RAW);
        $inputExitTime = filter_input(INPUT_POST, "exit-time", FILTER_UNSAFE_RAW);
        $jwt = filter_input(INPUT_POST,"jwt-token", FILTER_UNSAFE_RAW);

        //$isBooked = $this->bookingService->createBooking($inputExitTime, $inputAccessTime, $inputParkingId, $jwt);
        //echo 'createt booking?: '. $isBooked;
        echo 'Parking id: ' . $inputParkingId . ' Access time: ' . $inputAccessTime . ' Exit time: ' . $inputExitTime .' JWT: ' . $jwt;
    }

}