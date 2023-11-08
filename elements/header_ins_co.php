<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Déclaration de l'encodage des caractères -->
    <meta charset="UTF-8" />
    <!-- Définition de la compatibilité du navigateur -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Configuration de la vue sur les appareils -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Titre de la page -->
    <title>Ma passion</title>
    <!-- Lien vers la feuille de styles Bootstrap (caroussel) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <!-- Inclusion du fichier JavaScript Bootstrap (caroussel) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <!-- Lien vers le fichier CSS personnalisé -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/inscription.css" />
</head>

<body>
    <!-- Début header (logo, titre, navbar) -->
    <header>
        <!-- logo -->
        <div class="en-tête">
            <!-- La classe "en-tête" est utilisée pour regrouper des éléments dans un en-tête. -->
            <div class="logo">
                <!-- Un élément <div> avec la classe "logo" pour contenir le logo. -->
                <a href="../index.php">
                    <!-- Un lien (balise <a>) qui renvoie vers la page d'accueil (index.html). -->
                    <img class="logo" src="../img/logo.png" alt="logo" />
                    <!-- Une image (balise <img>) avec la classe "logo" et "img-fluid" pour rendre l'image responsive.
            L'image est chargée depuis le fichier "logo.png" dans le dossier "src/img" et a un texte alternatif "logo" pour l'accessibilité. -->
                </a>
            </div>
            <div class="titre">
                <!-- Un élément <div> avec la classe "titre" pour contenir le titre. -->
                <h1>La passion du cinéma</h1>
                <!-- Un titre de niveau 1 (balise <h1>) avec le texte "La passion du cinéma". -->
            </div>
            <div class="d-flex flex-row-reverse align-items-center">
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a class="inscription" href="../inc/logout.php">Se deconnecter</a>
                    <a class="link-light" href="../inc/account.php">
                        <h4>Mon profil</h4>
                    </a>
                <?php else : ?>
                    <a class="link-light" href="../inc/register.php">
                        <h4>S'inscrire</h4>
                        <a class="inscription" href="../inc/login.php">Connexion</a>
                    <?php endif; ?>

            </div>

        </div>
        <!-- navbar -->
        <div>
            <!-- Un élément <div> pour regrouper le contenu de la barre de navigation. -->
            <nav class="barre-navigation-barre">
                <!-- Un élément <nav> avec la classe "barre-navigation-barre" pour la barre de navigation. -->
                <ul class="barre-navigation">
                    <!-- Une liste non ordonnée (balise <ul>) avec la classe "barre-navigation" pour les éléments de la barre de navigation. -->
                    <li class="nav-objet">
                        <!-- Un élément de liste (balise <li>) avec la classe "nav-objet". -->
                        <a class="nav-lien" href="../inc/acteurs.php">Acteurs</a>
                        <!-- Un lien (balise <a>) avec la classe "nav-lien" qui renvoie vers la page "acteurs.html". -->
                    </li>
                    <li class="nav-objet">
                        <a class="nav-lien" href="../inc/biographies.php">Biographies</a>
                    </li>
                    <li class="nav-objet">
                        <a class="nav-lien" href="../inc/realisateurs.php">Realisateurs</a>
                    </li>
                    <?php if (isset($_SESSION['auth'])) : ?>
                        <li class="nav-objet">
                            <a class="nav-lien" href="../inc/selection.php">Selection</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <div class="text-center">
                <!-- Est-ce que la clé flash contient un élément -->
                <?php if (Session::getInstance()->hasFlashes()) : ?>
                    <!-- Si oui, je parcour  mon élément, je récupère en clé le $type et en valeur, le $message -->
                    <?php foreach (Session::getInstance()->getFlashes() as $type => $message) : ?>
                        <!-- Pour chacun de ses élément je fais une div qui contiendra le message et son type de couleur -->
                        <div class="alert alert-<?= $type; ?>">
                            <?= $message; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <!-- Si je rencontre une erreur, j'indique à l'utilisateur à quoi correspond cette erreur -->
                <?php if (!empty($errors)) : ?>
                    <div class="alert alert-danger">
                        <p>Vous n'avez pas correctement rempli le formulaire !</p>
                        <ul>
                            <!-- Pour afficher l'erreur précise, je boucle sur errors -->
                            <!-- Je rentre en paramêtre la clé liée aux erreurs et
                             la valeur qui affichera l'erreur en question  -->
                            <?php foreach ($errors as $error) : ?>
                                <!-- J'affiche mes erreurs dans une liste -->
                                <li><?= $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <?php if (isset($_SESSION['auth'])) : ?>
                <h4 class="text-light">MON PROFIL<br>Bonjour <?= $_SESSION['auth']->pseudo; ?></h4>
            <?php endif; ?>
        </div>
    </header>
    <!-- Fin header (logo, titre, navbar) -->
    <main class="d-flex justify-content-center">