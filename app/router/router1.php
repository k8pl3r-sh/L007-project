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

// --- Liste des méthodes autorisées
switch ($action) {
    case "accueil" :
        Controller::$action();
        break;
    case "listFamily" :
        ControllerFamily::$action();
        break;
    case "familyCreate" :
        ControllerFamily::$action();
        break;
    case "addFamily" :
        ControllerFamily::$action();
        break;
    case "selectFamily" :
        ControllerFamily::$action();
        break;
    case "familySelected":
        ControllerFamily::familySelected();
        break;
    case "listEvent" :
        ControllerEvent::$action();
        break;
    case "eventCreate" :
        ControllerEvent::$action();
        break;
    case "listLink" :
        ControllerLink::$action();
        break;
    case "addParentLink" :
        ControllerLink::$action();
        break;
    case "addUnionLink" :
        //TODO

    case "listIndiv" :
        ControllerIndiv::$action();
        break;
    case "addIndiv" :
        //TODO
        break;

    case "debug" :
        ControllerFamily::$action();
        break;
    default:
        //todo faire un 404
        $action = "accueil";
        Controller::$action();
        break;
}
?>
<!-- ----- Fin Router1 -->

