<?php
namespace iutnc\doctrine\core\domain\repository;

use Doctrine\ORM\EntityRepository;

class PersonnelRepository extends EntityRepository implements PersonnelRepositoryInterface
{

    public function getPersonnelByVille(string $ville): array
    {
        $dql = "SELECT p FROM iutnc\doctrine\core\domain\\entities\Personnel p 
        JOIN p.groupement g WHERE g.ville = :ville"; 
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('ville', $ville);
        return $query->getResult();
    }
}