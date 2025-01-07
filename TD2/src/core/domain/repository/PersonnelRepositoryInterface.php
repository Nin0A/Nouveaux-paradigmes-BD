<?php
namespace iutnc\doctrine\core\domain\repository;

interface PersonnelRepositoryInterface 
{
    public function getPersonnelByVille(string $ville): array;
}