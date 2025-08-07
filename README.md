Touche pas au Klaxon - Application de Covoiturage d'Entreprise

Touche pas au Klaxon est une application web interne conçue pour faciliter le covoiturage entre les employés d'une entreprise possédant plusieurs sites géographiques. L'objectif est d'optimiser les trajets inter-sites en permettant aux employés de partager leurs véhicules, réduisant ainsi les coûts et l'empreinte carbone.
🚀 Fonctionnalités
Pour tous les visiteurs :

    Consulter la liste des trajets à venir disposant de places libres.

Pour les employés connectés :

    Consulter les détails d'un trajet (personne à contacter, nombre de places totales).

    Proposer un nouveau trajet.

    Modifier et supprimer les trajets dont ils sont les auteurs.

Pour l'administrateur :

    Accéder à un tableau de bord complet.

    Gérer la liste des agences (villes) : créer, modifier, supprimer.

    Consulter la liste de tous les utilisateurs.

    Consulter et supprimer n'importe quel trajet de l'application.

🛠️ Stack Technique

    Langage : PHP 8.x

    Base de données : MySQL ou MariaDB

    Serveur Web : Apache (via XAMPP)

    Architecture : MVC (Modèle-Vue-Contrôleur)

    Frontend : Bootstrap 5, Sass

    Gestion des dépendances : Composer

⚙️ Installation

Suivez ces étapes pour installer et lancer le projet sur votre machine locale.
Prérequis

    Un environnement de développement local comme XAMPP ou WampServer. Ce guide utilise XAMPP.

    Composer installé globalement.

    Git.

1. Cloner le Dépôt

Ouvrez un terminal et placez-vous dans le dossier htdocs de votre installation XAMPP (généralement C:\xampp\htdocs). Clonez ensuite le dépôt :

git clone [URL_DE_VOTRE_DEPOT_GITHUB] touche-pas-au-klaxon
cd touche-pas-au-klaxon

2. Installer les Dépendances

Lancez Composer pour installer les dépendances du projet :

composer install

3. Configurer l'Environnement

    À la racine du projet, créez un fichier nommé .env.

    Copiez le contenu suivant dans votre nouveau fichier .env et adaptez les valeurs si nécessaire (pour XAMPP par défaut, ces valeurs sont correctes) :

    # .env
    DB_HOST="localhost"
    DB_NAME="tpak_covoiturage"
    DB_USER="root"
    DB_PASS=""

4. Créer la Base de Données

    Démarrez les services Apache et MySQL depuis le panneau de contrôle XAMPP.

    Ouvrez votre navigateur et allez sur http://localhost/phpmyadmin.

    Créez une nouvelle base de données nommée tpak_covoiturage avec l'interclassement utf8mb4_general_ci.

    Sélectionnez la base de données que vous venez de créer, allez dans l'onglet "Importer".

    Importez et exécutez le fichier database/schema.sql pour créer les tables.

    Importez et exécutez le fichier database/seed.sql pour remplir les tables avec des données de test.

5. Lancer l'Application

L'application est maintenant prête ! Ouvrez votre navigateur et accédez à l'URL suivante :
http://localhost/touche-pas-au-klaxon/public/
👨‍💻 Utilisation

L'application est accessible à tous les visiteurs. Pour accéder aux fonctionnalités avancées, une connexion est nécessaire.
Identifiants de Connexion

Voici les comptes que vous pouvez utiliser pour tester l'application.
Compte Utilisateur Standard

    Email : jean.dupont@klaxon.com

    Mot de passe : password

Compte Administrateur

    Email : admin@klaxon.com

    Mot de passe : password