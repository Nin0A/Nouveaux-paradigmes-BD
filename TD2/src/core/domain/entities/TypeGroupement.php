<?php
namespace iutnc\doctrine\core\domain\entities;

use iutnc\doctrine\core\domain\entities\Entity as Entite;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\DBAL\Types\Types;

#[Entity]
#[Table(name: 'type_groupement')]
class TypeGroupement extends Entite {


    #[Column(name: "type_libelle", type: Types::STRING, length: 48)]
    private string $libelle;

    #[Column(name: "type_description", type: Types::TEXT)]
    private string $description;


    public function getLibelle(): string {
        return $this->libelle;
    }

    public function getDescription(): string {
        return $this->description;
    }

}