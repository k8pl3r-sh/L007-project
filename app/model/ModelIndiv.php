<!-- ----- debut ModelIndiv -->

<?php
require_once 'Model.php';

class ModelIndiv { // TODO
 private $famille_id, $id, $iid1, $iid2, $lien_type, $lien_date, $lien_lieu;

 public function __construct($famille_id = NULL, $id = NULL, $nom = NULL, $prenom = NULL, $sexe = NULL, $pere = NULL, $mere = NULL) {

  if (!is_null($id)) {
   $this->famille_id = $famille_id;
   $this->id = $id;
   $this->nom = $nom;
   $this->prenom = $prenom;
   $this->sexe = $sexe;
   $this->pere = $pere;
   $this->mere = $mere;
  }
 }

 function setId($id) {
  $this->id = $id;
 }

 function setFamille_Id($famille_id) {
  $this->famille_id = $famille_id;
 }

  function setNom($nom) {
  $this->nom = $nom;
 }

  function setPrenom($prenom) {
  $this->prenom = $prenom;
 }

 function setSexe($sexe) {
  $this->sexe = $sexe;
 }

 function setPere($pere) {
  $this->pere = $pere;
 }

 function setMere($mere) {
  $this->mere = $mere;
 }
 function getId() {
  return $this->id;
 }

 function getFamille_Id() {
  return $this->famille_id;
 }

  function getPere() {
  return $this->pere;
 }
 function getMere() {
  return $this->mere;
 }

  function getSexe() {
  return $this->sexe;
 }

 function getNom() {
  return $this->nom;
 }

  function getPrenom() {
  return $this->prenom;
 }

 

public static function listIndiv() {
  try {
   $database = Model::getInstance();
   $query = "select * from individu"; // TODO pour la famille active 
   // SELECT * FROM `lien` WHERE famille_id=1002 
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndiv");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

}

?>
<!-- ----- fin ModelIndiv -->
