<?php
require_once '../elements/functions.php';
reconnect_cokkie();
// Si utilisateur connecté
if (isset($_SESSION['auth'])) {
    header('Location: account.php'); // Rediriction vers la page de compte
    exit();
}
// Si des données sont postées et si les champs pseudo et password contiennent des informations
if (!empty($_POST) && !empty($_POST['pseudo']) && !empty($_POST['password'])) {
    // Alors on appel une connexion à la base de données
    require_once '../elements/db.php';

    // on prepare la requête
    // Sélectionne tous depuis utilisateurs où colonne pseudo est égale au paramètre username ainsi qu'à l'email et que le confirm_at contient bien une date de validation
    $req = $pdo->prepare('SELECT * FROM utilisateurs WHERE (pseudo = :pseudo OR email = :pseudo) AND confirm_at IS NOT NULL');
    // On exécute et passe en clé le nom de l'utilisateur
    $req->execute(['pseudo' => $_POST['pseudo']]);
    // ET on récupère l'utilisateur
    $user = $req->fetch();

    // On vérifie le password avec en premier paramètre le mot de passe entré par l'utilisateur et en deuxième le type de hashage pour vérifier la correspondance 
    if ($user !== false && password_verify($_POST['password'], $user->password)) { // Fonction avec booleen
        // Si c'est true,
        $_SESSION['auth'] = $user; // On connecte l'utilisateur
        $_SESSION['flash']['success'] = 'Vous êtes bien connecté'; // On indique une connexion réussie

        // MODIFICATION MDP
        // Si 'remember' est coché
        if ($_POST['remember']) {
            // Je fabrique un token de 250 caractères
            $remember_token = str_random(250);
            // Je l'intègre à ma base de données
            $pdo->prepare('UPDATE utilisateurs SET remember_token = ? WHERE user = ?')->execute([$remember_token, $user->user]);
            // Je sauvegarde dans un cookie l'id et le remember_token et je fais un hashage de l'id et je rajoute une clé choisi arbitrairement pour éviter qu'une personne puisse la deviner et la regénérer puis je fais en sorte que mon cookie reste valable 7 jours
            setcookie('remember', $user->user . '==' . $remember_token . sha1($user->user . 'member'), time() + 60 * 60 * 24 * 7);
            // Je détruirais ma clé lorsque l'utilisateur se déconnectera
        }
        header('Location: account.php'); // On redirige vers sa page profil
        exit();
    } else { // Sinon
        // On affiche une erreur à l'utilisateur
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect';
        // Pour éviter d'informer un utilisateur mal veillant, je n'indique pas que l'erreur concerne seulement le mot de passe 
    }
}

require_once("../elements/header_ins_co.php");
?>
<div class="cadre opacity">
    <div class="contener-form bg-img">
        <!-- Début du formulaire -->
        <form class="form-detail" action="" method="post">
            <h2>S'identifier</h2> <!-- Titre du formulaire -->

            <!-- Champ pour le pseudo ou l'e-mail -->
            <div class="form-row">
                <label>Pseudo ou email</label> <!-- Étiquette du champ -->
                <input type="text" name="pseudo" id="pseudo" class="input-text" placeholder="Votre pseudo ou email" pattern="^(?![_-])(?!.*[_-]{2,})([A-Za-z0-9_-]{3,}|[A-Za-z0-9._%+-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,4})$(?<![_-])$" required>
                <!-- Champ de saisie de texte avec des attributs tels que le nom, l'ID, la classe, le placeholder (texte de l'exemple) et une expression régulière (pattern) pour la validation -->
            </div>

            <!-- Champ pour le mot de passe avec un lien "Mot de passe oublié" -->
            <div class="form-row">
                <label>Mot de passe <a href="forget.php">(Mot de passe oublié)</a></label>
                <!-- Étiquette du champ avec un lien pour réinitialiser le mot de passe -->
                <input type="password" name="password" id="password" class="input-text" placeholder="Votre mot de passe" pattern="^(?=.*[A-Z])(?=.*\d).{8,}$" required>
                <!-- Champ de saisie de mot de passe avec des attributs similaires au champ précédent -->
            </div>

            <!-- Case à cocher pour "Se souvenir de moi" -->
            <div class="form-row">
                <label>
                    <input type="checkbox" name="remember" value="1"> Se souvenir de moi <!-- name='remember' Pour récupérer l'info avec $_POST -->
                    <!-- Case à cocher avec le texte "Se souvenir de moi" -->
                </label>
            </div>

            <!-- Bouton de soumission et lien vers la page d'inscription -->
            <div class="form-row-last">
                <input type="submit" name="register" class="register" value="Se connecter">
                <!-- Bouton pour soumettre le formulaire -->
                <button class="btn btn-secondary"><a class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="register.php">Inscription</a></button>
                <!-- Bouton de lien vers la page d'inscription -->
            </div>
        </form>
        <!-- Fin du formulaire -->
    </div>
</div>

<?php
require_once("../elements/footer.php");
?>