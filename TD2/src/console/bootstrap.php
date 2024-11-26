<?php 

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once __DIR__ . '/../vendor/autoload.php';


$entity_path = [__DIR__ . '../core/domain/entities'];
$isDevMode = true;

$dbparams = parse_ini_file(__DIR__ . '/../conf/dbparams.ini');

$config = ORMSetup::createAttributeMetadataConfiguration($entity_path, $isDevMode);
$connection = DriverManager::getConnection($dbparams, $config);
$entityManager = new EntityManager($connection, $config);

return $entityManager;