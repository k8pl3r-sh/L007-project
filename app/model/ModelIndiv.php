<!-- ----- debut ModelIndiv -->

<?php
require_once '../controller/DatabaseConnector.php';

class ModelIndiv
{ // TODO


    private $famille_id, $id, $iid1, $iid2, $lien_type, $lien_date, $lien_lieu;

    public function __construct($famille_id = NULL, $id = NULL, $nom = NULL, $prenom = NULL, $sexe = NULL, $pere = NULL, $mere = NULL)
    {

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

    /**
     * Permet de retrouver un individu à partir de son nom et sa famille
     * @param int $famille_id l'id de sa famille
     * @param string $nom_individu le nom de l'individu à retrouver
     * @return array un tableau contenant les informations de l'individu
     */
    public static function fromName($famille_id, $nom_individu)
    {
        return DatabaseConnector::getInstance()->query(
            "select * from individu where famille_id=? and CONCAT(nom,prenom)=?", $famille_id, $nom_individu
        )->fetchAll()[0];
    }

    /**
     * @param $individu_nom_prenom la concaténation du nom de famille et du prénom de l'individu
     * @return array un tableau contenant les informations de l'individu
     */
    public static function fromConcatenatedNames($individu_nom_prenom)
    {
        return DatabaseConnector::getInstance()->query(
            "select * from individu where CONCAT(nom,prenom)=? limit 1", $individu_nom_prenom
        )->fetchAll()[0];
    }


    /**
     * @param $iid1 l'id de la personne en question
     * @param array $unions un talbeau contenant toutes les unions de iid1
     * @return array un tableau associant à chaque iid2 les enfants de l'union
     */
    public static function ListEnfantDUnion($iid1, array $unions)
    {
        $res = array();
        foreach ($unions as $union) {
            $iid = $union["iid1"] == $iid1 ? $union["iid2"] : $union["iid1"];
            $res[$iid] =
                DatabaseConnector::getInstance()->query(
                    "select * from individu where (pere=? and mere=?) or (pere=? and mere=?)", $iid, $iid1, $iid1, $iid
                )->fetchAll();
        }
        return $res;

    }

    /**
     * Retourne tous les individus existantrs dans la base de données
     * @return array un tableau contenant à chaque entrée un tableau représentant un individu
     */
    public static function listIndiv()
    {
        return DatabaseConnector::getInstance()->query(
            "select 
                        f.nom as famille, i.nom as nom, i.prenom as prenom,
                        CONCAT(p.nom, ' ', p.prenom) as pere,
                        CONCAT(m.nom, ' ', m.prenom) as mere
                    from individu i
                     inner join individu p on p.id = i.pere and i.famille_id = p.famille_id
                     inner join individu m on m.id = i.mere and i.famille_id = m.famille_id
                     join famille f on i.famille_id = f.id
                    where i.id!=0
                    order by f.nom, i.nom, i.prenom"
        )->fetchAll();
    }

    /**
     * Permet d'obtenir un individu à partir de son id et son id de famille
     * @param int $individu_id l'id de l'individu
     * @param string $famille_id la famille de l'individu
     * @return array un tableau contenant toutes les informations de l'individu
     */
    public static function fromId($individu_id, $famille_id)
    {
        $res = DatabaseConnector::getInstance()->query(
            "select * from individu where id=? and famille_id=? limit 1", $individu_id, $famille_id
        )->fetchAll();
        if (empty($res)) return null;
        return $res[0];
    }

    /**
     * Permet d'obtenir tous les individus d'une famille
     * @param int $family_id l'id de la famille en question
     * @param boolean $select_id boolean qui indique si le résultat contiendra les id des utilisateurs
     * @return array un tableau contenant à chaque entrée un tableau représentant un individu
     */
    public static function getAllIndivFromFamily($family_id, $select_id = true, $filter = "")
    {
        $select = $select_id ? "i.id," : "";
        return DatabaseConnector::getInstance()->query(
            "
                    (select " . $select . " f.nom as famille, i.nom as nom, i.prenom as prenom,
                        CONCAT(p.nom, ' ', p.prenom) as pere,
                        CONCAT(m.nom, ' ', m.prenom) as mere
                    from individu i
                     inner join individu p on p.id = i.pere and i.famille_id = p.famille_id
                     inner join individu m on m.id = i.mere and i.famille_id = m.famille_id
                     join famille f on i.famille_id = f.id
                    where i.id!=0 and f.id = ? " . $filter . "
                    order by f.nom, i.nom, i.prenom)
                    union
                     (select " . $select . " f.nom as famille, i.nom as nom, i.prenom as prenom,
                        'inconnu' as pere,
                        'inconnue' as mere
                    from individu i
                     join famille f on i.famille_id = f.id
                    where i.id!=0 and f.id = ? and (i.pere IS NULL or i.mere IS NULL) " . $filter . "
                    order by f.nom, i.nom, i.prenom)
            ", $family_id, $family_id
        )->fetchAll();
    }

    public static function insertIndividu($famille_id, $nom, $prenom, $sexe)
    {
        $max_id = self::getMaxIdFromFamille($famille_id);
        DatabaseConnector::getInstance()->query("
        insert into individu(id,famille_id,  nom, prenom, sexe)
        values( ? + 1, ?, ?, ?, ?)
        ", $max_id, $famille_id, $nom, $prenom, $sexe
        );
        return DatabaseConnector::getInstance()->query("
            select * from individu where famille_id=? and nom=? and prenom=?
        ", $famille_id, $nom, $prenom
        )->fetchAll();
    }

    private static function getMaxIdFromFamille($famille_id)
    {
        $res = DatabaseConnector::getInstance()->query(
            "select GREATEST(MAX(id),0) as id from individu where famille_id=? limit 1", $famille_id
        )->fetchAll();
        if (!isset($res[0]['id']) || $res[0]['id'] == null) return 0;
        return $res[0]['id'];
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNom($nom)
    {
        $this->nom = $nom;
    }

    function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    function setPere($pere)
    {
        $this->pere = $pere;
    }

    function setMere($mere)
    {
        $this->mere = $mere;
    }

    function getId()
    {
        return $this->id;
    }

    function getFamille_Id()
    {
        return $this->famille_id;
    }

    function setFamille_Id($famille_id)
    {
        $this->famille_id = $famille_id;
    }

    function getPere()
    {
        return $this->pere;
    }

    function getMere()
    {
        return $this->mere;
    }

    function getSexe()
    {
        return $this->sexe;
    }

    function getNom()
    {
        return $this->nom;
    }

    function getPrenom()
    {
        return $this->prenom;
    }

}

?>
<!-- ----- fin ModelIndiv -->
