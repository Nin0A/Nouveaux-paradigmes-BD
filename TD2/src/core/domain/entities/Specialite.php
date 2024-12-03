<?php
namespace iutnc\doctrine\core\domain\entities;

use iutnc\doctrine\core\domain\entities\Entity as Entite;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\DBAL\Types\Types;

#[Entity]
#[Table(name: 'specialite')]
class Specialite extends Entite {

    #[Column(type: Types::STRING, length: 48)]
    private string $libelle;

    #[Column(type: Types::TEXT)]
    private string $description;


    public function getLibelle(): string {
        return $this->libelle;
    }

    public function getDescription(): string {
        return $this->description;
    }

}