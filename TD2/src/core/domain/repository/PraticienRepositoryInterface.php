<?php
namespace iutnc\doctrine\core\domain\repository;

interface PraticienRepositoryInterface
{
    public function getPraticienBySpecialite($specialite): array;
    public function getPraticienBySpeAndCity($specialite, $city): array;
}