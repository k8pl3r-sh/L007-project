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
if (isset($param["action"])) {
    $action = htmlspecialchars($param["action"]);
    $action = $param["action"];
    unset($param["action"]);
} else $action = "accueil";
// todo vérifier qu'une famille est sélectionnée pour les pages

$args = array_merge($param, $_POST);

// --- Liste des méthodes autorisées

require_once '../controller/Controller.php';


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
        Controller::require_family_selected('ControllerEvent', $action, $args);
        break;

    case "listLink" :
    case "addParentLink" :
    case "addUnionLink" :
        Controller::require_family_selected('ControllerLink', $action, $args);
        break;

    case "listIndiv" :
    case "addIndiv" :
    case "selectIndiv":
    Controller::require_family_selected('ControllerIndiv', $action, $args);
        break;
    default:
        //todo faire un 404
        $action = "accueil";
        Controller::$action();
        break;
}
?>
<!-- ----- Fin Router1 -->

