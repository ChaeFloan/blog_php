# Blog en PHP/MySQL

## Objectifs

Créer un blog et son interface d'administration à l'aide du langage PHP et de la base de données MySQL.

## Fonctionnalités

* Liste des articles avec pagination (10-15 articles par page, affichage du titre et d'une partie du contenu)
* Affichage du détail de l'article (titre, tout le contenu, lien vers l'article suivant ou précédent)
* Création de commentaires sur la page détail de l'article
* Affichage de la liste des commentaires sur la page détail de l'article
* Inscription utilisateur
* Connexion utilisateur
* Modification des informations utilisateur (mot de passe, avatar)
* Créer, modifier, supprimer des catégories (Backoffice)
* Créer, modifier, supprimer des articles (BackOffice)

En bonus :
* Gestion des droits utilisateur
* Plusieurs catégories par article (par défaut : 1 catégorie maximum par article)

## Instructions

### Mise en place de la base de données

* users 			(id, username, email, password, creation_date, avatar = null)
* categories 		(id, name)
* posts				(id, title, content, creation_date, user_id, category_id)
* comments 			(id, username, content, creation_date, post_id)

### FrontOffice (site publique)

#### Liste des articles

Page qui affiche la liste des articles (titre, contenu partiel, catégorie, nom de l'auteur, date de création). Les articles sont affichés dans l'ordre antéchronologique (du plus récent au plus ancien), sous forme de liste. Le titre est cliquable et permet d'envoyer vers le détail de l'article. On n'affichera que 10 à 15 articles par page et on affichera le nombre de pages au-dessus de la liste.

#### Détail de l'article

Page qui affiche toutes les informations de l'article (titre, contenu, catégorie, auteur, date de création) ainsi que tous les commentaires. Au-dessus de tous les commentaires, un formulaire permettra de rajouter un nouveau commentaire.

#### Enregistrement du commentaire

Lorsque le formulaire d'ajout de commentaire est soumis, le commentaire est enregistré dans la table et on est redirigé vers la page de détail de l'article sur lequel a été ajouté le commentaire.

#### Inscription

Page qui permet à l'utilisateur de s'inscrire à l'aide d'un formulaire (username, email, password).

#### Connexion

Page qui permet à l'utilisateur de se connecter à l'aide d'un formulaire (username, password).

#### Modification du profil

Page qui permet à l'utilisateur connecté (donc accessible uniquement quand vous êtes connecté) de modifier son email, mot de passe et de rajouter une image de profil.


### BackOffice (interface d'administration)

Code à mettre dans un dossier admin. Pour accéder à l'interface d'administration, il faut être connecté. Si l'utilisateur n'est pas connecté, il sera redirigé vers la page de connexion.

#### Liste des articles

Page qui affiche la liste des articles (titre, date de création, utilisateur qui a créé l'article, catégorie) sous forme de tableau avec un lien pour modifier ou supprimer l'article.

#### Modification de l'article

Formulaire qui affiche l'article à modifier. Les champs du formulaire sont pré-remplis par rapport au données de l'article.

#### Suppression de l'article

Le lien sur la page "Liste des articles" permet de supprimer l'article et d'être redirigé vers la page "Liste des articles".

#### Création de l'article

Ajouter un lien sur la page "Liste des articles" qui amène sur une page avec un formulaire de création d'article. Le champ pour les catégories est une liste déroulante avec toutes les catégories de la base de données. Le champ correspondant à l'auteur (user_id) ne se trouve pas dans le formulaire, il est mis à jour automatiquement à partir du numéro de l'utilisateur connecté (se trouvant dans la session).

#### Liste des catégories

Page qui affiche la liste des catégories (nom) sous forme de tableau avec un lien pour modifier ou supprimer la catégorie.

#### Modification de la catégorie

Formulaire qui affiche la catégorie à modifier. Les champs du formulaire sont pré-remplis par rapport avec le nom de la catégorie.

#### Suppression de la catégorie

Le lien sur la page "Liste des catégories" permet de supprimer la catégorie et d'être redirigé vers la page "Liste des catégories".

#### Création de la catégorie

Ajouter un lien sur la page "Liste des catégories" qui amène sur une page avec un formulaire de création de catégorie.