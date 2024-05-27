# goura_magasin
## Système de Gestion de Stock & Ventes

### Ce Système a été developpé à la base de:
- Asynchronous Javascript et XML (Ajax) :
J'ai choisi d'utiliser Ajax pour pouvoir accélérer les réponses des pages Web en échangeant de petites quantités d'informations avec le serveur Web en coulisse. En outre, cela évite de devoir recharger l'ensemble de la page web chaque fois qu'une nouvelle information doit être consultée sur le serveur.

- JavaScript Object Notation (JSON) :
J'ai utilisé JSON pour effectuer des requêtes Ajax dans lesquelles j'ai effectué différentes interactions avec la base de données (dans mon cas MySQL), pour effectuer des opérations telles que l'interrogation, l'inclusion et la suppression dans la base de données.

- AlertifyJS :
Affiche un message dans le navigateur via une boîte de dialogue, qui n'est rien d'autre qu'une petite fenêtre popup. En plus du texte, un bouton de confirmation est également affiché pour indiquer que la personne a effectivement lu le message. Par conséquent, la fenêtre ne se fermera pas tant que le bouton de confirmation n'aura pas été cliqué.

- Select2 :
Select2 offre une boîte de sélection personnalisable qui prend en charge la recherche, le balisage, les ensembles de données distants, le défilement infini et de nombreuses autres options très utilisées.

- Bootstrap :
pour le style des pages (CSS).

- DomPDF :
D'une manière générale, le DOM PDF est une classe PHP capable de convertir un document HTML en un fichier PDF.

### Barre de navigation, nous avons :
- Page d'accueil
- Gestion des produits (catégories et produits)
- Gestion des utilisateurs
- Gestion des clients
- Vente

### Le système comporte différents accès et fonctionnalités:
![Alt_text](fonc.png)

### À propos de l'hébergement :
Notre site web est hébergé par la plateforme Heroku et après l'hébergement le script pour enregistrer le client, générer des tickets et des rapports PDF a cessé de fonctionner (je essaye de le résoudre, en recréant l'accès à distance par la plateforme et cela donne la même chose, mais dans le serveur local les scripts fonctionnent).

[Lien pour y'acceder](https://goura-magasin-9669892ff581.herokuapp.com)

## Points à amelliorer:
- Ne posséde pas de barre de recherche.
- Ne posséde pas de panier où l’utilisateur ajoute lui-même ses produits.
- En tant qu’Admin ou gestionnaire lorsqu’on ajoute un produit dans le panier il s’ajoute un par un même si c’est le même produit.
- Ne posséde pas d’une page spécial pour chaque produit
