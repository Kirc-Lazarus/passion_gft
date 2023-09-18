<!-- J'inclus ma page de fonctions, pour que les fonctions que j'appels fonctionne -->
<?php require_once '../elements/functions.php';

session_start(); // Permet d'accéder à la super variable $_SESSION qui est concervé à travers toute les pages (transmettre et utiliser des informations de session)

// je vérifie si ma variable post n'est pas vide vide
if (!empty($_POST)) {

    // Variable qui contient un tableau vide, si le tableau erreur reste vide c'est qu'il n'a pas rencontré d'erreurs
    // Cela me permettra de le remplir des erreus rencontrés pour les rapporter à l'utilisateur
    $errors = [];

    require_once '../elements/db.php'; //J'appel la connexion à la base de données

    // Si l'une des deux conditions n'est pas valide alors j'indique un message d'erreur.
    // Pseudo absent ou ne respectant pas l'expression régulière
    if (empty($_POST['pseudo']) || !preg_match('/^(?![_ -])(?!.*[_ -]{2,})[A-Za-z0-9_ -]{3,}(?<![_ -])$/', $_POST['pseudo'])) {
        //Expression régulière acceptant seulement les majuscules, minuscules et chiffres

        $errors['pseudo'] = "Votre pseudo n'est pas valide (alphanumérique) !";
    } else {
        // Je vérifie si le pseudo existe
        // Dans ma table utilisateur je selectionne l'id où le pseudo de l'utilisateur est égale à celui rentré par le nouveau membre
        $req = $pdo->prepare('SELECT user FROM utilisateurs WHERE pseudo = ?');
        // j'éxecute la requête avec comme paramêtre le pseudo
        $req->execute([$_POST['pseudo']]);
        // Je récupère l'utilisateur ayant le même pseudo si il existe
        $user = $req->fetch();

        // Si il existe, alors j'indique à l'utilisateur qu'il ne peut pas prendre ce pseudo
        if ($user) {
            $errors['pseudo'] = "Ce pseudo est déjà pris !";
        }
    }

    // Si je champ de l'email est vide ou si il ne respecte pas le format d'email alors erreur
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Votre email n'est pas valide!";
    } else {
        // Je vérifie aussi l'email du membre qui souhaite s'inscrire 
        // la fonction ou méthode fetch (permet de récupérer un enregistrement existant)
        $req = $pdo->prepare('SELECT user FROM utilisateurs WHERE email = ?');
        $req->execute([$_POST['email']]);
        $user = $req->fetch();

        if ($user) {
            $errors['email'] = "Cet email est déjà utilisé pour un autre compte !";
        }
    }

    // Champ vide ou mauvaise correspondance, message erreur
    if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
        $errors['password'] = "Mot de passe invalide !";
    }

    // Si il n'y a aucune erreur alors :
    if (empty($errors)) {

        // Je stock la requête dans une variable appelée req
        $req = $pdo->prepare("INSERT INTO utilisateurs SET pseudo = ?, password = ?, email =?, token = ?");
        // La requête permet de préparer les informations qui seront envoyé à la base de données en respectant
        // les nomination de chaque ligne de table (Dans ma table utilisateur dans la colonne pseudo, password email et token)

        // Je hash le mot de passe de mon utilisateur avec la méthode BCRYPT et le contient dans une variable
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        // A l'aide d'une fonction préparé, je fabrique un token de 60 caractères qui me permettra de valider mon compte utilisateur
        $token = str_random(60);

        // J'exécute la requête pour sauvegarder les données dans ma table
        $req->execute([$_POST['pseudo'], $password, $_POST['email'], $token]);
        // Je fabrique une variable qui contiendra l'id du dernier utilisateur inscrit
        $user_id = $pdo->lastInsertId(); // Renvoi le dernier id généré par pdo
        // J'utilise l'email du membre qui s'inscrit pour lui envoyer la clé token qui permettra de valider le compte.
        // Dans le mail je met un lien url menant vers la page compte perso contenant la clé primaire de l'utilisateur et le token correspondant à son id (user)
        mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien \n\nhttp://passion_gft2.0.test/inc/confirm.php?id=$user_id&token=$token");
        // Je stock un message de succés dans ma variable à l'index 'flash'
        $_SESSION['flash']['success'] = "Un email de confirmation vous a été envoyé, veuillez consulter votre boîte mail !";

        // Puis je redirige mon membre vers la page de connexion
        header('Location: login.php');
        // J'indique que le script s'arrête à cet endroit
        exit();
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