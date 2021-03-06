<!-- ----- debut config -->
<?php

require_once 'DatabaseConnector.php';

// Utile pour le débugage car c'est un interrupteur pour les echos et print_r.
if (!defined('DEBUG')) {
    define('DEBUG', FALSE);
}

// Configuration de la base de données
// todo ancienne manière de gérer la bd
$dsn = 'mysql:dbname=lo07;host=localhost;charset=utf8';
$username = 'root';
$password = 'root';


// nouvelle manière
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "lo07";


// chemin absolu vers le répertoire du projet SUR DEV-ISI 
$root = dirname(dirname(__DIR__)) . "/";


if (DEBUG) {
    echo("<ul>");
    echo(" <li>dsn = $dsn</li>");
    echo(" <li>username = $username</li>");
    echo(" <li>password = $password</li>");
    echo("<li>---</li>");
    echo(" <li>root = $root</li>");

    echo("</ul>");
}
?>

<!-- ----- fin config -->



