<?php
$em = require __DIR__ . '/bootstrap.php';

use iutnc\doctrine\core\domain\entities\Specialite;
use iutnc\doctrine\core\domain\entities\TypeGroupement;
use iutnc\doctrine\core\domain\entities\Praticien;
use iutnc\doctrine\core\domain\entities\Groupement;

// Récupération des repositories
$specialiteRepository = $em->getRepository(Specialite::class);
$typeGroupementRepository = $em->getRepository(TypeGroupement::class);
$praticienRepository = $em->getRepository(Praticien::class); 
$groupementRepository = $em->getRepository(Groupement::class); 

// Question 1
print "##############################################################################". PHP_EOL;
print "Question 1 : Afficher la spécialité d'identifiant 1. \n";
print "------------------------------------------------------------------------------". PHP_EOL;

$specialite = $specialiteRepository->find(1);
print " | Id : " . $specialite->getId() . PHP_EOL . 
      " | Specialite : " . $specialite->getLibelle() . PHP_EOL . 
      " | Description : " . $specialite->getDescription() . PHP_EOL;

// Question 2
print PHP_EOL;
print "##############################################################################". PHP_EOL;
print "Question 2 : Afficher le type de groupement n°1. \n";
print "------------------------------------------------------------------------------". PHP_EOL;

$typeGroupement = $typeGroupementRepository->find(1);
print " | Id : " . $typeGroupement->getId() . PHP_EOL . 
      " | TypeGroupement : " . $typeGroupement->getLibelle() . PHP_EOL . 
      " | Description : " . $typeGroupement->getDescription() . PHP_EOL;

// Question 3
print PHP_EOL;
print "##############################################################################". PHP_EOL;
print "Question 3 : Afficher le praticien dont l’id est : 8ae1400f-d46d-3b50-b356-269f776be532. \n";
print "------------------------------------------------------------------------------". PHP_EOL;

$praticien = $praticienRepository->findOneBy(['id' => "8ae1400f-d46d-3b50-b356-269f776be532"]);
print " | Id : " . $praticien->getId() . PHP_EOL . 
      " | Nom : " . $praticien->getNom() . PHP_EOL . 
      " | Prenom : " . $praticien->getPrenom() . PHP_EOL . 
      " | Ville : " . $praticien->getVille() . PHP_EOL .  
      " | Email : " . $praticien->getEmail() . PHP_EOL . 
      " | Telephone : " . $praticien->getTelephone() . PHP_EOL;

// Question 4
print PHP_EOL;
print "##############################################################################". PHP_EOL;
print "Question 4 : Compléter en affichant sa spécialité et son groupement de rattachement \n";
print "------------------------------------------------------------------------------". PHP_EOL;

print " | Specialité : " . $praticien->getSpecialite()->getLibelle() . PHP_EOL . 
      " | Groupement : " . $praticien->getGroupement()->getNom() . PHP_EOL;

// Question 5
print PHP_EOL;
print "##############################################################################". PHP_EOL;
print "Question 5 : Créer un praticien, spécialité pédiatrie, et le sauvegarder dans la base \n";
print "------------------------------------------------------------------------------". PHP_EOL;

$newPraticien = new Praticien();
$newPraticien->setId("7202b2f8-06be-42da-abf7-c40ac842b827");
$newPraticien->setNom("Arcelin");
$newPraticien->setPrenom("Nino");
$newPraticien->setVille("Nancy");
$newPraticien->setEmail("ninoarcelin@gmail.com");
$newPraticien->setTelephone("06 06 06 06 06");
$newPraticien->setSpecialite($specialiteRepository->findOneBy(['libelle' => "pédiatrie"]));
// $em->persist($newPraticien);
// $em->flush();
print "Praticien créé avec l'id : " . $newPraticien->getId() . "\n";

// Question 6
print PHP_EOL;
print "##############################################################################". PHP_EOL;
print "Question 6 : Modifier ce praticien : le rattacher au groupement Bigot, changer sa ville pour Paris et
sauvegarder dans la base \n";
print "------------------------------------------------------------------------------". PHP_EOL;

$praticien = $praticienRepository->findOneBy(['id' => "7202b2f8-06be-42da-abf7-c40ac842b827"]);
$praticien->setGroupement($groupementRepository->findOneBy(['nom' => "Bigot"]));
$praticien->setVille("Paris");
$em->flush();

// Question 7
print PHP_EOL;
print "##############################################################################". PHP_EOL;
print "Question 7 : Supprimer ce praticien de la base \n";
print "------------------------------------------------------------------------------". PHP_EOL;

$em->remove($praticien);
$em->flush();





