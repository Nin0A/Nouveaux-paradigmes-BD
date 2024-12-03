<?php
namespace iutnc\doctrine\core\domain\entities;

use Doctrine\ORM\Mapping\MappedSuperclass;
use Doctrine\ORM\Mapping\Column;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Id;

#[MappedSuperclass]
class Entity {

    #[Id]
    #[Column(type: Types::STRING)]
    private string $id;

    public function getId(): string {
        return $this->id;
    }
}
