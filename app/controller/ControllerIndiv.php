
<!-- ----- debut ControllerLink -->
<?php
require_once '../model/ModelIndiv.php';

class ControllerIndiv {

 // --- Liste des Familles
 public static function listIndiv() {
  $results = ModelIndiv::listIndiv();

  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/indiv/viewAll.php';
  if (DEBUG)
   echo ("ControllerIndiv : listIndiv : vue = $vue");
  require ($vue);
 }

/*
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
 }*/

}

?>
<!-- ----- fin ControllerEvent -->