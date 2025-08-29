<?php

require_once(__DIR__ . "/../repository/BookingRepository.php");

class BookingService {

    private $bookingRepository;

    public function __construct() {
        $this->bookingRepository = new BookingRepository();
    }

    public function createBooking($inputExitTime, $inputAccessTime, $inputParkingId, $claims) {
        // get id from $claims
        $userId = 0;
        $booking = $this->bookingRepository->transactionCheckAvailabilityAndCreateBooking($inputExitTime, $inputAccessTime, $inputParkingId, $userId);
        return $booking;
    }


}