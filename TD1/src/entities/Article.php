<?php

namespace iutnc\hellokant\entities;

use iutnc\hellokant\model\Model;

class Article extends Model
{
    // Définir le nom de la table et la clé primaire pour la classe Article
    protected static $table = 'article';
    protected static $primaryKey = 'id';

    public function categorie(): ?Categorie
    {
        return $this->belongs_to('Categorie', 'id_categ');
    }
}
