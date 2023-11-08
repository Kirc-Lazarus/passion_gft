<?php
require '../elements/bootstrap.php';
App::getAuth()->logout();
Session::getInstance()->setFlash('success', "Vous êtes déconnecté !");

App::redirect('login.php'); // On redirige
