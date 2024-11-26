<?php

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\DBAL\Types\Types;

class Groupement {
    private string $id;
    private string $nom;
    private int $type_id;
    private string $adresse;
    private string $ville;
}