
<!-- ----- debut Router1 -->
<?php
require ('../controller/ControllerFamily.php');
require ('../controller/ControllerEvent.php');

require ('../controller/ControllerLink.php');

require ('../controller/ControllerIndiv.php');


// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);

// --- Liste des méthodes autorisées
switch ($action) {
 case "listFamily" :
    ControllerFamily::$action();
    break;
 case "FamilyCreate" :
    ControllerFamily::$action();
    break;
 case "addFamily" :
    ControllerFamily::$action();
    break;
 case "selectFamily" :
    ControllerFamily::$action();
    break;
 case "listEvent" :
    ControllerEvent::$action();
    break;
 case "EventCreate" :
    ControllerEvent::$action();
    break;
 case "addEvent" :
    ControllerEvent::$action();
    break;

 case "listLink" :
    ControllerLink::$action();
    break;
 case "addParentLink" :
    //TODO
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

 // Tache par défaut
 default:
 // TO change
  $action = "Accueil";
  ControllerFamily::$action();
  break;
}
?>
<!-- ----- Fin Router1 -->

