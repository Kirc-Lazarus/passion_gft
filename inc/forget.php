<?php
require '../elements/bootstrap.php';
// Si des données ont été postées et que l'email n'est pas vide
if (!empty($_POST) && !empty($_POST['email'])) {

    $db = App::getDatabase();
    $auth = App::getAuth();
    $session = Session::getInstance();
    if ($auth->resetPass($db, $_POST['email'])) {
        $session->setFlash('success', "Les instructions vous ont été envoyées par email.");
        App::redirect('login.php');
    } else {
        $session->setFlash('danger', "Aucun compte ne correspond à cette adresse !");
    }
}

require_once("../elements/header_ins_co.php");
?>
<div class="cadre opacity">
    <!-- Début du conteneur avec la classe CSS "cadre opacity" -->
    <div class="contener-form bg-img">
        <!-- Un sous-conteneur avec la classe CSS "contener-form" -->
        <form class="form-detail" action="" method="post">
            <!-- Début d'un formulaire avec la classe CSS "form-detail", action vide (à spécifier) et méthode POST -->
            <h2>Mot de passe oublié</h2>
            <!-- Un titre "Mot de passe oublié" de niveau 2 -->
            <div class="form-row">
                <!-- Début d'une ligne de formulaire -->
                <label for="full-name">Email</label>
                <!-- Une étiquette (label) pour le champ de saisie -->
                <input type="email" name="email" class="input-text mb-2" placeholder="Entrez votre email" required>
                <!-- Champ de saisie de type "email" avec un nom "email", des classes CSS et un texte de placeholder -->
            </div>
            <!-- Fin de la ligne de formulaire -->
            <div class="form-row-last">
                <!-- Début d'une autre ligne de formulaire -->
                <input type="submit" name="register" class="register" value="Envoyer">
                <!-- Bouton de soumission du formulaire avec un nom "register", une classe CSS et une valeur "Envoyer" -->
            </div>
            <!-- Fin de la ligne de formulaire -->
        </form>
        <!-- Fin du formulaire -->
    </div>
    <!-- Fin du sous-conteneur "contener-form" -->
</div>
<!-- Fin du conteneur principal "cadre opacity" -->

<?php
require_once("../elements/footer.php");
?>