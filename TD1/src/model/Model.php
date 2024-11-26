<?php

namespace iutnc\hellokant\model;

use iutnc\hellokant\query\Query;
use iutnc\hellokant\connection\ConnectionFactory;

abstract class Model
{
    // Tableau des attributs de l'objet
    protected $attributes = [];

    // Nom de la table et de la clé primaire, à définir dans les classes enfants
    protected static $table;
    protected static $primaryKey;

    // Constructeur qui permet d'initialiser les attributs de l'objet
    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    // Méthode magique __get() pour accéder aux valeurs des attributs
    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }

    // Méthode magique __set() pour modifier les valeurs des attributs
    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    // Méthode pour supprimer l'objet de la base de données
    public function delete(): bool
    {
        // Vérifier que l'objet possède une valeur pour la clé primaire
        if (isset($this->attributes[self::$primaryKey])) {
            $primaryKeyValue = $this->attributes[self::$primaryKey];
            $query = new Query();
            $query->table(static::$table)
                ->where(static::$primaryKey, '=', $primaryKeyValue)
                ->delete();

            return true;
        }
        return false;
    }

    // Méthode pour insérer l'objet dans la base de données
    public function insert(): int
    {
        // Utilisation de la classe Query pour insérer les données
        $query = new Query();
        $query->table(static::$table)
            ->insert($this->attributes);

        // Récupération de l'ID de l'objet inséré
        $lastInsertId = ConnectionFactory::getConnection()->lastInsertId();

        // Stockage de l'ID généré dans l'objet
        $this->attributes[static::$primaryKey] = $lastInsertId;

        return $lastInsertId;
    }

    public static function all(): array
    {
        // Utilisation de la classe Query pour effectuer la requête SELECT * FROM <table>
        $query = Query::table(static::$table);

        // Récupérer les résultats avec Query
        $results = $query->get();

        // Transformer chaque ligne en un objet de modèle (par exemple, Article)
        $objects = [];
        foreach ($results as $row) {
            // Créer un objet du modèle correspondant avec les données récupérées
            $objects[] = new static($row);
        }

        return $objects;  // Retourner le tableau d'objets
    }

    public static function find(array $criteria, array $columns = ['*'], bool $single = false): mixed
    {
        // Initialiser la requête avec la table
        $query = Query::table(static::$table);

        // Appliquer les critères de recherche
        foreach ($criteria as $criterion) {
            if (count($criterion) === 3) {
                // $criterion est supposé être [colonne, opérateur, valeur]
                [$column, $operator, $value] = $criterion;
                $query->where($column, $operator, $value);
            }
        }

        // Spécifier les colonnes à récupérer
        $query->select($columns);

        // Exécuter la requête et récupérer les résultats
        $results = $query->get();

        // Si aucun résultat n'est trouvé et que le mode "single" est activé, retourner null
        if (empty($results)) {
            return $single ? null : [];
        }

        // Si nous voulons un seul objet (par exemple, chercher un article par son ID)
        if ($single) {
            return new static($results[0]);
        }

        // Retourner un tableau d'objets pour plusieurs résultats
        $objects = [];
        foreach ($results as $row) {
            $objects[] = new static($row);
        }

        return $objects;
    }

    public function belongs_to(string $relatedModel, string $foreignKey): ?object
    {
        // Récupérer la valeur de la clé étrangère dans l'objet courant
        $foreignKeyValue = $this->attributes[$foreignKey] ?? null;

        // Afficher la valeur de la clé étrangère pour débogage
        echo "Valeur de la clé étrangère: $foreignKeyValue\n"; // Ajouté pour le débogage

        // Si la clé étrangère n'est pas définie, retourner null
        if (!$foreignKeyValue) {
            return null;
        }

        // Obtenir le modèle lié
        $relatedClass = "iutnc\\hellokant\\entities\\$relatedModel"; // Assurez-vous que vous utilisez le bon namespace

        // Utiliser la méthode getPrimaryKey() pour récupérer la clé primaire du modèle lié
        $primaryKey = static::$primaryKey;

        // Retourner l'objet du modèle lié en recherchant selon la clé primaire
        $relatedObjects = $relatedClass::find([[$primaryKey, '=', $foreignKeyValue]]);
        return !empty($relatedObjects) ? $relatedObjects[0] : null;
    }


    public function has_many(string $relatedModel, string $foreignKey): array
    {
        // Obtenir la clé primaire de l'objet courant
        $primaryKeyValue = $this->attributes[static::$primaryKey] ?? null;

        // Si la clé primaire n'est pas définie, retourner un tableau vide
        if (!$primaryKeyValue) {
            return [];
        }

        // Obtenir le modèle lié
        $relatedClass = "iutnc\\hellokant\\entities\\$relatedModel";

        // Rechercher tous les objets dans le modèle lié qui possèdent cette clé étrangère

        return $relatedClass::find([[$foreignKey, '=', $primaryKeyValue]]);
    }
}
