<?php

require_once(__DIR__ . "/../../configuration/DatabaseConfiguration.php");


class BookingRepository{

    private $pdo;

    public function __construct() {
        $db = new DatabaseConfiguration();
        $this->pdo = $db->getDBConnection();
    }

    public function transactionCreateBooking($inputExitTime, $inputAccessTime, $inputParkingId, $userId) {
        
        $beginTransaction = $this->pdo->prepare("START TRANSACTION");
        $beginTransaction->execute();

        $stmtCountBookingsByTimeFrame = $this->pdo->prepare("SELECT COUNT(*) FROM booking 
        WHERE booked_access_time < :input_exit_time AND booked_exit_time > :input_access_time AND parking_id = :input_parking_id AND deleted = 0;");
        $stmtCountBookingsByTimeFrame->execute([
            ':input_exit_time' => $inputExitTime,
            ':input_access_time' => $inputAccessTime,
            ':input_parking_id' => $inputParkingId]);
        $numberOfBookings = $stmtCountBookingsByTimeFrame->fetchColumn();
        
        $stmtGetParkingCapacityById = $this->pdo->prepare("SELECT capacity FROM parking WHERE id = :parking_id AND deleted = false");
        $stmtGetParkingCapacityById->execute([
            ':parking_id' => $inputParkingId]);
        $capacity = $stmtGetParkingCapacityById->fetchColumn();
        
        if ($capacity <= $numberOfBookings) {
            $rollbackTransaction = $this->pdo->prepare("ROLLBACK;");
            $rollbackTransaction->execute();
            return false;
        }

        $stmtInsertAccount = $this->pdo->
        prepare("INSERT INTO booking (parking_id, user_id, booked_access_time, booked_exit_time) 
        VALUES (:input_parking_id, :user_id, :input_access_time, :input_exit_time)");
        $stmtInsertAccount->execute([
            ':input_parking_id' => $inputParkingId,
            ':user_id' => $userId,
            ':input_access_time' => $inputAccessTime,
            ':input_exit_time'=> $inputExitTime
        ]);
        $commitTransaction = $this->pdo->prepare("COMMIT;");
        $commitTransaction->execute();
        return true;
        
    }
}