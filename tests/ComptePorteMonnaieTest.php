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

}
