
# Partie n°1 Mongo Shell 

## Exercice 1: Lister tous les produits
db.produits.find().forEach(function (produit) {
    print("Numéro: " + produit.numero + " - Libellé: " + produit.libelle + " - Catégorie: " + produit.categorie);
});


## Exercice 2: Compter le nombre de produits dans la collection
var produitCount = db.produits.countDocuments();
print("Il y a " + produitCount + " produits.");


## Exercice 3: Lister les produits triés par numéro décroissant
db.produits.find().sort({ numero: -1 }).forEach(function (produit) {
    print("Numéro: " + produit.numero + " - Libellé: " + produit.libelle + " - Catégorie: " + produit.categorie);
});


## Exercice 4: Trouver le produit dont le libellé est "Margherita"
var produit = db.produits.findOne({ libelle: "Margherita" });
print("Numéro: " + produit.numero + " - Libellé: " + produit.libelle + " - Catégorie: " + produit.categorie);


## Exercice 5: Trouver les produits de la catégorie "Boissons"
db.produits.find({ categorie: "Boissons" }).forEach(function (produit) {
    print("Numéro: " + produit.numero + " - Libellé: " + produit.libelle + " - Catégorie: " + produit.categorie);
});


## Exercice 6: Afficher catégorie, numéro et libellé de tous les produits
db.produits.find({}, { categorie: 1, numero: 1, libelle: 1 }).forEach(function (produit) {
    print("Catégorie: " + produit.categorie + " - Numéro: " + produit.numero + " - Libellé: " + produit.libelle);
});


## Exercice 7: Afficher catégorie, numéro, libellé, taille et tarif de tous les produits
db.produits.find({}, { categorie: 1, numero: 1, libelle: 1, tarifs: 1 }).forEach(function (produit) {
    print("Catégorie: " + produit.categorie + " - Numéro: " + produit.numero + " - Libellé: " + produit.libelle);

    if (produit.tarifs && produit.tarifs.length > 0) {
        print("Tarifs disponibles:");
        produit.tarifs.forEach(function (tarif) {
            print("- Taille: " + tarif.taille + " | Tarif: " + tarif.tarif + " €");
        });
    } else {
        print("- Taille: Non applicable | Tarif: Non applicable");
    }
});


## Exercice 8: Trouver les produits avec un tarif inférieur à 8.0
db.produits.find({ "tarifs.tarif": { $lt: 8.0 } }).forEach(function (produit) {
    print("Numéro: " + produit.numero + " - Libellé: " + produit.libelle);

    produit.tarifs.forEach(function (tarif) {
        if (tarif.tarif < 8.0) {
            print("→ Taille: " + tarif.taille + " - Tarif: " + tarif.tarif);
        }
    });
});


## Exercice 9: Trouver les produits avec un tarif grande taille inférieur à 8.0
db.produits.find({}, { numero: 1, libelle: 1, tarifs: 1 }).forEach(function (produit) {
    if (Array.isArray(produit.tarifs)) {  // Ensure tarifs is an array
        produit.tarifs.forEach(function (tarif) {
            if (tarif.taille.toLowerCase() === "grande" && tarif.tarif < 8.0) {
                print("Numéro: " + produit.numero + " - Libellé: " + produit.libelle + " - Tarif Grande Taille: " + tarif.tarif + " €");
            }
        });
    }
});


## Exercice 10: Insérer un nouveau produit
db.produits.insertOne({
    numero: 101,
    libelle: "Pizza Végétarienne",
    categorie: "Pizza",
    tarifs: [
        { taille: "normale", tarif: 7.0 },
        { taille: "grande", tarif: 9.0 }
    ]
});
print("Nouveau produit inséré.");


## Exercice 11: Trouver un produit par numéro et afficher ses recettes
var produit = db.produits.findOne({ numero: 1 });
if (produit) {
    if (produit.recettes && Array.isArray(produit.recettes) && produit.recettes.length > 0) {
        produit.recettes.forEach(function (recetteId) {
            var recette = db.recettes.findOne({ _id: recetteId });
            if (recette) {
                print("Recette: " + recette.nom + " - Difficulté: " + recette.difficulte);
            } else {
                print("Erreur: Recette avec l'ID " + recetteId + " introuvable.");
            }
        });
    } else {
        print("Erreur: Le produit existe mais n'a pas de recettes associées.");
    }
} else {
    print("Erreur: Produit avec le numéro 1 introuvable.");
}
