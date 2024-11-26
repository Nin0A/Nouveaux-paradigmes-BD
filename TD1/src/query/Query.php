<?php

namespace iutnc\hellokant\query;

use iutnc\hellokant\connection\ConnectionFactory;

class Query
{
    protected $sqltable;
    private $fields = '*';
    private $where = null;
    private $args = [];
    private $sql = '';

    public static function table(string $table): Query
    {
        $query = new Query();
        $query->sqltable = $table;
        return $query;
    }

    public function where(string $col, string $op, mixed $val): Query
    {
        if (!is_null($this->where)) {
            $this->where .= ' and ';
        }
        $this->where .= $col . ' ' . $op . ' ?';
        $this->args[] = $val;
        return $this;
    }

    public function select(array $fields): Query
    {
        $this->fields = implode(', ', $fields);
        return $this;
    }

    public function get(): array
    {
        $this->sql = 'select ' . $this->fields . ' from ' . $this->sqltable;
        if (!is_null($this->where)) {
            $this->sql .= ' where ' . $this->where;
        }

        // Obtention de la connexion PDO
        $pdo = ConnectionFactory::getConnection();

        // Préparation de la requête
        $stmt = $pdo->prepare($this->sql);

        // Exécution de la requête avec les arguments
        $stmt->execute($this->args);

        // Récupération et retour des résultats sous forme de tableau associatif
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function delete(): void
    {
        $this->sql = 'delete from ' . $this->sqltable;
        if (!is_null($this->where)) {
            $this->sql .= ' where ' . $this->where;
        }

        // Obtention de la connexion PDO
        $pdo = ConnectionFactory::getConnection();

        // Préparation de la requête
        $stmt = $pdo->prepare($this->sql);

        // Exécution de la requête avec les arguments
        $stmt->execute($this->args);
    }

    public function insert(array $values): int
    {
        // Construction de la requête d'insertion
        $this->sql = 'insert into ' . $this->sqltable . ' (' . implode(', ', array_keys($values)) . ') values (' . implode(', ', array_fill(0, count($values), '?')) . ')';
        $this->args = array_values($values);

        // Obtention de la connexion PDO
        $pdo = ConnectionFactory::getConnection();

        // Préparation de la requête
        $stmt = $pdo->prepare($this->sql);

        // Exécution de la requête avec les arguments
        $stmt->execute($this->args);

        // Retour de l'ID de la ligne insérée
        return $pdo->lastInsertId();
    }
}
