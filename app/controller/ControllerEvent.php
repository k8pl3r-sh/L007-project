
<!-- ----- debut ControllerEvent -->
<?php
require_once '../model/ModelEvent.php';

class ControllerEvent {
 // --- page d'accueil
 public static function Accueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewAccueil.php';
  if (DEBUG)
   echo ("ControllerEvent : Accueil : vue = $vue");
  require ($vue);
 }


 // --- Liste des Familles
 public static function listEvent() {
  $results = ModelEvent::listEvent();
  echo("ControllerEvent");
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/event/viewAll.php';
  if (DEBUG)
   echo ("ControllerEvent : listEvent : vue = $vue");
  require ($vue);
 }

/*
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
  $vue = $root . '/app/view/famille/viewInsert.php';
  require ($vue);
 }
*/
}

?>
<!-- ----- fin ControllerEvent -->