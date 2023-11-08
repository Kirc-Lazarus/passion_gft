<?php
require_once '../elements/bootstrap.php';
$auth = App::getAuth()->restrict();

// Est-ce que des données sont postées
if (!empty($_POST)) {
    // Si 
    if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
        // Message d'erreurs
        $_SESSION['flash']['danger'] = "Les mots de passe ne correspondent pas";
    } else { // Si tout va bien
        // J'intègre l'id de mon utilisateur dans une varible
        $user_id = $_SESSION['auth']->user;
        // Je crypte mon moyt de passe et le contiens dans une variable
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        // Je me connecte à la BDD
        require_once '../elements/db.php';
        // Je prépare une requête pour modifier le MDP dans ma BDD et l'éxecute avec la méthode BCRYPT
        $pdo->prepare('UPDATE utilisateurs SET password = ?')->execute([$password]);
        // Message succés
        $_SESSION['flash']['success'] = "Votre mots de passe a été mis à jour";
    }
}

require_once '../elements/header_ins_co.php';
?>

<div>
    <div class="card table table-striped">
        <!-- Ceci est un conteneur de carte avec des styles CSS -->
        <h1 class="d-flex flex-wrap justify-content-center">Profil</h1>
        <!-- Un titre "Profil" centré horizontalement -->
        <h3 class="m-2">Pseudo : <?= $_SESSION['auth']->pseudo; ?></h3>
        <!-- Affiche le pseudo de l'utilisateur en utilisant la variable de session 'auth' -->
        <h3 class="m-2">Email : <?= $_SESSION['auth']->email; ?></h3>
        <!-- Affiche l'e-mail de l'utilisateur en utilisant la variable de session 'auth' -->
        <a class="d-flex flex-wrap justify-content-center" href="../inc/delete.php">
            <h5>Suppression de compte</h5>
        </a>
    </div>

    <div class="cadre opacity">
        <!-- Ceci est un autre conteneur avec une classe CSS 'cadre' et une opacité -->
        <div class="contener-form bg-img">
            <!-- Ceci est un conteneur pour un formulaire -->
            <?php if (!empty($errors)) : ?>
                <!-- Cette condition vérifie si la variable $errors n'est pas vide, ce qui signifie qu'il y a des erreurs à afficher. -->
                <div class="alert alert-danger">
                    <!-- Ceci est une boîte d'alerte avec un style CSS pour indiquer une erreur. -->
                    <p>Vous n'avez pas correctement rempli le formulaire !</p>
                    <!-- Un message d'erreur générique -->
                    <ul>
                        <!-- Ceci est une liste à puces pour afficher des erreurs spécifiques -->
                        <?php foreach ($errors as $error) : ?>
                            <!-- Cette boucle parcourt le tableau $errors pour afficher chaque erreur -->
                            <li><?= $error; ?></li>
                            <!-- Chaque erreur est affichée comme un élément de liste -->
                        <?php endforeach; ?>
                        <!-- Fin de la boucle foreach -->
                    </ul>
                    <!-- Fin de la liste à puces -->
                </div>
                <!-- Fin de la boîte d'alerte d'erreur -->
            <?php endif; ?>
            <!-- Fin de la condition pour afficher les erreurs -->

            <form class="form-detail" action="" method="POST">
                <!-- Début du formulaire -->

                <h2>Modifier votre Profil</h2>
                <!-- Titre du formulaire -->

                <!-- Champ pour le mot de passe -->
                <div class="form-row">
                    <label for="password">Mot de passe</label>
                    <!-- Étiquette du champ avec un attribut "for" lié à l'ID du champ -->
                    <input type="password" name="password" id="password" class="input-text" placeholder="Votre mot de passe" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" required>
                    <!-- Champ de saisie de mot de passe avec des attributs tels que le nom, l'ID, la classe, le placeholder (texte de l'exemple), une expression régulière (pattern) pour la validation, et l'attribut "required" pour le rendre obligatoire -->
                    <small>Le mot de passe doit contenir au moins 8 caractères, incluant au moins une lettre majuscule et un chiffre.</small>
                    <!-- Un petit texte d'information sous le champ de mot de passe -->
                </div>

                <!-- Champ pour la confirmation du mot de passe -->
                <div class="form-row">
                    <label for="password_confirm">Confirmez le mot de passe</label>
                    <!-- Étiquette du champ avec un attribut "for" lié à l'ID du champ -->
                    <input type="password" name="password_confirm" id="password_confirm" class="input-text" placeholder="Votre mot de passe" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" required>
                    <!-- Champ de saisie de confirmation de mot de passe avec des attributs similaires au champ précédent -->
                </div>

                <!-- Bouton de soumission pour la modification -->
                <div class="form-row-last">
                    <input type="submit" name="register" class="register" value="Modifier">
                    <!-- Bouton pour soumettre le formulaire de modification -->
                </div>
            </form>
            <!-- Fin du formulaire -->
        </div>
    </div>
</div>

<?php require_once '../elements/footer.php'; ?>