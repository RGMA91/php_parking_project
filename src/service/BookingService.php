<?php

require_once(__DIR__ . "/../repository/BookingRepository.php");
require_once(__DIR__ . "/../repository/UserRepository.php");

class BookingService {

    private $bookingRepository;

    private $userRepository;

    public function __construct() {
        $this->bookingRepository = new BookingRepository();
        $this->userRepository = new UserRepository();
    }

    public function createBooking($inputExitTime, $inputAccessTime, $inputParkingId, $accountId) {
        $userId = $this->userRepository->getUserIdByAccountId($accountId);
        $isBooked = $this->bookingRepository->transactionCreateBooking($inputExitTime, $inputAccessTime, $inputParkingId, $userId);
        return $isBooked;
    }


}