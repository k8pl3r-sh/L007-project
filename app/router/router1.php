<!-- ----- debut Router1 -->
<?php
require('../controller/ControllerFamily.php');
require('../controller/ControllerEvent.php');

require('../controller/ControllerLink.php');

require('../controller/ControllerIndiv.php');
require_once '../controller/Controller.php';

//todo on pourrait refactor les formulaires + tout ce qui est insert: une lib qui génère en fct de ce qu'on veut
// ajouter une partie script additionnels

session_start();


// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);

// todo vérifier qu'une famille est sélectionnée pour les pages

$action = $param["action"];
unset($param["action"]);
$args = $param;
var_dump($action);

// --- Liste des méthodes autorisées
switch ($action) {
    case "accueil" :
        Controller::$action();
        break;
    case "listFamily" :
    case "familyCreate" :
    case "addFamily" :
    case "selectFamily" :
    case "familySelected":
        ControllerFamily::$action();
        break;
    case "listEvent" :
    case "eventCreate" :
        ControllerEvent::$action();
        break;

    case "listLink" :
    case "addParentLink" :
    case "addUnionLink" :
        ControllerLink::$action();
        break;

    case "listIndiv" :
    case "addIndiv" :
    case "selectIndiv":
        var_dump($args);
        ControllerIndiv::$action($args);
        //TODO
        break;

    default:
        //todo faire un 404
        $action = "accueil";
        Controller::$action();
        break;
}
?>
<!-- ----- Fin Router1 -->

