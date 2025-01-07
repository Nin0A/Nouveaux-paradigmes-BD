<?php

$em = require __DIR__ . '/bootstrap.php';

use iutnc\doctrine\core\domain\entities\Specialite;
use iutnc\doctrine\core\domain\entities\TypeGroupement;
use iutnc\doctrine\core\domain\entities\Praticien;

// Récupération des repositories
$praticienRepository = $em->getRepository(Praticien::class);
$specialiteRepository = $em->getRepository(Specialite::class);
$typeGroupementRepository = $em->getRepository(TypeGroupement::class);

// Question n°1
print "##############################################################################". PHP_EOL;
print "Question 1 : Afficher le praticien dont le mail est Gabrielle.Klein@live.com. \n";
print "------------------------------------------------------------------------------". PHP_EOL;

$praticien1 = $praticienRepository
    ->findOneBy(["email" => "Gabrielle.Klein@live.com"]);

print $praticien1->getPrenom() . ' ' . $praticien1->getNom() . ' -> ' . $praticien1->getEmail(). PHP_EOL;

//Question n°2
print PHP_EOL;
print "##############################################################################". PHP_EOL;
print "Question 2 : Afficher le praticien de nom Goncalves à Paris. \n";
print "------------------------------------------------------------------------------". PHP_EOL;

$praticien2 = $praticienRepository
    ->findOneBy(["nom" => "Goncalves", "ville" => "Paris"]);

print $praticien2->getPrenom() . ' ' . $praticien2->getNom() . ' de '. $praticien2->getVille() .' -> ' . $praticien2->getEmail(). PHP_EOL;

//Question n°3
print PHP_EOL;
print "##############################################################################". PHP_EOL;
print "Question 3 : Afficher la spécialité de libellé 'pédiatrie' ainsi que les praticiens associés. \n";
print "------------------------------------------------------------------------------". PHP_EOL;

$specialite = $specialiteRepository
    ->findOneBy(["libelle" => "pédiatrie"]);
print "Spécialité : " . $specialite->getLibelle() . ' -> ' . $specialite->getDescription() . PHP_EOL;
print "Praticiens associés : \n";
foreach ($specialite->getPraticiens() as $praticien) {
    print " - " . $praticien->getPrenom() . ' ' . $praticien->getNom() . PHP_EOL;
}

//Question n°4
print PHP_EOL;
print "##############################################################################". PHP_EOL;
print "Question 4 : Afficher les types de groupements contenants 'santé' dans leur description. \n";
print "------------------------------------------------------------------------------". PHP_EOL;

$typeGroupements = $typeGroupementRepository
    ->findBy([]);
print "Types de groupements contenant 'santé' dans leur description :" . PHP_EOL;
foreach ($typeGroupements as $type)
    if (str_contains($type->getDescription(), "santé"))
        print "- " . $type->getLibelle() . " -> " . $type->getDescription() . PHP_EOL;

//Question n°5
print PHP_EOL;
print "##############################################################################". PHP_EOL;
print "Question 5 : afficher les praticiens de la spécialité 'ophtalmologie' exerçants à Paris. \n";
print "------------------------------------------------------------------------------". PHP_EOL;

$specialite2 = $specialiteRepository
    ->findOneBy(["libelle" => "ophtalmologie"]);
print "Praticiens de la spécialité 'ophtalmologie' exerçant à Paris :" . PHP_EOL;
foreach ($specialite2->getPraticiens() as $praticien)
    if (str_contains($praticien->getVille(), "Paris"))
        print "- " . $praticien->getPrenom() . ' ' . $praticien->getNom() . PHP_EOL;
print PHP_EOL;
