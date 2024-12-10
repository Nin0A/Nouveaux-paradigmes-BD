<?php
namespace iutnc\doctrine\core\domain\repository;

interface SpecialiteRepositoryInterface
{
    public function getSpecialtitesByKeyword(string $keyword): array;
}