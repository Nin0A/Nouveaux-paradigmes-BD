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
}
