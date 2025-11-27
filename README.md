# Projet_MyWeeklyAllowance 

## Consigne 

Vous allez concevoir un module de gestion d’argent de poche pour adolescents, selon la méthode TDD (Test Driven Development).

**Votre mission :** commencer par les tests unitaires, puis développer le code étape par étape jusqu’à ce que tous les tests passent.



## Contexte du projet : MyWeeklyAllowance
L’application MyWeeklyAllowance permet aux parents de gérer un “porte-monnaie virtuel” pour leurs ados.
Chaque adolescent a un compte d’argent de poche, et chaque parent peut :
- créer un compte pour un ado,
- déposer de l’argent,
- enregistrer des dépenses,
- fixer une allocation hebdomadaire automatique.


## Installation

### Prérequis
- PHP 8.0 ou supérieur
- Composer

### Étapes d'installation

1. Cloner le projet
```bash
git clone [url-du-projet]
cd Projet_MyWeeklyAllowance
```

2. Installer les dépendances
```bash
composer install
```

## Tests

### Lancer tous les tests
```bash
vendor/bin/phpunit
```

### Lancer un test spécifique
```bash
vendor/bin/phpunit --filter <nom_du_test> Tests/ComptePorteMonnaieTest.php
```

**Exemple :**
```bash
vendor/bin/phpunit --filter testHistoriqueVideAuDebut Tests/ComptePorteMonnaieTest.php
```
## Équipe

### Projet réalisé par : 
- M'FOUMOUNE Gabrielle
- PILLAH Niali henri guy-harvyn
- MABANZA Danali
- LAMNAOUAR Fouad