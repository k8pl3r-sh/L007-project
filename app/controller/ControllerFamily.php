
<!-- ----- debut ControllerVin -->
<?php
require_once '../model/ModelFamily.php';

class ControllerFamily {
 // --- page d'accueil
 public static function Accueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewAccueil.php';
  if (DEBUG)
   echo ("ControllerFamily : Accueil : vue = $vue");
  require ($vue);
 }


 // --- Liste des Familles
 public static function listFamily() {
  $results = ModelFamily::listFamily();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/famille/viewAll.php';
  if (DEBUG)
   echo ("ControllerFamily : listFamily : vue = $vue");
  require ($vue);
 }


 public static function addFamily() {
  // ----- Construction chemin de la vue
  include 'config.php';
  $results = ModelFamily::addFamily(
      htmlspecialchars($_GET['nom']));
  $vue = $root . '/app/view/famille/viewInsert.php';
  require ($vue);
 }

 public static function selectFamily() {
  // ajouter une validation des informations du formulaire
  $results = ModelFamily::selectFamily(
      htmlspecialchars($_GET['nom']));
  
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/famille/viewInserted.php';
  require ($vue);
 }

}

?>
<!-- ----- fin ControllerFamily -->


