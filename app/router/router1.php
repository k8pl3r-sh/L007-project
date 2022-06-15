
<!-- ----- debut Router1 -->
<?php
require ('../controller/ControllerFamily.php');

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
 case "addFamily" :
    ControllerFamily::$action();
 case "selectFamily" :
    ControllerFamily::$action();
 case "listEvent" :
 case "addEvent" :
 case "listLink" :
 case "addParentLink" :
 case "addUnionLink" :
 case "listIndiv" :
 case "addIndiv" :
  break;

 // Tache par défaut
 default:
  $action = "caveAccueil";
  ControllerFamily::$action();
}
?>
<!-- ----- Fin Router1 -->

