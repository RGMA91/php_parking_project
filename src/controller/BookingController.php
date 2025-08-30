<?php

require_once(__DIR__ . "/../service/BookingService.php");
require_once(__DIR__ . "/../service/AuthorizationService.php");

class BookingController {

    private $bookingService;

    private $authorizationService;

    public function __construct() {
        $this->bookingService = new BookingService();
        $this->authorizationService = new AuthorizationService();
    }

    public function getBookingForm() {
        include __DIR__ . '/../../views/booking.php';
    }

    public function create() {

        $inputParkingId = filter_input(INPUT_POST, "parking-id", FILTER_UNSAFE_RAW);
        $inputAccessTime = filter_input(INPUT_POST, "access-time", FILTER_UNSAFE_RAW);
        $inputExitTime = filter_input(INPUT_POST, "exit-time", FILTER_UNSAFE_RAW);
        $jwt = filter_input(INPUT_POST,"jwt-token", FILTER_UNSAFE_RAW);

        $claims = $this->authorizationService->validateJWT($jwt);
        var_dump($claims);
        if ($claims == false) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }

         if ($claims['role'] == 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'Forbidden']);
            return;
        }

        $isBooked = $this->bookingService->createBooking($inputExitTime, $inputAccessTime, $inputParkingId, $claims["id"]);
        if ($isBooked == false) {
            http_response_code(409);
            echo json_encode(['error' => 'Conflict: booking could not be made, try other date and time']);
            return;
        }
        
        http_response_code(200);
        echo json_encode(['message' => 'Booking made']);
    }

}