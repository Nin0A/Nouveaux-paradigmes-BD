<?php

namespace iutnc\hellokant\entities;

use iutnc\hellokant\model\Model;

class Categorie extends Model
{
    // Définir le nom de la table et la clé primaire pour la classe Categorie
    protected static $table = 'categorie';
    protected static $primaryKey = 'id';

    public function articles(): array
    {
        return $this->has_many('Article', 'id_categ');
    }
}
