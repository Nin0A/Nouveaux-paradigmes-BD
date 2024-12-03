<?php

$em = require __DIR__ . '/bootstrap.php';

use iutnc\doctrine\core\domain\entities\Specialite;
use iutnc\doctrine\core\domain\entities\TypeGroupement;
use iutnc\doctrine\core\domain\entities\Praticien;

$praticienRepository = $em->getRepository(Praticien::class);
$specialiteRepository = $em->getRepository(Specialite::class);
$typeGroupementRepository = $em->getRepository(TypeGroupement::class);

// Question n°1

$result_rq_1 = $praticienRepository
    ->findOneBy(["email" => "Gabrielle.Klein@live.com"]);

print($result_rq_1->getNom() . "\n");

//Question n°2

$result_rq_2 = $praticienRepository
    ->findOneBy(["nom" => "Goncalves", "ville" => "Paris"]);

print($result_rq_2->getEmail() . "\n");

//Question n°3

$result_rq_3 = $specialiteRepository
    ->findOneBy(["libelle" => "pédiatrie"]);

print($result_rq_3->getDescription() . "\n");


foreach ($result_rq_3->getPraticiens() as $praticien) {

    print(" - " . $praticien->getNom() . "\n");
}

//Question n°4
$result_rq_4 = $typeGroupementRepository
    ->findBy([]);

foreach ($result_rq_4 as $rq)
    if (str_contains($rq->getDescription(), "santé"))
        print(" - Libelle : " . $rq->getLibelle() . "| Decsription : " . $rq->getDescription() . "\n");

//Question n°5

$result_rq_5 = $specialiteRepository
    ->findOneBy(["libelle" => "ophtalmologie"]);

foreach ($result_rq_5->getPraticiens() as $rq)
    if (str_contains($rq->getVille(), "Paris"))
        print(" - " . $rq->getNom() . "\n");
