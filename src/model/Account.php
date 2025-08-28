<?php

class Account {

    public int $id;
    public string $email;
    public string $passhash;
    public string $role;
    public string $created_at;
    public ?string $updated_at;
    public bool $deleted;

    public function __construct($id, $email, $passhash, $role, $created_at, $updated_at, $deleted) {
        $this->id = $id;
        $this->email = $email;
        $this->passhash = $passhash;
        $this->role = $role;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->deleted = (bool)$deleted;
    }
    
}