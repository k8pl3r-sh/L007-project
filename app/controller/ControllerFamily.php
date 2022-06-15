
<!-- ----- debut ControllerVin -->
<?php
require_once '../model/ModelFamily.php';

class ControllerFamily {
 // --- page d'accueil
 public static function caveAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewCaveAccueil.php';
  if (DEBUG)
   echo ("ControllerFamily : caveAccueil : vue = $vue");
  require ($vue);
 }


 // --- Liste des Familles
 public static function listFamily() {
  $results = ModelFamily::listFamily();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/vin/viewAll.php';
  if (DEBUG)
   echo ("ControllerVin : listFamily : vue = $vue");
  require ($vue);
 }


 public static function addFamily() {
  // ----- Construction chemin de la vue
  include 'config.php';
  $results = ModelVin::selectFamily(
      htmlspecialchars($_GET['nom']));
  $vue = $root . '/app/view/vin/viewInsert.php';
  require ($vue);
 }

 public static function selectFamily() {
  // ajouter une validation des informations du formulaire
  $results = ModelVin::selectFamily(
      htmlspecialchars($_GET['nom']));
  
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/vin/viewInserted.php';
  require ($vue);
 }

}

?>
<!-- ----- fin ControllerFamily -->


