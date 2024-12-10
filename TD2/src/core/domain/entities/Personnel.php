<?php
namespace iutnc\doctrine\core\domain\entities;

use iutnc\doctrine\core\domain\entities\Entity as Entite;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;    
use iutnc\doctrine\core\domain\entities\Groupement;
use iutnc\doctrine\core\domain\repository\PersonnelRepository;

#[Entity(repositoryClass: PersonnelRepository::class)]
#[Table(name: 'personnel')]
class Personnel extends Entite {

    #[Column(type: Types::STRING, length: 48)]
    private string $nom;

    #[Column(type: Types::STRING, length: 48)]
    private string $prenom;

    #[Column(type: Types::STRING, length: 128)]
    private string $mail;

    #[Column(type: Types::STRING, length: 24)]
    private string $telephone;

    #[ManyToOne(targetEntity: Groupement::class)]
    #[JoinColumn(name: 'groupe_id', referencedColumnName: 'id')]
    private ?Groupement $groupement = null;

    public function getNom(): string {
        return $this->nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function getMail(): string {
        return $this->mail;
    }

    public function getTelephone(): string {
        return $this->telephone;
    }

    public function getGroupement(): ?Groupement {
        return $this->groupement;
    }

}