<?php 
    $config = [];
    $config['sitename'] = "SanMTA v3"; /* Az oldal neve */
    $config['color'] = "#7cc576"; /* Az oldal színkódja */
    $config['min_admin'] = 1; /* Minimum adminszint a kérelmekhez */
    $config['min_admin2'] = 8; /* Minimum adminszint a kérelmekhez */


    $config['menu_logo_url'] = 'https://i.imgur.com/Cv7ZHYo.png'; /* Menü logó URL */
    $config['favicon_url'] = 'https://i.imgur.com/Cv7ZHYo.png'; /* Favicon URL */

    /* Adatbázis beállítások */
    class Database {
        private $username   = "";
        private $password   = "";
        private $host       = "";
        private $dbname     = "";
		
        public $pdo = null;

        public function __construct() {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

            return $this->pdo;
        }

        public function get() {
            return (isset($this->pdo)) ? $this->pdo : false;
        }
    }
?>