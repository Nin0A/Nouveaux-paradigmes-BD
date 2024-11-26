<?php
$em = require __DIR__ . '/bootstrap.php';

use iutnc\doctrine\core\domain\entities\Specialite;

$specialiteRepository = $em->getRepository(Specialite::class);


$specialite = $specialiteRepository->find(1);
print "Question 1 :\n";
print $specialite->getId() . "\n";
print $specialite->getLibelle() . "\n";
print $specialite->getDescription() . "\n";

print "Question 2 :\n";


