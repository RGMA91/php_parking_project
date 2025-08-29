<?php

class Parking {

    public int $id;
    public string $name;
    public int $capacity;
    public ?string $created_at;
    public ?string $updated_at;
    public bool $deleted;

    public function __construct($id, $email, $passhash, $created_at, $updated_at, $deleted) {
        $this->id = $id;
        $this->name = $email;
        $this->capacity = $passhash;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->deleted = (bool)$deleted;
    }
}