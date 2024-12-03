<?php
$em = require __DIR__ . '/bootstrap.php';

use iutnc\doctrine\core\domain\entities\Specialite;
use iutnc\doctrine\core\domain\entities\TypeGroupement;
use iutnc\doctrine\core\domain\entities\Praticien;

$specialiteRepository = $em->getRepository(Specialite::class);
$typeGroupementRepository = $em->getRepository(TypeGroupement::class);
$praticienRepository = $em->getRepository(Praticien::class);  


$specialite = $specialiteRepository->find(1);
print "Question 1 : Afficher la spécialité d'identifiant 1\n";
print $specialite->getId() . "\n";
print $specialite->getLibelle() . "\n";
print $specialite->getDescription() . "\n";

$typeGroupement = $typeGroupementRepository->find(1);
print "Question 2 : Afficher le type de groupement n°1\n";
print $typeGroupement->getId() . "\n";
print $typeGroupement->getLibelle() . "\n";
print $typeGroupement->getDescription() . "\n";

$praticien = $praticienRepository->findOneBy(['id' => "8ae1400f-d46d-3b50-b356-269f776be532"]);
print "Question 3 : Afficher le praticien dont l'id est 8ae1400f-d46d-3b50-b356-269f776be532 \n";
print $praticien->getId() . "\n";
print $praticien->getNom() . "\n";
print $praticien->getPrenom() . "\n";
print $praticien->getVille() . "\n";
print $praticien->getEmail() . "\n";
print $praticien->getTelephone() . "\n";




