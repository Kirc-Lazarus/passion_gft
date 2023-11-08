<?php
class Str
{

    static function random($length)
    {
        // Je stock les caractères alphanumériques dans une variable
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        // Je demande de répéter mon alphabet * 60, je mélange mon résultat et je demande une taille de 60 caratères avec la fonction substr et le paramêtre $length
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }
}
