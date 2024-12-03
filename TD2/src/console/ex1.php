<?php
$em = require __DIR__ . '/bootstrap.php';

use iutnc\doctrine\core\domain\entities\Specialite;
use iutnc\doctrine\core\domain\entities\TypeGroupement;
use iutnc\doctrine\core\domain\entities\Praticien;
use iutnc\doctrine\core\domain\entities\Groupement;

$specialiteRepository = $em->getRepository(Specialite::class);
$typeGroupementRepository = $em->getRepository(TypeGroupement::class);
$praticienRepository = $em->getRepository(Praticien::class); 
$groupementRepository = $em->getRepository(Groupement::class); 


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

print "Question 4 : Compléter en affichant sa spécialité et son groupement de rattachement \n";
print $praticien->getSpecialite()->getLibelle() . "\n";
print $praticien->getGroupement()->getNom() . "\n";


print "Question 5 : Créer un praticien, spécialité pédiatrie, et le sauvegarder dans la base \n";
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

print "Question 6 : Modifier ce praticien : le rattacher au groupement Bigot, changer sa ville pour Paris et
sauvegarder dans la base \n";
$praticien = $praticienRepository->findOneBy(['id' => "7202b2f8-06be-42da-abf7-c40ac842b827"]);
$praticien->setGroupement($groupementRepository->findOneBy(['nom' => "Bigot"]));
$praticien->setVille("Paris");
$em->flush();

print "Question 7 : Supprimer ce praticien de la base \n";
$em->remove($praticien);
$em->flush();





