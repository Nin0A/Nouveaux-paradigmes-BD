<?php
namespace iutnc\doctrine\core\domain\entities;

use iutnc\doctrine\core\domain\entities\Entity as Entite;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\DBAL\Types\Types;

#[Entity]
#[Table(name: 'groupement')]
class Groupement extends Entite {

    #[Column(type: Types::STRING, length: 48)]
    private string $nom;

    #[Column(type: Types::INTEGER)]
    private int $type_id;

    #[Column(type: Types::TEXT)]
    private string $adresse;

    #[Column(type: Types::STRING, length: 128)]
    private string $ville;

    public function getNom(): string {
        return $this->nom;
    }

    public function getTypeId(): int {
        return $this->type_id;
    }

    public function getAdresse(): string {
        return $this->adresse;
    }

    public function getVille(): string {
        return $this->ville;
    }
}