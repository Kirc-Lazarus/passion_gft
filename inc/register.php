<?php
require_once '../elements/bootstrap.php';
Session::getInstance();



// je vérifie si ma variable post n'est pas vide vide
if (!empty($_POST)) {

    // Variable qui contient un tableau vide, si le tableau erreur reste vide c'est qu'il n'a pas rencontré d'erreurs
    // Cela me permettra de le remplir des erreus rencontrés pour les rapporter à l'utilisateur
    $errors = [];
    $db = App::getDatabase();
    $validator = new Validator($_POST);
    $validator->isCharacters('pseudo', "Votre pseudo n'est pas valide (alphanumérique) !");
    if ($validator->isValid()) {

        $validator->isUniq('pseudo', $db, 'utilisateurs', "Ce pseudo est déjà pris !");
    }
    $validator->isEmail('email', "Votre email n'est pas valide!");
    if ($validator->isValid()) {

        $validator->isUniq('email', $db, 'utilisateurs', "Cet email est déjà utilisé pour un autre compte !");
    }
    $validator->isPassword('password', "Mot de passe invalide !");

    // Si il n'y a aucune erreur alors :
    if ($validator->isValid()) {

        App::getAuth()->register($db, $_POST['pseudo'], $_POST['password'], $_POST['email']);
        Session::getInstance()->setFlash('success', "Un email de confirmation vous a été envoyé, veuillez consulter votre boîte mail !");

        // Puis je redirige mon membre vers la page de connexion
        App::redirect('login.php');
        // J'indique que le script s'arrête à cet endroit
        exit();
    } else {
        $errors = $validator->getErrors();
    }
}
?>
<!-- J'inclus le header qui apparaîtra en haut de ma page. -->
<?php require_once '../elements/header_ins_co.php'; ?>
<!-- J'englobe mon formulaire dans une balise div, qui contiendra une classe qui me permettra de mettre en arrière plan un fond noir,
 avec une légère opacitée pour une meilleur visualisation de mon texte et de mon image en background. -->
<div class="cadre opacity">

    <div class="contener-form bg-img">

        <!-- Mon formulaire avec une action vide pour qu'il me redirige vers la page courante et une méthode POST pour envoyer les données en post
    et n'apparaissent pas dans l'url. -->
        <form class="form-detail" action="" method="POST">

            <h2>Formulaire d'inscription</h2>

            <!-- Mon formulaire contient : -->
            <!-- Champ de saisi pour le pseudo -->
            <div class="form-row">
                <label for="pseudo">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" class="input-text" placeholder="Votre pseudonyme" pattern="^(?![_ -])(?!.*[_ -]{2,})[A-Za-z0-9_ -]{3,}(?<![_ -])$" autocomplete="pseudo" required>
                <small>Le pseudo ne peut contenir que des minuscules, des majuscules, des chiffres et les symboles underscore (_) et le trait d'union (-).</small>
            </div>
            <!-- Champ de saisi pour l'adresse Mail -->
            <div class="form-row">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="input-text" placeholder="Votre Email" pattern="^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$" autocomplete="email" required>
            </div>
            <!-- Champ de saisi pour le mot de passe -->
            <div class="form-row">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="input-text" placeholder="Votre mot de passe" pattern="^(?=.*[A-Z])(?=.*\d).{8,}$" required>
                <small>Le mot de passe doit contenir au moins 8 caractères, incluant au moins une lettre majuscule et un chiffre.</small>
            </div>
            <!-- Confirmation du mot de passe -->
            <div class="form-row">
                <label for="password_confirm">Confirmez le mot de passe</label>
                <input type="password" name="password_confirm" id="password_confirm" class="input-text" placeholder="Confirmez votre mot de passe" pattern="^(?=.*[A-Z])(?=.*\d).{8,}$" required>
            </div>
            <!-- Bouton pour soumettre les informations -->
            <div class="form-row-last">
                <input type="submit" name="register" class="register" value="M'inscrire">
                <button class="btn btn-secondary"><a class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="login.php">S'identifier</a></button>
            </div>

        </form>

    </div>

</div>

<?php require_once '../elements/footer.php'; ?>