<?php
class Database
{
    private $pdo;

    public function __construct($login, $pass, $serveur, $dbname)
    {
        try {
            // Je définis des variable que j'utiliserais pour les valeurs necessaires à la connexion dans ma base de données
            $serveur = "localhost";
            $dbname = "passion";
            $login = "root";
            $pass = "";

            //On se connecte à la BDD
            $this->pdo = new PDO("mysql:host=$serveur;dbname=$dbname", $login, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Constante qui permet de renvoyer les exeptions d'erreurs
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            //Permet de récupérer les informations sous formes d'objets (compte utilisateur)
        } catch (PDOException $e) {
            exit('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * @param $query
     * @param bool|array $params
     * @return PDOStatement
     */

    public function query($query, $params = false)
    {
        if ($params) {
            $req = $this->pdo->prepare($query);
            $req->execute($params);
        } else {
            $req = $this->pdo->query($query);
        }

        return $req;
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}
