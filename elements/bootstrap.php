<?php
spl_autoload_register('app_autoload');

function app_autoload($class)
{
    // Le chemin relatif doit être correctement configuré ici
    $classFile = __DIR__ . '/../class/' . $class . '.php';

    if (file_exists($classFile)) {
        require $classFile;
    }
}
