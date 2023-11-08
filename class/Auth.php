<?php
class Auth
{
    private $session;

    public function __construct($session)
    {
        $this->session = $session;
    }

    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function register($db, $pseudo, $password, $email)
    {
        // Je hash le mot de passe de mon utilisateur avec la méthode BCRYPT et le contient dans une variable
        $password = $this->hashPassword($password);
        // A l'aide d'une fonction préparé, je fabrique un token de 60 caractères qui me permettra de valider mon compte utilisateur
        $token = Str::random(60);

        // Je stock la requête dans une variable appelée req
        $db->query("INSERT INTO utilisateurs SET pseudo = ?, password = ?, email =?, token = ?", [$pseudo, $password, $email, $token]);
        // La requête permet de préparer les informations qui seront envoyé à la base de données en respectant
        // les nomination de chaque ligne de table (Dans ma table utilisateur dans la colonne pseudo, password email et token)

        // Je fabrique une variable qui contiendra l'id du dernier utilisateur inscrit
        $user_id = $db->lastInsertId(); // Renvoi le dernier id généré par pdo
        // J'utilise l'email du membre qui s'inscrit pour lui envoyer la clé token qui permettra de valider le compte.
        // Dans le mail je met un lien url menant vers la page compte perso contenant la clé primaire de l'utilisateur et le token correspondant à son id (user)
        mail($email, 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien \n\nhttp://passion_gft2.0.test/inc/confirm.php?id=$user_id&token=$token");
    }

    public function confirm($db, $user_id, $token)
    {

        // Je selectionne l'ensemble des éléments de mon utilisateur lié à l'id passé en paramètre (ce qui me permettra entre autre de stocker toute ces données dans une variable $user)
        $user = $db->query('SELECT * FROM utilisateurs WHERE user = ?', [$user_id])->fetch(); //Je stock la requête dans une variable


        // Si mon utilisateur et le token de l'utilisateur correspondent aux paramètres de l'url, alors :
        if ($user && $user->token == $token) {

            // Je prépare ma requête pour modifier ma table utilisateur en effaçant le token de validation en mettant la date et l'heure de validation
            // J'exécute via l'id de mon utilisateur
            $db->query('UPDATE utilisateurs SET token = NULL, confirm_at = NOW() WHERE user = ?', [$user_id]);

            // Je stock mon utilisateur dans l'index 'auth' (authentification) via la super variable $_SESSION
            $this->session->write('auth', $user);
            return true;
        }
        return false;
    }

    public function restrict()
    {

        // Si aucune connection détecté, 
        if (!$this->session->read('auth')) {
            // Message erreur
            $this->session->setFlash('danger', "Vous ne pouvez pas visionner cette page, veuillez vous connecter !");
            // Redirection
            header('Location: ../inc/login.php');
            exit(); // J'empêche la suite de l'exécution du script
        }
    }

    public function user()
    {
        if (!$this->session->read('auth')) {
            return false;
        }
        return $this->session->read('auth');
    }

    public function connect($user)
    {
        $this->session->write('auth', $user);
    }

    public function reconnectCokkies($db)
    {

        // Est-ce que j'ai un cookie 'remember' et un utilisateur connecté
        if (isset($_COOKIE['remember']) && !$this->user()) {

            // Je mets mon cookie dans une variable
            $remember_token = $_COOKIE['remember'];
            // Dans une variable je l'explose par "==" via ma variable 'remember_token'
            $parts = explode('==', $remember_token);
            // Je récupères l'id de mon utilisateur qui sera la première partie
            $user_id = $parts[0];
            // je selectionne tout dans utilisateurs où l'id correspond à l'utilisateur
            $user = $db->query('SELECT * FROM utilisateurs WHERE user = ?', [$user_id])->fetch();
            // Si j'ai une information
            if ($user) {
                // Je vérifie que le token correspond je met dans une variable
                $expected = $user_id . '==' . $user->remember_token . sha1($user_id . 'member');
                // Si la variable est égale au remember_token
                if ($expected == $remember_token) {

                    // Je connecte l'utilisateur automatiquement
                    $this->connect($user);

                    // Et j'actualise la période de mon cookie
                    setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);
                    // Si les clés ne correspondent pas
                } else {
                    // Je détruit le cookie
                    setcookie('remember', NULL, -1);
                }
                // Si l'utilisateur ne correspond pas
            } else {
                // Je détruis le cookie
                setcookie('remember', NULL, -1);
            }
        }
    }

    public function login($db, $pseudo, $password, $remember = false)
    {
        // Si des données sont postées et si les champs pseudo et password contiennent des informations

        // on prepare la requête
        // Sélectionne tous depuis utilisateurs où colonne pseudo est égale au paramètre username ainsi qu'à l'email et que le confirm_at contient bien une date de validation
        $user = $db->query('SELECT * FROM utilisateurs WHERE (pseudo = :pseudo OR email = :pseudo) AND confirm_at IS NOT NULL', ['pseudo' => $pseudo])->fetch();

        // On vérifie le password avec en premier paramètre le mot de passe entré par l'utilisateur et en deuxième le type de hashage pour vérifier la correspondance 
        if ($user !== false && password_verify($password, $user->password)) { // Fonction avec booleen
            // Si c'est true,
            $this->connect($user); // On connecte l'utilisateur

            // MODIFICATION MDP
            // Si 'remember' est coché
            if ($remember) {
                $this->remember($db, $user->user);
            }
            return $user;
        } else { // Sinon

            return false;
        }
    }

    public function remember($db, $user_id)
    {

        // Je fabrique un token de 250 caractères
        $remember_token = Str::random(250);
        // Je l'intègre à ma base de données
        $db->query('UPDATE utilisateurs SET remember_token = ? WHERE user = ?', [$remember_token, $user_id]);
        // Je sauvegarde dans un cookie l'id et le remember_token et je fais un hashage de l'id et je rajoute une clé choisi arbitrairement pour éviter qu'une personne puisse la deviner et la regénérer puis je fais en sorte que mon cookie reste valable 7 jours
        setcookie('remember', $user_id . '==' . $remember_token . sha1($user_id . 'member'), time() + 60 * 60 * 24 * 7);
        // Je détruirais ma clé lorsque l'utilisateur se déconnectera
    }

    public function logout()
    {
        setcookie('remember', Null, -1);
        $this->session->delete('auth');
    }

    public function resetPass($db, $email)
    {

        // Requête préparé en selectionnant l'email et vérifiant que le compte est validé via la date
        $user = $db->query('SELECT * FROM utilisateurs WHERE email = ? AND confirm_at IS NOT NULL', [$email])->fetch();

        // Si l'utilisateur correspond
        if ($user) {
            // Je démarres une session
            session_start();
            // Je prépares un token dans une variable reset (nouveau)
            $reset_token = Str::random(60); // Généré avec ma fonction str_random
            // Je prépare ma requête pour intégrer mon reset_token et indiquer la date dans reset_at puis j'exécute avec paramètre reset_token et user correspondant à l'id (clé primaire)
            $db->query('UPDATE utilisateurs SET reset_token = ?, reset_at = NOW() WHERE user = ?', [$reset_token, $user->user]);
            // Envoi de l'email d'instruction
            mail($_POST['email'], 'Réinitialisation de votre compte', "Afin de réinitialiser votre compte merci de cliquer sur ce lien \n\nhttp://passion_gft2.0.test/inc/reset.php?id={$user->user}&token=$reset_token");
            return $user;
        } else {
            return false;
        }
    }

    public function resetToken($db, $user_id, $token)
    {

        //  Je selectionne l'ensemble du tableau utilisateurs où l'id et le reset_token correspondent, je rajoute une condition (is not null) pour renforcer la sécurité et la date du reset doit être supérieur à la date du jour 
        return $db->query('SELECT * FROM utilisateurs WHERE user = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)', [$user_id, $token])->fetch();
    }
}
