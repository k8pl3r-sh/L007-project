<!-- ----- debut ModelFamily -->

<?php

require_once '../controller/DatabaseConnector.php';

class ModelFamily
{
    private $id, $nom;

    // pas possible d'avoir 2 constructeurs
    public function __construct($id = NULL, $nom = NULL)
    {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->id = $id;
            $this->nom = $nom;
        }
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setName($nom)
    {
        $this->nom = $nom;
    }

    function getId()
    {
        return $this->id;
    }

    function getName()
    {
        return $this->nom;
    }

    /**
     * Tranforme un tableau de tableau en tableau de famille
     *
     * @param $array
     * @param $classType
     * @return array
     */
    static function array_map_famille($array)
    {
        return array_map(function ($element) {
            return new ModelFamily($element["id"], $element["nom"]);
        }, $array);
    }


// retourne une liste des id

    public static function listFamily()
    {
        $db = DatabaseConnector::getInstance();
        return $db->query("select * from famille")->fetchAll();
    }

    public static function fromId($famille_id)
    {
        return DatabaseConnector::getInstance()->query(
            "select * from famille where id=? limit 1", $famille_id
        )->fetchAll()[0];
    }


    public static function addFamily($nom)
    {
        $id = DatabaseConnector::getInstance()->query("select max(id) as id from famille")->fetchArray()['id'] + 1;
        DatabaseConnector::getInstance()->query("INSERT INTO famille (id, nom) VALUES (?, ?)", $id, $nom);
        return self::fromName($nom);
    }

    public static function selectFamily($nom)
    {
        return DatabaseConnector::getInstance()->query("select * from famille where nom = ?  order by id DESC limit 1", $nom)->fetchAll();
    }


}

?>
<!-- ----- fin ModelFamily -->
