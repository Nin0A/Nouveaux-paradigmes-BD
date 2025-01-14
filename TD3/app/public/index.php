<?php
/**
 * Created by PhpStorm.
 * User: canals5
 * Date: 28/10/2019
 * Time: 16:16
 */

use MongoDB\Client;

require_once __DIR__ . "/../src/vendor/autoload.php";

$c = new Client("mongodb://mongo");
$db = $c->chopizza;
$produits = $db->produits;
$recettes = $db->recettes;

########### Question 1 ############
echo "<h2>Question 1 : afficher la liste des produits: numero, categorie, libelle</h2>";
$listeproduits = $db->produits->find();
echo "<table border='1'>";
echo "<tr><th>Numéro</th><th>Catégorie</th><th>Libellé</th></tr>";

foreach ($listeproduits as $produit) {
    $numero = $produit['numero'];
    $categorie = $produit['categorie'];
    $libelle = $produit['libelle'];    
    echo "<tr>";
    echo "<td>" . $numero . "</td>";
    echo "<td>" . $categorie . "</td>";
    echo "<td>" . $libelle . "</td>";
    echo "</tr>";
}

echo "</table>";

########### Question 2 ############
echo "<h2>Question 2 : afficher le produit numéro 6, préciser : libellé, catégorie, description, tarifs</h2>";
$numerosix = $produits->findOne(['numero' => 6]);

if ($numerosix) {
    echo "<p><strong>Libellé :</strong> " . $numerosix['libelle'] . "</p>";
    echo "<p><strong>Catégorie :</strong> " . $numerosix['categorie'] . "</p>";
    echo "<p><strong>Description :</strong> " . $numerosix['description'] . "</p>";

    if (isset($numerosix['tarifs'])) {
        echo "<p><strong>Tarifs :</strong></p>";
        echo "<ul>";
        foreach ($numerosix['tarifs'] as $tarif) {
            echo "<li>Taille: " . $tarif['taille'] . " - Prix: " . $tarif['tarif'] . "€</li>";
        }
        echo "</ul>";
    } else {
        echo "<p><strong>Tarifs :</strong> Pas de données</p>";
    }
} else {
    echo "<p>Pas de produit numéro 6</p>";
}

########### Question 3 ############
echo "<h2>Question 3 : liste des produits dont le tarif en taille normale est <= 3.0</h2>";
$produitsTarif = $produits->find([
    'tarifs' => [
        '$elemMatch' => [
            'taille' => 'normale',
            'tarif' => ['$lte' => 3]
        ]
    ]
], [
    'projection' => [
        'numero' => 1,
        'libelle' => 1,
        'tarifs' => [
            '$elemMatch' => [
                'taille' => 'normale',
                'tarif' => ['$lte' => 3]
            ]
        ]
    ]
]);

echo "<table border='1'>";
echo "<tr><th>Numéro</th><th>Libellé</th><th>Tarif - Taille</th></tr>";

foreach ($produitsTarif as $produit) {
    echo "<tr>";
    echo "<td>" . $produit['numero'] . "</td>";
    echo "<td>" . $produit['libelle'] . "</td>";

    if (isset($produit['tarifs']) && count($produit['tarifs']) > 0) {
        foreach ($produit['tarifs'] as $tarif) {
            echo "<td>Taille: " . $tarif['taille'] . " - Prix: " . $tarif['tarif'] . "€</td>";
        }
    } else {
        echo "<td>Non disponible</td>";
    }    
    echo "</tr>";
}
echo "</table>";

########### Question 4 ############
echo "<h2>Question 4 : liste des produits associés à 4 recettes</h2>";
$recette4 = $recettes->find([], ['limit' => 4]);

foreach ($recette4 as $recette) {
    echo "<h3>Recette : " . $recette['nom'] . "</h3>";
    if (isset($recette['ingredients'])) {
        echo "<ul>";
        foreach ($recette['ingredients'] as $ingredient) {
            echo "<li>" . $ingredient . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Pas d'ingredients</p>";
    }
}

########### Question 5 ############
echo "<h2>Question 5 : afficher le produit n°6, compléter en listant les recettes associées (nom et difficulté)</h2>";
$produit6 = $produits->findOne(['numero' => 6]);

if ($produit6) {
    echo "<h2>Produit N°6</h2>";
    echo "<p><strong>Libellé :</strong> " . $produit6['libelle'] . "</p>";
    echo "<p><strong>Catégorie :</strong> " . $produit6['categorie'] . "</p>";
    echo "<p><strong>Description :</strong> " . $produit6['description'] . "</p>";

    $recettesAssociees = $recettes->find([
        'ingredients' => $produit6['libelle']
    ]);

    if ($recettesAssociees) {
        echo "<h3>Recettes associées au produit N°6</h3>";
        echo "<table border='1'>
                <tr>
                    <th>Nom de la Recette</th>
                    <th>Difficulté</th>
                </tr>";

        foreach ($recettesAssociees as $recette) {
            echo "<tr>
                    <td>" . $recette['nom'] . "</td>
                    <td>" . $recette['difficulte'] . "</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Aucune recette associée à ce produit.</p>";
    }
} else {
    echo "<p>Le produit N°6 n'a pas été trouvé.</p>";
}


function getProductDetails($numero, $taille) {
    global $produits;

    $produit = $produits->findOne(['numero' => $numero]);

    if (!$produit) {
        return null;
    }

    $tarif = null;
    if (isset($produit['tarifs'])) {
        foreach ($produit['tarifs'] as $t) {
            if ($t['taille'] == $taille) {
                $tarif = $t['tarif'];
                break;
            }
        }
    }

    if (!$tarif) {
        return null;
    }

    return [
        'numero' => $produit['numero'],
        'libelle' => $produit['libelle'],
        'categorie' => $produit['categorie'],
        'taille' => $taille,
        'tarif' => $tarif
    ];
}

$numero = 6;
$taille = 'grande';

$productDetails = getProductDetails($numero, $taille);

if ($productDetails) {
    echo json_encode($productDetails, JSON_PRETTY_PRINT);
} else {
    echo json_encode(['error' => 'Produit ou tarif non trouve'], JSON_PRETTY_PRINT);
}


