<?php

$em = require __DIR__ . '/bootstrap.php';

use iutnc\doctrine\core\domain\entities\Praticien;
use iutnc\doctrine\core\domain\entities\Specialite;
use iutnc\doctrine\core\domain\entities\Personnel;

// Récupération des repositories
$praticienRepository = $em->getRepository(Praticien::class);
$specialiteRepository = $em->getRepository(Specialite::class);
$personnelRepository = $em->getRepository(Personnel::class);

// Question n°1
print "#####################################################################################################". PHP_EOL;
print "Question 1 : liste des praticiens d'une spécialité donnée, en incluant leur groupement d’appartenance\n";
print "-----------------------------------------------------------------------------------------------------". PHP_EOL;

$specialite = 'Dentiste';
$praticiens = $praticienRepository->getPraticienBySpecialite($specialite);
print "Les praticiens de la spécialité $specialite sont : \n";
foreach ($praticiens as $praticien) {
    print "- " . $praticien->getNom() . ' ' . $praticien->getPrenom() . ' du groupement -> ' . $praticien->getGroupement()->getNom() . PHP_EOL;
}

// Question n°2
print PHP_EOL;
print "#####################################################################################################". PHP_EOL;
print "Question 2 : liste des spécialités contenant un mot clé dans le libellé ou la description\n";
print "-----------------------------------------------------------------------------------------------------". PHP_EOL;

$mot = 'Médecine';
$specialites = $specialiteRepository->getSpecialtitesByKeyword($mot);
print "Les spécialités contenant le mot clé $mot dans le libelle ou la description sont : \n";
foreach ($specialites as $specialite) {
    print "- " . $specialite->getLibelle(). PHP_EOL;
}

// Question n°3
print PHP_EOL;
print "#####################################################################################################". PHP_EOL;
print "Question 3 : liste des praticiens d’une spécialité donnée exerçant dans une ville donnée\n";
print "-----------------------------------------------------------------------------------------------------". PHP_EOL;

$ville2 = 'Diaz-sur-Boulanger';
$specialite2 = 'Dentiste';
$praticiens = $praticienRepository->getPraticienBySpeAndCity($specialite2, $ville2);
print "Les praticiens de la spécialité $specialite2 exerçant à $ville2 sont : \n";
foreach ($praticiens as $praticien) {
    print "- " . $praticien->getNom() . ' ' . $praticien->getPrenom() . PHP_EOL;
}

// Question n°4
print PHP_EOL;
print "#####################################################################################################". PHP_EOL;
print "Question 4 : Liste des personnels travaillant dans une ville donnée\n";
print "-----------------------------------------------------------------------------------------------------". PHP_EOL;

$ville = 'Moreno';
$personnels = $personnelRepository->getPersonnelByVille($ville);
print "Les personnels travaillant à $ville sont : \n";
foreach ($personnels as $personnel) {
    print "- " . $personnel->getNom() . ' ' . $personnel->getPrenom() . PHP_EOL;
}
print PHP_EOL;

