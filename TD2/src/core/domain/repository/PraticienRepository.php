<?php

namespace iutnc\doctrine\core\domain\repository;


use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Func;
use iutnc\doctrine\core\domain\entities\Praticien;
use Symfony\Component\Console\Input\ArrayInput;

class PraticienRepository extends EntityRepository
{

    public function praticienBySpecialite($specialite)
    {
        $dql = "SELECT p.nom, p.prenom, p.ville, p.email, p.telephone, g.nom AS groupement_nom
            FROM iutnc\doctrine\core\domain\entities\Praticien p
            LEFT JOIN p.specialite s
            LEFT JOIN p.groupement g
            WHERE s.id = :specialiteId";

        // Exécution de la requête
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('specialiteId', $specialite);

        // Retour des résultats
        return $query->getResult();
    }
}
