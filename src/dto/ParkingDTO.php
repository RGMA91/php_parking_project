<?php

class ParkingDTO {
    public int $id;
    public string $name;
    public int $capacity;

    public function __construct($id, $name, $capacity) {
        $this->id = $id;
        $this->name = $name;
        $this->capacity = $capacity;
    }
}
