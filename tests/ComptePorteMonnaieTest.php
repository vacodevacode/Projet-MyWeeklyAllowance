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


    /** ---- Ajout d'argent | Les Depots | Fonction fait par  ----*/

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


    /** ---- Retrait d'argent | Les Retraits | Fonction fait par ----*/

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


    /** ---- Historique des transactions | Fonction fait par ---- */

    public function testHistoriqueDesDepots(): void
    {

        $ComptePorteMonnaie = new ComptePorteMonnaie("Gabrielle");
        $ComptePorteMonnaie->ajouterArgent(100);
        $ComptePorteMonnaie->ajouterArgent(50);
        $ComptePorteMonnaie->ajouterArgent(200);


        $historique = $ComptePorteMonnaie->getHistoriqueTransactions();


        $this->assertCount(3, $historique, 'L\'historique doit contenir 3 dépôts.');
        $this->assertSame('Depot', $historique[0]['type'], 'La première transaction doit être un dépot de 100€.');
        $this->assertSame(100, $historique[0]['montant'], 'La première transaction doit être un dépot de 100€.');

        $this->assertSame('Depot', $historique[1]['type'], 'La deuxième transaction doit être un dépot de 50€.');
        $this->assertSame(50, $historique[1]['montant'], 'La deuxième transaction doit être un dépot de 50€.');

        $this->assertSame('Depot', $historique[2]['type'], 'La troisième transaction doit être un dépot de 200€.');
        $this->assertSame(200, $historique[2]['montant'], 'La troisième transaction doit être un dépot de 200€.');
    }

    public function testHistoriqueDesRetraits(): void
    {

        $ComptePorteMonnaie = new ComptePorteMonnaie("Gabrielle");
        $ComptePorteMonnaie->ajouterArgent(300);
        $ComptePorteMonnaie->retirerArgent(50);
        $ComptePorteMonnaie->retirerArgent(100);




        $historique = $ComptePorteMonnaie->getHistoriqueTransactions();

        $this->assertCount(3, $historique, 'L\'historique doit contenir 3 transactions.');
        $this->assertSame('Retrait', $historique[1]['type'], 'La deuxième transaction doit être un retrait de 50€.');
        $this->assertSame(50, $historique[1]['montant'], 'La deuxième transaction doit être un retrait de 50€.');

        $this->assertSame('Retrait', $historique[2]['type'], 'La troisième transaction doit être un retrait de 100€.');
        $this->assertSame(100, $historique[2]['montant'], 'La troisième transaction doit être un retrait de 100€.');
    }



    public function testHistoriqueDesTransactions(): void
    {

        $ComptePorteMonnaie = new ComptePorteMonnaie("Gabrielle");
        $ComptePorteMonnaie->ajouterArgent(200);
        $ComptePorteMonnaie->retirerArgent(50);
        $ComptePorteMonnaie->ajouterArgent(100);


        $historique = $ComptePorteMonnaie->getHistoriqueTransactions();


        $this->assertCount(3, $historique, 'L\'historique doit contenir 3 transactions.');
        $this->assertSame('Depot', $historique[0]['type'], 'La première transaction doit être un dépot de 200€.');
        $this->assertSame('Retrait', $historique[1]['type'], 'La deuxième transaction doit être un retrait de 50€.');
        $this->assertSame('Depot', $historique[2]['type'], 'La troisième transaction doit être un dépot de 100€.');
    }

    public function testHistoriqueVideAuDebut(): void
    {

        $ComptePorteMonnaie = new ComptePorteMonnaie("Gabrielle");


        $historique = $ComptePorteMonnaie->getHistoriqueTransactions();


        $this->assertEmpty($historique, 'L\'historique des transactions doit être vide pour un nouveau compte.');
    }

}
