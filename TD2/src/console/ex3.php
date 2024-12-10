<?php

$em = require __DIR__ . '/bootstrap.php';

use iutnc\doctrine\core\domain\entities\Praticien;
use iutnc\doctrine\core\domain\entities\Specialite;

$praticienRepository = $em->getRepository(Praticien::class);
$specialiteRepository = $em->getRepository(Specialite::class);


print "Question 1 : liste des praticiens d'une spécialité donnée, en incluant leur groupement d’appartenance\n";

$praticien = $praticienRepository->getPraticienBySpecialite('Dentiste');
print_r($praticien);

print "Question 2 : liste des spécialités contenant un mot clé dans le libellé ou la description\n";
$mot = 'Médecine';
$specialites = $specialiteRepository->getSpecialtitesByKeyword($mot);
print "Les spécialités contenant le mot clé $mot sont : \n";
foreach ($specialites as $specialite) {
    print $specialite->getLibelle() . PHP_EOL;
}


print "Question 3 : liste des praticiens d’une spécialité donnée exerçant dans une ville donnée\n";

$praticien = $praticienRepository->getPraticienBySpeAndCity('Dentiste', 'Diaz-sur-Boulanger');
print_r($praticien);
