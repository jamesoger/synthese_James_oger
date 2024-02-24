# Devis du projet de synthèse : Les Sportifs

## Introduction
La _Fédération Mondiale de **[VOTRE SUJET]** professionnel_ a exprimé le désir de stimuler l'intérêt pour ses activités et d'accroître la participation à ses événements. À cet effet, elle ambitionne la création d'une application web novatrice permettant aux utilisateurs de localiser aisément les événements sportifs à proximité. Cette plateforme aura pour objectif de mettre en lumière ses équipes et joueurs étoiles en publiant diverses données statistiques, images captivantes et informations pertinentes liées à la ligue, aux équipes et aux joueurs.

## Sélection du Thème
- Choix parmi une liste de [thèmes sportifs](sports.md).
- Chaque thème sera unique.
- Choix des thèmes en classe dans un ordre aléatoire de priorité.

## Infrastructure de la Base de Données
- Utilisation de _SQLite_ ou _MySQL_, selon votre préférence.
- Structuration en un minimum de trois tables distinctes.
- Validation préalable du schéma par le professeur.
- Génération de données fictives par _IA_ ou aléatoirement pour noms d'équipes, joueurs, statistiques, etc.

## Développement de l'API
- Implémentation de l'API avec des technologies telles que _ArrestDB_, _Laravel_, ou autres selon recommandation.
- Adoption d'une approche _Restful_ pour assurer une communication fluide entre l'application et le serveur.

## Conception Visuelle et Interface

### L'interface en général

Vous avez une carte blanche totale quant à l'interface et à la maquette de votre application.

Vous pouvez utiliser la technologie de votre choix pour aider au développement **VISUEL** de votre application (Bootstrap, Tailwind CSS., SCSS, etc.)

> ### Points à surveiller
> L'interface (maquette) de votre application devrait contenir les éléments suivants pour garantir une expérience utilisateur attrayante et conviviale :
> 
> **En-tête élégant** :
> Mettez en place un en-tête captivant qui comprend le logo de la Fédération Mondiale de votre sujet sportif ainsi qu'un slogan évocateur. Cela aidera à renforcer l'identité visuelle de l'application et à attirer l'attention des utilisateurs dès leur arrivée sur le site.
>
> **Barre de navigation** :
> Une barre de navigation en haut de chaque page permettra aux utilisateurs de naviguer facilement entre les différentes sections de l'application, notamment la page d'accueil, les événements, les équipes et les joueurs. Assurez-vous que cette barre reste accessible même lorsque l'utilisateur fait défiler la page.
> 
> **Carrousel d'images** :
> Intégrez un carrousel d'images en haut de la page d'accueil pour captiver l'attention des utilisateurs dès leur arrivée sur le site. Ce carrousel pourrait mettre en avant des moments emblématiques, des équipes vedettes, ou encore des événements à venir. Vous ne devez pas le programmer mais intégrer un carrousel existant : [Vous pouvez choisir parmi ceux-ci.](https://madewithvuejs.com/carousels) ou faire vos propres recherches
>
> **Sections de présentation** :
> Chaque section de la page d'accueil consacrée à la présentation devrait être bien définie visuellement et contenir des éléments visuels attrayants, tels que des images de joueurs en action, des logos d'équipes et des graphiques de performances. Ces éléments visuels aideront à renforcer l'identification des utilisateurs avec la ligue et ses protagonistes.
> 
> **Affichage des résultats** :
> Chaque fois que des résultats sont affichés (événements, équipes, joueurs), optez pour une disposition propre et ordonnée. Utilisez des cartes ou des listes pour présenter les informations de manière systématique, en incluant des images, des titres et des résumés. Assurez-vous que les utilisateurs puissent accéder rapidement aux détails complets en cliquant sur chaque élément.
> 
> **Pied de page informatif** :
> Créez un pied de page contenant des liens importants tels que les mentions légales, la politique de confidentialité, les coordonnées de la Fédération, ainsi que des liens vers les réseaux sociaux pour encourager la connectivité.
> 
> **Couleurs et schéma visuel** :
> Sélectionnez un schéma de couleurs attrayant et cohérent qui reflète l'esprit sportif et dynamique de l'application. Veillez à ce que les couleurs choisies soient agréables à l'œil et qu'elles offrent un bon contraste pour une lisibilité optimale.
> 
> **Typographie lisible** :
> Optez pour une typographie claire et lisible pour le contenu texte de l'application. Assurez-vous que la police choisie soit à la fois élégante et facile à lire sur différents dispositifs.
> 
> En élaborant une interface qui intègre ces éléments, vous créerez une maquette convaincante pour votre application web. L'objectif est de captiver les utilisateurs dès leur première interaction tout en leur fournissant une navigation intuitive pour découvrir les informations sur les équipes, les joueurs et les événements de la Fédération Mondiale de votre sujet sportif.

### Page d'accueil
La page d'accueil, première impression du site pour les utilisateurs, se compose d'un menu de navigation, d'un carrousel d'images captivantes, d'une section de présentation globale de la ligue, ainsi que d'espaces réservés à la mise en avant des équipes et des joueurs vedettes.

### Page des événements
La page dédiée aux événements offre aux utilisateurs la possibilité de repérer aisément les événements sportifs passés et à venir. Elle met à disposition un menu de navigation, et une section d'affichage des résultats pertinents.

### Page des équipes
La page des équipes permet aux utilisateurs d'explorer en détail les informations relatives aux différentes équipes de la ligue. Elle propose un menu de navigation, et une section réservée à l'affichage des résultats correspondants. Cette page affiche la totalité des équipes mais pas toutes les informations par rapport à chaque équipe.

#### Page d'une équipe
Cette page affiche toutes les informations par rapport à une équipe. Elle affiche les __joueurs__ de l'équipe, les statistiques de l'équipe, les événements de l'équipe, etc.

### Page des joueurs
La page des joueurs offre une plongée approfondie dans le profil des joueurs de la ligue. Elle intègre un menu de navigation, et une section consacrée à l'affichage des résultats pertinents. Théoriquement, cette page affiche la totalité des joueurs mais comme il n'y a pas de système de recherche, on peut omettre cette page et considérer que cette tâche est remplie par la page d'équipe.

#### Page d'un joueur
Cette page affiche toutes les informations par rapport à un joueur. Elle affiche les statistiques du joueur, les événements du joueur, etc.

#### Ajout d'un joueur
Cette page permet d'ajouter un joueur à une équipe. Elle permet de choisir l'équipe, le nom, le prénom, la date de naissance, la taille, le poids, le numéro de maillot, la position, le pays, la photo, etc.

#### Modification d'un joueur
Cette page permet de modifier un joueur. Elle permet de modifier le nom, le prénom, la date de naissance, la taille, le poids, le numéro de maillot, la position, le pays, la photo, etc.

#### Suppression d'un joueur
On doit pouvoir supprimer un joueur. Ça n'a pas besoin d'être une page, ça peut être un bouton sur la page d'un joueur.

## Fonctionnalités clés
- Possibilité d'importer des images (équipes et joueurs), avec une API fournie par le professeur.
- Intégration d'images générées par _IA_ (ou autre) pour éviter toute problématique de droits d'auteur.
- Capacité de modifier le contenu. Cette fonctionnalité ne doit s'appliquer qu'aux joueurs pour ce projet.

Ce devis étoffé reflète la vision globale du projet de synthèse pour la création d'une plateforme dynamique de promotion et de recherche d'événements sportifs. L'objectif est de fournir aux utilisateurs une interface conviviale et intuitive pour explorer le monde passionnant du sport tout en mettant en avant les équipes et joueurs de la Fédération Mondiale.

## Exigeances par rapport à VueJS
- Utilisation de VueJS pour la création de l'interface utilisateur.
- Normalisation de l'application avec les standards de développement VueJS.

## Remise
- À remettre au plus tard le mercredi 6 septembre à midi.
- Ne pas oublier se supprimer le dossier `node_modules` avant de remettre le projet.
- Ne pas oublier d'exporter la base de données dans un fichier `sql` avant de remettre le projet. Inclure le fichier `sql` à la racine du projet.
- Renommer le dossier du projet pour être attribuable à vous __AVANT__ de le zipper pour la remise.   