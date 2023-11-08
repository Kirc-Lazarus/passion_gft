<?php
spl_autoload_register('app_autoload');

function app_autoload($class)
{
    // Le chemin relatif doit être correctement configuré ici
    $classFile = __DIR__ . '/../class/' . $class . '.php';
    $phpMailerFile = __DIR__ . '/../vendor/' . $class . '.php'; // Remplacez 'path_to_phpmailer' par le chemin réel vers PHPMailer

    if (file_exists($classFile)) {
        require $classFile;
    } elseif (file_exists($phpMailerFile)) {
        require $phpMailerFile;
    }
}
?>
