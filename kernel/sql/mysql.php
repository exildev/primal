<?php

$__file__ = realpath(__FILE__);
$__self__ = (str_replace('/', '\\', $_SERVER['DOCUMENT_ROOT'] . $_SERVER['PHP_SELF']));

if ($__file__ == $__self__) {
    header('HTTP/1.0 404 Not Found');
    header("Location: index.php");
}
require_once realpath(dirname(__FILE__)) . '/../../config/config.php';

class DataBase {

    private static $instance = null;
    private $conexion;

    public function __construct() {
        
    }

    /**
     *
     * @return DataBase
     */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function open() {
        $this->conexion = mysqli_connect(Config::host, Config::user, Config::pass, Config::dbnm, Config::port);
        
    }

    public function executeId($sql) {
        $this->open();
        $resEmp = mysqli_query($sql, $this->conexion);
        if (is_bool($resEmp)) {
            $id = mysql_insert_id($this->conexion);
            $this->close();
            return $id;
        } else {
            $this->close();
            return $resEmp;
        }
    }

    public function execute($sql) {
        $this->open();
        $resEmp = mysqli_query($this->conexion, $sql);
        if (!is_bool($resEmp)) {
            $vals = array();
            while ($rowEmp = mysqli_fetch_assoc($resEmp)) {
                array_push($vals, $rowEmp);
            }
            $this->close();
            return $vals;
        } else {
            echo mysqli_error($this->conexion);
            //var_dump($sql);
            $this->close();
            return $resEmp;
        }
    }

    public function getLastId($query) {
        $lastId = mysql_insert_id($query);
        if (!is_bool($lastId)) {
            return $lastId;
        } else {
            return false;
        }
    }

    public function close() {
        mysqli_close($this->conexion);
    }

}

?>
