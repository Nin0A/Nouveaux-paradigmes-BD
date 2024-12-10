<?php

$em = require __DIR__ . '/bootstrap.php';

use iutnc\doctrine\core\domain\entities\Specialite;


$specialiteRepository = $em->getRepository(Specialite::class);

$specialites = $specialiteRepository->getSpecialtitesByKeyword('dentaire');
print_r($specialites);