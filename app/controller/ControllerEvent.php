
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

  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/event/viewAll.php';
  if (DEBUG)
   echo ("ControllerEvent : listEvent : vue = $vue");
  require ($vue);
 }

 public static function EventCreate() { // Affiche la vue du formulaire
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/event/viewInsert.php';
  require ($vue);
 }

public static function addFamily($nom) {// todo voir comment faire pour l'id
  try {
    // issue in the next line
   $database = Model::getInstance();

   $query = "select max(id) from famille";
   $statement = $database->query($query);
   $tuple = $statement->fetch();
   $id = $tuple['0'];
   $id++;

   // ajout d'un nouveau tuple;
   $query = "insert into famille value (:id, :nom)";
   $statement = $database->prepare($query);
   $statement->execute([
     'id' => $id,
     'nom' => $nom
   ]); 
   return $id;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
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