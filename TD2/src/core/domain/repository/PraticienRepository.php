<?php

namespace iutnc\doctrine\core\domain\repository;


use Doctrine\ORM\EntityRepository;

class PraticienRepository extends EntityRepository
{

    public function getPraticienBySpecialite($specialite): array
    {
        $dql = "SELECT p.nom, p.telephone
            FROM iutnc\doctrine\core\domain\\entities\Praticien p
            LEFT JOIN p.specialite s
            WHERE s.libelle = :specialiteNom";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('specialiteNom', $specialite);

        return $query->getResult();
    }
}
