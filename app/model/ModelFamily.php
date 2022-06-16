<!-- ----- debut ModelFamily -->

<?php
require_once 'Model.php';

class ModelFamily {
 private $id, $nom;

 // pas possible d'avoir 2 constructeurs
 public function __construct($id = NULL, $nom = NULL) {
  // valeurs nulles si pas de passage de parametres
  if (!is_null($id)) {
   $this->id = $id;
   $this->nom = $nom;
  }
 }

 function setId($id) {
  $this->id = $id;
 }

 function setName($nom) {
  $this->nom = $nom;
 }

 function getId() {
  return $this->id;
 }

 function getName() {
  return $this->nom;
 }
 
 
// retourne une liste des id
 public static function listFamily() {
  try {
   $database = Model::getInstance();
   $query = "select * from famille";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelFamily");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }


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
echo($nom);
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

}

?>
<!-- ----- fin ModelFamily -->
