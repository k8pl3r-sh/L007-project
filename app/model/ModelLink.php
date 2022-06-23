<!-- ----- debut ModelLink -->

<?php

require_once '../controller/DatabaseConnector.php';

class ModelLink
{


    private $famille_id, $id, $iid1, $iid2, $lien_type, $lien_date, $lien_lieu;

    public function __construct($famille_id = NULL, $id = NULL, $iid1 = NULL, $iid2 = NULL, $lien_type = NULL, $lien_date = NULL, $lien_lieu = NULL)
    {

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

    function setId($id)
    {
        $this->id = $id;
    }

    function setIid1($iid1)
    {
        $this->iid1 = $iid1;
    }

    function setIid2($iid2)
    {
        $this->iid2 = $iid2;
    }

    function setLink_type($lien_type)
    {
        $this->lien_type = $lien_type;
    }

    function setLink_date($lien_date)
    {
        $this->lien_date = $lien_date;
    }

    function setLink_lieu($lien_lieu)
    {
        $this->lien_lieu = $lien_lieu;
    }

    function getId()
    {
        return $this->id;
    }

    function getIid1()
    {
        return $this->iid1;
    }

    function getIid2()
    {
        return $this->iid2;
    }

    function getFamille_id()
    {
        return $this->famille_id;
    }

    function setFamille_Id($famille_id)
    {
        $this->famille_id = $famille_id;
    }

    function getLink_type()
    {
        return $this->lien_type;
    }

    function getLink_date()
    {
        return $this->lien_date;
    }

    function getLink_lieu()
    {
        return $this->lien_lieu;
    }

    public static function listLinkOfFamily($family_id)
    {
        return DatabaseConnector::getInstance()->query(
            "
                    select f.nom                          as 'famille',
                           concat(i1.nom, ' ', i1.prenom) as 'individu1',
                           concat(i2.nom, ' ', i2.prenom) as 'individu2',
                           l.lien_type                    as 'type de lien',
                           l.lien_date                    as 'date',
                           l.lien_lieu                    as 'lieu'
                    from lien l
                             inner join famille f on l.famille_id = f.id
                             inner join individu i1 on l.iid1 = i1.id and l.famille_id = i1.famille_id
                             inner join individu i2 on l.iid2 = i2.id and l.famille_id = i2.famille_id
                    where l.famille_id = ?
                    order by lien_date DESC, l.lien_type
                ", $family_id
        )->fetchAll();
    }

    public static function listLinkOfIndividu($personne_id, $famille_id)
    {
        return DatabaseConnector::getInstance()->query(
            "
                    select f.nom                          as 'famille',
                           concat(i1.nom, ' ', i1.prenom) as 'individu1',
                           concat(i2.nom, ' ', i2.prenom) as 'individu2',
                           i1.id                          as 'iid1',
                           i1.famille_id                  as 'fid1',
                           i2.id                          as 'iid2',
                           i2.famille_id                  as 'fid2',
                           l.lien_type                    as 'type de lien',
                           l.lien_date                    as 'date',
                           l.lien_lieu                    as 'lieu'    
                    from lien l
                             inner join famille f on l.famille_id = f.id
                             inner join individu i1 on l.iid1 = i1.id and l.famille_id = i1.famille_id
                             inner join individu i2 on l.iid2 = i2.id and l.famille_id = i2.famille_id
                    where l.famille_id = ? and (i1.id=? or i2.id=?)
                    order by lien_date DESC, l.lien_type
                ", $famille_id, $personne_id, $personne_id
        )->fetchAll();
    }

    public static function insertParentLink($famille_id, $individu_id, $parent_id)
    {
        $parent = ModelIndiv::fromId($parent_id, $famille_id);
        $sexe = $parent["sexe"];
        $row = $sexe == 'H' ? "pere" : ($sexe == 'F' ? 'mere' : null);
        if (is_null($row)) return null;
        DatabaseConnector::getInstance()->query(
            "UPDATE individu 
                        SET " . $row . " = ?
                        WHERE famille_id = ? 
                          AND id = ?", $parent_id, $famille_id, $individu_id
        );
        return ModelIndiv::fromId($individu_id, $famille_id);
    }

    public static function insertUnionLink($famille_id, $iid1, $iid2, $type, $date, $lieu)
    {
        DatabaseConnector::getInstance()->query(
            "insert into lien(famille_id, id, iid1, iid2, lien_type, lien_date, lien_lieu)
                    values (?, (SELECT MAX( id ) + 1 from lien as ll where famille_id=?), ?, ?, ?, ?, ?)",
            $famille_id, $famille_id, $iid1, $iid2, $type, $date, $lieu
        );

    }


}

?>
<!-- ----- fin ModelLink -->
