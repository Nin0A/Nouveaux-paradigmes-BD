<?php

$em = require __DIR__ . '/bootstrap.php';

use iutnc\doctrine\core\domain\entities\Specialite;


$specialiteRepository = $em->getRepository(Specialite::class);


print "Question 2 : liste des spécialités contenant un mot clé dans le libellé ou la description\n";
$mot = 'Médecine';
$specialites = $specialiteRepository->getSpecialtitesByKeyword($mot);
print "Les spécialités contenant le mot clé $mot sont : \n";
foreach ($specialites as $specialite) {    
    print $specialite->getLibelle() . PHP_EOL;
}
