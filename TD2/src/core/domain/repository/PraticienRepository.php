<?php

use Doctrine\ORM\EntityRepository;
use iutnc\doctrine\core\domain\entities\Praticien;

class PraticienRepository extends EntityRepository
{

    public function savePraticien(Praticien $praticien): Praticien
    {
        $this->getEntityManager()->persist($praticien);
        $this->getEntityManager()->flush();
        return $praticien;
    }
}
