
<!-- ----- debut ControllerEvent -->
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


 public static function FamilyCreate() { // Affiche la vue du formulaire
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/famille/viewInsert.php';
  require ($vue);
 }

 public static function debug() { 
  // ----- Construction chemin de la vue
  include 'config.php';
  echo("DEBUG");
 }

 public static function addFamily() {
  // ----- Construction chemin de la vue
  include 'config.php';
  
  $results = ModelFamily::addFamily(htmlspecialchars($_GET['nom']));
  // suppr var 

     if (isset($root))
         $vue = $root . '/app/view/famille/viewInserted.php';
  //$vue = $root . '/app/view/famille/debug.php';
  require ($vue);
 }

 public static function selectFamily() {
  // ajouter une validation des informations du formulaire
         // ----- Construction chemin de la vue
     $object_list =  ModelFamily::listFamily();
     include 'config.php';

         if (isset($root))
             $vue = $root . '/app/view/famille/viewSelect.php';
         require ($vue);
     if(isset($_GET["nom"])){
         $results = ModelFamily::selectFamily(
             htmlspecialchars($_GET['nom']));
     }
 }

}

?>
<!-- ----- fin ControllerFamily -->


