<?php
namespace iutnc\doctrine\core\domain\entities;

use iutnc\doctrine\core\domain\entities\Entity as Entite;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;

#[Entity]
#[Table(name: 'praticien')]
class Praticien extends Entite {

    #[Column(type: Types::STRING, length: 48)]
    private string $nom;

    #[Column(type: Types::STRING, length: 48)]
    private string $prenom;

    #[Column(type: Types::STRING, length: 48)]
    private string $ville;

    #[Column(type: Types::STRING, length: 128)]
    private string $email;

    #[Column(type: Types::STRING, length: 24)]
    private string $telephone;

    #[Column(type: Types::INTEGER)]
    private int $specialite_id;

    #[Column(type: Types::STRING)]
    private string $groupe_id;

    #[ManyToOne(targetEntity: Specialite::class)]
    #[JoinColumn(name: 'specialite_id', referencedColumnName: 'id')]
    private ?Specialite $specialite = null;

    #[ManyToOne(targetEntity: Groupement::class)]
    #[JoinColumn(name: 'groupe_id', referencedColumnName: 'id')]
    private ?Groupement $groupement = null;


    public function getNom(): string {
        return $this->nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function getVille(): string {
        return $this->ville;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getTelephone(): string {
        return $this->telephone;
    }

    public function getSpecialiteId(): int {
        return $this->specialite_id;
    }

    public function getSpecialite(): ?Specialite {
        return $this->specialite;
    }

    public function getGroupeId(): string {
        return $this->groupe_id;
    }

    public function getGroupement(): ?Groupement {
        return $this->groupement;
    }


}