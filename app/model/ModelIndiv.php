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

    public static function fromName($famille_id, $nom_individu)
    {
        return DatabaseConnector::getInstance()->query(
            "select * from individu where famille_id=? and CONCAT(nom,prenom)=?", $famille_id, $nom_individu
        )->fetchAll()[0];
    }

    /**
     * @param $individu_nom_prenom la concaténation du nom de famille et du prénom de l'individu
     * @return void
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

    function setId($id)
    {
        $this->id = $id;
    }

    function setFamille_Id($famille_id)
    {
        $this->famille_id = $famille_id;
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


    public static function fromId($individu_id, $famille_id)
    {
        return DatabaseConnector::getInstance()->query(
            "select * from individu where id=? and famille_id=? limit 1", $individu_id, $famille_id
        )->fetchAll()[0];
    }

    /**
     * @param $family_id
     * @param $select_id boolean qui indique si le résultat contiendra les id des utilisateurs
     * @return array
     * @throws Exception
     */
    public static function getAllIndivFromFamily($family_id, $select_id = true)
    {
        $select = $select_id ? "i.id," : "";
        return DatabaseConnector::getInstance()->query(
            "
                    select " . $select . " f.nom as famille, i.nom as nom, i.prenom as prenom,
                        CONCAT(p.nom, ' ', p.prenom) as pere,
                        CONCAT(m.nom, ' ', m.prenom) as mere
                    from individu i
                     inner join individu p on p.id = i.pere and i.famille_id = p.famille_id
                     inner join individu m on m.id = i.mere and i.famille_id = m.famille_id
                     join famille f on i.famille_id = f.id
                    where i.id!=0 and f.id = ?
                    order by f.nom, i.nom, i.prenom
            ", $family_id
        )->fetchAll();
    }

}

?>
<!-- ----- fin ModelIndiv -->
