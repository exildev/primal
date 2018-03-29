<?php

require_once realpath(dirname(__FILE__)) . '/Kernel.php';

class Router {

    private $index;
    private $urls;
    
    public function __construct($index) {
        $this->index = $index;
    }

    public function setUrls($urls) {
        $this->urls = $urls;
    }

    public function rout($base) {
        if (isset($_GET['ID'])) {
            $id = $_GET['ID'];
            if (isset($this->urls[$id])) {
                $do = $this->urls[$id];
            } else {
                header('HTTP/1.0 404 Not Found');
                exit();
            }
        } else {
            $do = $this->index;
        }

        $dos = explode('.', $do);
        $pak = $dos[0];
        $viw = $dos[1];
        $fun = $dos[2];
        require_once $base . '/' . $pak . '/view/' . ucfirst($viw) . '.php';
        $packet = new $viw();
        if ($packet instanceof View) {
            if (isset($_GET['LANG'])) {
                $packet->setLanguage($_GET['LANG']);
            }
            if ($packet->dispatch()){
                return $packet->{$fun}();
            }
        }
    }

    /**
     * 
     * @return Router
     */
    public static function getInstance($index) {
        if (!isset(self::$instance)) {
            self::$instance = new self($index);
        }
        return self::$instance;
    }

    private static $instance;

}

?>
