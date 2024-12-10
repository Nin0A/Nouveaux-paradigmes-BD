<?php

$em = require __DIR__ . '/bootstrap.php';

use iutnc\doctrine\core\domain\entities\Praticien;
// use iutnc\doctrine\core\domain\entities\Specialite;

$praticienRepository = $em->getRepository(Praticien::class);
// $specialiteRepository = $em->getRepository(Specialite::class);


#Exercice 1

$praticien = $praticienRepository->getPraticienBySpecialite('Dentiste');
print_r($praticien);

// #Exercice 2
// $specialites = $specialiteRepository->getSpecialtitesByKeyword('dentaire');
// print_r($specialites);
