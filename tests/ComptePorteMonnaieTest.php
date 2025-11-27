<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\ComptePorteMonnaie;

class ComptePorteMonnaieTest extends TestCase { 

/** Creation d'un nouveau Compte Porte-Monnaie virtuel | Compte : Gabrielle | Fonction fait par Harvyn */

    public function test_nouveau_compteportemonnaie_est_vide(): void {
        

        $ComptePorteMonnaie = new ComptePorteMonnaie("Gabrielle");

        
        $solde = $ComptePorteMonnaie->getBalance();

        $this->assertSame(0, $solde, 'Un nouveau compte-porte-monnaie doit avoir un solde de 0€');
    }


/** ---- Ajout d'argent | Les Depots | Fonction fait par Gabrielle ----*/

    public function testAjouterArgentIncreasesBalance() 
    {
        
        $ComptePorteMonnaie = new ComptePorteMonnaie("Gabrielle");
        $ComptePorteMonnaie->ajouterArgent(50);

        
        $balance = $ComptePorteMonnaie->getBalance();
        
        $this->assertSame(50, $balance, 'Le solde doit être de 50€ après dépot');
    }

    public function testAjouterArgentNegatifLanceUneException() 
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Le montant à ajouter doit être positif.');

        
        $ComptePorteMonnaie = new ComptePorteMonnaie("Gabrielle");

        
        $ComptePorteMonnaie->ajouterArgent(-20);
    }


/** ---- Retrait d'argent | Les Retraits | Fonction fait par Gabrielle----*/

    public function testRetirerArgentDecreasesBalance() 
    {
        
        $ComptePorteMonnaie = new ComptePorteMonnaie("Gabrielle");
        $ComptePorteMonnaie->ajouterArgent(100);
        $ComptePorteMonnaie->retirerArgent(30);

        
        $balance = $ComptePorteMonnaie->getBalance();

        
        $this->assertSame(70, $balance, 'Le solde doit être de 70€ après retrait de 30€');
    }

    public function testRetirerPlusQueLeSoldeLanceUneException() 
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Fonds insuffisants pour ce retrait.');

        
        $ComptePorteMonnaie = new ComptePorteMonnaie("Gabrielle");
        $ComptePorteMonnaie->ajouterArgent(50);

        
        $ComptePorteMonnaie->retirerArgent(100);
    }

}
