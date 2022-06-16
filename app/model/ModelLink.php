<!-- ----- debut ModelLink -->

<?php
require_once 'Model.php';

class ModelLink { // TODO
 private $famille_id, $id, $iid1, $iid2, $lien_type, $lien_date, $lien_lieu;

 public function __construct($famille_id = NULL, $id = NULL, $iid1 = NULL, $iid2 = NULL, $lien_type = NULL, $lien_date = NULL, $lien_lieu = NULL) {

  if (!is_null($id)) {
   $this->famille_id = $famille_id;
   $this->id = $id;
   $this->iid1 = $iid1;
   $this->iid2 = $iid2;
   $this->lien_type = $lien_type;
   $this->lien_date = $lien_date;
   $this->lien_lieu = $lien_lieu;
  }
 }

 function setId($id) {
  $this->id = $id;
 }

 function setFamille_Id($famille_id) {
  $this->famille_id = $famille_id;
 }

  function setIid1($iid1) {
  $this->iid1 = $iid1;
 }

  function setIid2($iid2) {
  $this->iid2 = $iid2;
 }

 function setLink_type($lien_type) {
  $this->lien_type = $lien_type;
 }

  function setLink_date($lien_date) {
  $this->lien_date = $lien_date;
 }

 function setLink_lieu($lien_lieu) {
  $this->lien_lieu = $lien_lieu;
 }

 function getId() {
  return $this->id;
 }

 function getIid1() {
  return $this->iid1;
 }

  function getIid2() {
  return $this->iid2;
 }
 function getFamille_id() {
  return $this->famille_id;
 }

 function getLink_type() {
  return $this->lien_type;
 }

  function getLink_date() {
  return $this->lien_date;
 }

 function getLink_lieu() {
  return $this->lien_lieu;
 }
 

public static function listLink() {
  try {
   $database = Model::getInstance();
   $query = "select * from lien"; // TODO pour la famille active 
   // SELECT * FROM `lien` WHERE famille_id=1002 
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelLink");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

}

?>
<!-- ----- fin ModelLink -->
