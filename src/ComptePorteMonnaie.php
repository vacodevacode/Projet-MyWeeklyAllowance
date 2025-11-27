<?php

namespace App;

class ComptePorteMonnaie {

    private string $owner;
    private int $balance;
    private array $historique;
    private int $allocationHebdomadaire = 1;

    public function __construct(string $owner) {
        $this->owner = $owner;
        $this->balance = 0;
        $this->historique = [];
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

    public function getHistoriqueTransactions(): array {
        return $this->historique;
    }

    public function definirAllocationHebdomadaire(int $montant): void {
        if ($montant < 0) {
            throw new \InvalidArgumentException("L'allocation hebdomadaire doit être un montant positif.");
        }

        $this->allocationHebdomadaire = $montant;
    }
    
    public function AppliquerAllocationHebdomadaire(int $montant): void {

        if ($montant < 0) {
            throw new \InvalidArgumentException("L'allocation hebdomadaire doit être un montant positif.");
        }

        $this->allocationHebdomadaire = $montant;

    }

    public function recevoirAllocationHebdomadaire(): void {
        $this->balance += $this->allocationHebdomadaire;
        $this->historique[] = ['type' => 'Allocation Hebdomadaire', 'montant' => $this->allocationHebdomadaire];
    }
}