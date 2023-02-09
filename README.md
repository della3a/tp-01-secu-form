### Manel Kheffache 
## My Secured Identification Form
- Ce code est un formulaire d'identification sécurisé développé en PHP et HTML. Il se connecte à une base de données (my-secured-database.sql) qui contient les informations des utilisateurs enregistrés. Le formulaire comporte les champs de saisie pour le nom d'utilisateur et le mot de passe, ainsi que les boutons pour se connecter, ajouter un compte et réinitialiser le formulaire.

#### Prérequis
- XAMPP et phpMyAdmin installés sur votre ordinateur.

#### Utilisation
- Clonez le repertoire tp-01-secu-form
- Importez le fichier my-secured-database.sql à l'aide de phpMyAdmin pour créer la base de données et la table d'utilisateurs.
- Placez le repertoire tp-01-secu-form (avec tous les fichiers .php, .css et le dossier assets) dans le répertoire de votre serveur XAMPP.

- Accédez au formulaire en ouvrant le fichier dans un navigateur en saisissant l'URL suivante : http://localhost/tp-01-secu-form/my-secured-form.php

#### Fonctionnalités techniques
- Connexion à la base de données : le formulaire se connecte à la base de données en utilisant les informations de connexion définies (nom d'utilisateur, mot de passe, etc.).

- Ajout d'un compte : vous pouvez ajouter un nouveau compte en saisissant un nom d'utilisateur et un mot de passe, puis en cliquant sur le bouton Add Account. Les informations sont ensuite enregistrées dans la base de données.

- Verrouillage de la page : si un utilisateur saisit trois fois de suite un nom d'utilisateur et un mot de passe incorrects, le formulaire est verrouillé pendant 15 secondes.

- Hachage des mots de passe : les mots de passe saisis sont hachés et enregistrés de manière sécurisée dans la base de données.

#### Demo
![alt text](https://github.com/della3a/tp-01-secu-form/blob/main/assets/images/Screenshot%202023-02-09%20at%204.27.15%20PM.png)
