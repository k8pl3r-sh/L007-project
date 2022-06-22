<!-- ----- debut ModelEvent -->

<?php
require_once '../controller/DatabaseConnector.php';

class ModelEvent
{ // TODO
    private $famille_id, $id, $iid, $event_type, $event_date, $event_lieu;

    public function __construct($famille_id = NULL, $id = NULL, $iid = NULL, $event_type = NULL, $event_date = NULL, $event_lieu = NULL)
    {

        if (!is_null($id)) {
            $this->famille_id = $famille_id;
            $this->id = $id;
            $this->iid = $iid;
            $this->event_type = $event_type;
            $this->event_date = $event_date;
            $this->event_lieu = $event_lieu;
        }
    }

    function setId($id)
    {
        $this->id = $id;
    }


    function setIid($iid)
    {
        $this->iid = $iid;
    }

    function setEvent_type($event_type)
    {
        $this->event_type = $event_type;
    }

    function setEvent_date($event_date)
    {
        $this->event_date = $event_date;
    }

    function setEvent_lieu($event_lieu)
    {
        $this->event_lieu = $event_lieu;
    }

    function getId()
    {
        return $this->id;
    }

    function getIid()
    {
        return $this->iid;
    }

    function getFamille_id()
    {
        return $this->famille_id;
    }

    function setFamille_Id($famille_id)
    {
        $this->famille_id = $famille_id;
    }

    function getEvent_type()
    {
        return $this->event_type;
    }

    function getEvent_date()
    {
        return $this->event_date;
    }

    function getEvent_lieu()
    {
        return $this->event_lieu;
    }

    /**
     * Retourne un tableau représentant tous les types d'évènements possibles
     * @return tableau de la forme
     * array (size=2)
     *   0 =>
     *   array (size=1)
     *  'event_type' => string 'NAISSANCE' (length=9)
     *   1 =>
     *  array (size=1)
     * '    event_type' => string 'DECES' (length=5)
     */
    public static function getAllEventTypes()
    {
        return DatabaseConnector::getInstance()->query(
            "select distinct event_type from evenement order by event_type"
        )->fetchAll();
    }

    /**
     * Liste tous les évènements liés à la famille passée en paramètre
     * @param $famille_id l'id de la famille
     * @return array tous les évènements
     */
    public static function listEventFamille($famille_id)
    {
        return DatabaseConnector::getInstance()->query(
            "select
                        f.nom as famille, event_date as 'date', event_type as 'type', event_lieu as lieu
                        from evenement e join famille f on e.famille_id = f.id
                        where famille_id = ? 
                        order by event_date", $famille_id)->fetchAll();
    }

    /**
     * Liste tous les évènement d'une personne précise de la famille
     * @param $personne_id
     * @param $famille_id
     * @return array
     * @throws Exception
     */
    public static function listEventIndividu($personne_id, $famille_id)
    {
        return DatabaseConnector::getInstance()->query(
            "select
                        f.nom as famille, event_date as 'date', event_type as 'type', event_lieu as lieu
                        from evenement e join famille f on e.famille_id = f.id
                        where famille_id = ? and e.iid = ?
                        order by event_date", $famille_id, $personne_id)->fetchAll();
    }

    /**
     * @param $famille_id
     * @param $individu
     * @param $evenement
     * @param $date
     * @param $lieu
     * @return array
     * @throws Exception
     */
    public static function addEvent($famille_id, $individu, $evenement, $date, $lieu)
    {
        DatabaseConnector::getInstance()->query(
            "insert into 
                    evenement(famille_id, id, iid, event_type, event_date, event_lieu)
                    value (?, (SELECT MAX( id ) + 1 from evenement as ee where famille_id=?), ?, ?, ?, ?)"
            , $famille_id, $famille_id, $individu, $evenement, $date, $lieu
        );
        return DatabaseConnector::getInstance()->query(
            "select * from evenement 
                    where iid = ? and famille_id=? and event_date=? and event_type=? order by id DESC limit 1"
            , $individu, $famille_id, $date, $evenement
        )->fetchAll();
    }
}

?>
<!-- ----- fin ModelEvent -->
