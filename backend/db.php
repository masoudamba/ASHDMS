<?php

class DBA
{
    public $db;
    private $host = 'localhost';
    private $dbname = 'ashdms';
    private $dbuser = 'root';
    private $password = '';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        if (is_object($this->db)) {
            $this->db;
        }else {
            try {
                $dsn = "mysql:host=".$this->host.";dbname=".$this->dbname;
                $this->db = new \PDO($dsn,$this->dbuser,$this->password);
                $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }
        return $this->db;
    }
}
