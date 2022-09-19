# ECF---GymPec

Etape 1 : 
Télécharger les fichiers en lien.
Une fois que vous avez télécharger tous les dossiers vous allez commencer par créer une base de données pour faire migrer tous les fichiers de migration liée au projet pour cela créer tout d’abord votre base de données que vous souhaitez reliée à l’application.
Pour commencer vous allez dans le fichier « .ENV » ligne 31 et remplacer « Gympec » par le nom de votre base de données, ensuite vous allez créer votre BDD avec cette commande : symfony console doctrine:database:create

Une fois terminé vous pouvez ouvrir votre console et écrire la phrase suivante : symfony console make :migration
Vous avez juste à suivre les instructions écrite dans votre terminal, pour finir vous devez écrire : Symfony console doctrine :migrations :migrate et voila votre BDD ainsi que toute les tables la composant a été créer.

Etape 2 :
Maintenant que tout est en place vous pouvez commencer a visité notre application et créer votre premier user qui fera office d’administrateur.
Allez dans la page d’inscription et écrivez les informations demandées, une fois cela effectuer vous pouvez vous connectez à votre BDD, allez dans votre table « user » sélectionner la case « roles » de votre user fraichement enregistrer, vous aurez indiqué « [] » modifier le par ["ROLE_ADMIN"].
Voila votre utilisateur a maintenant le rôle administrateur et sera libre de pouvoir accéder a tout l’application sans problèmes 

Etape 2.5 : 
Il y’a un système qui permet dans le cas d’une création d’un partenaire ou d’une structure d’envoyer un mail a ce dernier, je me suis servi de Mailtrap.io pour l’envoie de mail. 
Si vous souhaitez garder ce dernier je vous conseille de créer un compte sur Mailtrap.io, une fois cela effectuer vous pouvez enregistrer le MAILER DSL sur Mailtrap.io qui se trouve dans : 
« inboxes > My inbox » dans la case « Intégrations » choisissez Symfony et vous aurez accès a votre MAILER_DSN, enregistrer le et copier le dans votre ficher « .env » ligne 43.
Vous aurez déjà le code écrit pour l’envoie de mail, il sera situé dans « PartenaireController.php » et « StructureController.php » vous pouvez ajouter votre email d’envoie dans ->from(‘ ‘).

Etape 3 : 
Vous avez maintenant accès au panel d’administration où vous avez la possibilité de voir tout les utilisateurs inscrit ainsi que les partenaires, structures mais aussi les produits que vous pourrez ajouter à notre application qui s’afficheront dans la partie « nos clubs » de l’application.

Pour commencer vous allez créer un partenaire et une structure via la partie /account du site, vous irai dans « CREATION D’UN PARTENAIRE » et entrerez les informations nécessaires ainsi que le nom de votre structure qui commencera par « Gympec- »
Une fois cela effectuer veuillez créer une structure dans /account « CREATION D’UNE STRUCTURE » remplissez les informations nécessaires et vous aurez normalement la possibilité de choisir directement un partenaire attitré, exemple : « Gympec-Paris » elle sera reliée à ce dernier.
Vous pouvez maintenant retourner dans votre section /admin pour vérifier si le partenaire ainsi que la structures a bien été créer et vérifier sur l’application sur la page /nos-clubs si votre structure a bien été ajouter, n’oubliez pas d’ajouter une image a votre structure pour embellir le tout, vous pouvez ajouter l’image dans votre partie /admin -> Structure -> Modifier. 
Vous pouvez également vérifier juste Mailtrap.io si votre mail a bien été envoyé.

Etape 4 : 
Nous allons voir maintenant la partie « produit » de notre application, pour ajouter un produit a notre boutique, vous allez devoir tout d’abord créer une catégorie est ensuite l’assigné a notre produit pour cela, allez dans votre /admin et Catégorie ensuite cliquer sur « Add category », remplissez le formulaire.
Une fois la catégorie créer, vous allez pouvoir ajouter vos produits que vous souhaitez mettre en vente 
Vous pouvez répéter l’opération pour chaque catégorie de produit que vous souhaitez mettre en vente sur notre application.
