<!-- ----- debut ModelEvent -->

<?php
require_once 'Model.php';

class ModelEvent { // TODO
 private $famille_id, $id, $iid, $event_type, $event_date, $event_lieu;

 public function __construct($famille_id = NULL, $id = NULL, $iid = NULL, $event_type = NULL, $event_date = NULL, $event_lieu = NULL) {

  if (!is_null($id)) {
   $this->famille_id = $famille_id;
   $this->id = $id;
   $this->iid = $iid;
   $this->event_type = $event_type;
   $this->event_date = $event_date;
   $this->event_lieu = $event_lieu;
  }
 }

 function setId($id) {
  $this->id = $id;
 }

 function setFamille_Id($famille_id) {
  $this->famille_id = $famille_id;
 }

  function setIid($iid) {
  $this->iid = $iid;
 }

 function setEvent_type($event_type) {
  $this->event_type = $event_type;
 }

  function setEvent_date($event_date) {
  $this->event_date = $event_date;
 }

 function setEvent_lieu($event_lieu) {
  $this->event_lieu = $event_lieu;
 }

 function getId() {
  return $this->id;
 }

 function getIid() {
  return $this->iid;
 }
 function getFamille_id() {
  return $this->famille_id;
 }

 function getEvent_type() {
  return $this->event_type;
 }

  function getEvent_date() {
  return $this->event_date;
 }

 function getEvent_lieu() {
  return $this->event_lieu;
 }
 

public static function listEvent() {
  try {
    echo("Model_listEvent");
   $database = Model::getInstance();
   $query = "select * from evenement"; // TODO pour la famille active 
   // SELECT * FROM `evenement` WHERE famille_id=1002 
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelEvent");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

/*
 public static function selectFamily($nom) {
  // edit the jumbotron
  try {
   $database = Model::getInstance();
   $query = "select id from famille where nom = :nom";
   $statement = $database->prepare($query);
   $statement->execute([
     'nom' => $nom
   ]);
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelFamily");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }


 public static function addFamily($nom) {// todo voir comment faire pour l'id
  try {
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
*/
}

?>
<!-- ----- fin ModelEvent -->
