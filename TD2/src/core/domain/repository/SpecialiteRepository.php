<?php

namespace iutnc\doctrine\core\domain\repository;

use Doctrine\ORM\EntityRepository;
use iutnc\doctrine\core\domain\repository\SpecialiteRepositoryInterface;

class SpecialiteRepository extends EntityRepository implements SpecialiteRepositoryInterface
{
    public function getSpecialtitesByKeyword(string $keyword): array
    {
        $dql = 'SELECT s FROM iutnc\doctrine\core\domain\entities\Specialite s 
                WHERE s.libelle LIKE :keyword 
                OR s.description LIKE :keyword';
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('keyword', '%' . $keyword . '%');
        return $query->getResult();
    }
}
