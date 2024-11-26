<?php

require_once realpath(__DIR__ . '/../vendor/autoload.php');

use iutnc\hellokant\connection\ConnectionFactory;
use iutnc\hellokant\entities\Article;
use iutnc\hellokant\entities\Categorie;

$conf = parse_ini_file(realpath(__DIR__ . '/../conf/db.conf.ini'));

ConnectionFactory::makeConnection($conf);

// Création d'un article
$article = new Article([
    'nom' => 'Titre de l\'article',
    'descr' => 'Contenu de l\'article',
    'tarif' => 40.12,
    'id_categ' => 2,
]);

// Modification d'un attribut
$article->nom = 'Nouveau titre';

// Affichage des attributs
echo $article->nom;  // Affiche 'Nouveau titre'
echo $article->descr; // Affiche 'Contenu de l\'article'

// Insertion dans la base de données et récupération de l'ID
// $articleId = $article->insert();
// echo "Article inséré avec l'ID: $articleId";

// Suppression de l'article
$article->delete();


// $liste = Article::all();
// foreach ($liste as $article)
//     print_r("(" . $article->id . " | " . $article->nom . " | " . $article->descr . " | " . $article->tarif . " | " . $article->id_categ . ")\n");


// $articles = Article::find(
//     [['tarif', '<=', 100]],
//     ['id', 'nom', 'tarif']
// );

// foreach ($articles as $article) {
//     echo $article->nom . " - " . $article->tarif . "\n";
// }

$articles = Article::find(
    [['id_categ', '=', 1]],
    ['id', 'nom', 'tarif', 'id_categ']
);

foreach ($articles as $article) {
    $categorie = $article->categorie();
    echo $article->nom . " - " . $article->tarif . " - " . $article->id_categ . " | " . $categorie->nom . "\n";
}


echo "__________________________________________________________________\n";

$categories = Categorie::find(
    [['id', '=', 1]], // Par exemple, chercher la catégorie avec l'ID 1
    ['id', 'nom']
);

foreach ($categories as $categorie) {
    // Affichage des informations de la catégorie
    echo "Catégorie: " . $categorie->nom . "\n";

    // Récupérer tous les articles associés à cette catégorie
    $articles = $categorie->articles();

    // Afficher les articles associés
    foreach ($articles as $article) {
        echo $article->nom . " - " . $article->tarif . " | " . $article->id_categ . "\n";
    }
}
