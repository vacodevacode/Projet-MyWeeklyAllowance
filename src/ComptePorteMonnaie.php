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
    

    public function ajouterArgent(int $montant): void {

        if ($montant < 0) {
            throw new \InvalidArgumentException("Le montant à ajouter doit être positif.");
        }

        $this->balance += $montant;

        $this->historique[] = ['type' => 'Depot', 'montant' => $montant];
    }

    public function retirerArgent(int $montant): void {

        if ($montant < 0) {
            throw new \InvalidArgumentException("Le montant à retirer doit être positif.");
        }

        if ($montant > $this->balance) {
            throw new \RuntimeException("Fonds insuffisants pour ce retrait.");
        }
        
        $this->balance -= $montant;

        $this->historique[] = ['type' => 'Retrait', 'montant' => $montant];
    }

}