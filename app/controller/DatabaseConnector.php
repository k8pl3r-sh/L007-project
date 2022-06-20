<?php

class DatabaseConnector
{

    private static $instance = null;
    public $query_fullfiled = TRUE;
    public $query_count = 0;
    protected $connection;
    protected $query;
    protected $show_errors = TRUE;
    protected $query_closed = TRUE;

    private function __construct($dbhost = 'localhost', $dbuser = 'root', $dbpass = '', $dbname = '', $charset = 'utf8')
    {
        $this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

        $this->connection->set_charset($charset);
    }

    /**
     * @return null
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            require "config.php";
            if (isset($dbname) && isset($dbhost) && isset($dbuser) && isset($dbpass))
                DatabaseConnector::$instance = new DatabaseConnector($dbhost, $dbuser, $dbpass, $dbname);
            else throw new Exception('Impossible de se connecter à la DB');
        }
        return self::$instance;

    }

    /**
     * @return mysqli le connecteur à la db
     */
    public function getConnection(): mysqli
    {
        return $this->connection;
    }

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param mixed $query
     */
    public function setQuery($query): void
    {
        $this->query = $query;
    }


    public function query($query)
    {
        $this->query_fullfiled = True;
        if (!$this->query_closed) {
            $this->query->close();
        }
        if ($this->query = $this->connection->prepare($query)) {
            if (func_num_args() > 1) {
                $x = func_get_args();
                $args = array_slice($x, 1);
                $types = '';
                $args_ref = array();
                foreach ($args as $k => &$arg) {
                    if (is_array($args[$k])) {
                        foreach ($args[$k] as $j => &$a) {
                            $types .= $this->_gettype($args[$k][$j]);
                            $args_ref[] = &$a;
                        }
                    } else {
                        $types .= $this->_gettype($args[$k]);
                        $args_ref[] = &$arg;
                    }
                }
                array_unshift($args_ref, $types);
                call_user_func_array(array($this->query, 'bind_param'), $args_ref);
            }
            $this->query->execute();
            if ($this->query->errno) {
                $this->error('Impossible de traiter la requête MySQL (revoir les paramètres). - ' . $this->query->error);
            }
            $this->query_closed = FALSE;
            $this->query_count++;
        } else {
            $this->error('Impossible de préparer un statement MySQL (sûrement la syntaxe). - ' . $this->connection->error);
        }
        return $this;
    }

    public function close()
    {
        return $this->connection->close();
    }

    /**
     * @param $var la variable à identifier
     * @return string qui correspond au type msql de la variable
     */
    private function _gettype($var)
    {
        if (is_string($var)) return 's';
        if (is_float($var)) return 'd';
        if (is_int($var)) return 'i';
        return 'b';
    }

    public function error($error)
    {
        echo "<p> $error </p>";
        $this->query_fullfiled = False;
//        if ($this->show_errors) {
//            exit($error);
//        }
    }

    /**
     * @param null $callback cette fonction sera appelée avec en paramètre chaque membre en résultant
     * @return array
     */
    public function fetchAll($callback = null)
    {
        $params = array();
        $row = array();
        $meta = $this->query->result_metadata();
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }
        call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            $r = array();
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            if ($callback != null && is_callable($callback)) {
                $value = call_user_func($callback, $r);
                if ($value == 'break') break;
            } else {
                $result[] = $r;
            }
        }
        $this->query->close();
        $this->query_closed = TRUE;
        return $result;
    }

    public function fetchArray()
    {
        $params = array();
        $row = array();
        $meta = $this->query->result_metadata();
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }
        call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            foreach ($row as $key => $val) {
                $result[$key] = $val;
            }
        }
        $this->query->close();
        $this->query_closed = TRUE;
        return $result;
    }

    public function numRows()
    {
        $this->query->store_result();
        return $this->query->num_rows;
    }

    public function affectedRows()
    {
        return $this->query->affected_rows;
    }

    public function lastInsertID()
    {
        return $this->connection->insert_id;
    }

}

?>