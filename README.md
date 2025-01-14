# Nouveaux-paradigmes-BD

### 🚀 Pour récupérer le projet

`git clone git@github.com:Nin0A/Nouveaux-paradigmes-BD.git`

## TD1 - Programmer un Micro-ORM
### ▶️ Pour lancer le projet

A la racine : `docker compose up --build -d`

docker exec -it td3_mongo_1 bash

mongoimport --db chopizza --collection produits --jsonArray < pizzashop.produits.json
mongoimport --db chopizza --collection recettes --jsonArray < pizzashop.recettes.json


