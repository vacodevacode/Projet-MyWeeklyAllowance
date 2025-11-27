<?php

namespace App;

class ComptePorteMonnaie {

    private string $owner;
    private int $balance;

    public function __construct(string $owner) {
        $this->owner = $owner;
        $this->balance = 0;
        
    }

    public function getBalance(): int {
        return $this->balance;
    }
    
}
