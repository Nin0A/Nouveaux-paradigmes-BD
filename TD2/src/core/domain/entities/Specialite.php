<?php

namespace iutnc\doctrine\core\domain\entities;

use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\OneToMany;
use iutnc\doctrine\core\domain\repository\SpecialiteRepository;

#[Entity(repositoryClass: SpecialiteRepository::class)]
#[Table(name: 'specialite')]
class Specialite
{

    #[Id]
    #[Column(type: Types::INTEGER)]
    #[GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[Column(type: Types::STRING, length: 48)]
    private string $libelle;

    #[Column(type: Types::TEXT)]
    private string $description;

    #[OneToMany(targetEntity: Praticien::class, mappedBy: "specialite")]
    private Collection $praticiens;

    public function getId(): int
    {
        return $this->id;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPraticiens(): Collection
    {
        return $this->praticiens;
    }
}
