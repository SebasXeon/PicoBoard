<?php 
class Database {
    private $db;
    private $stmt;

    public function __construct() {
        try {
            $this->db = new PDO("sqlite:pico.sqlite");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function query($sql) {
        $this->stmt = $this->db->prepare($sql);
    }

    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch(true) {
                case is_int($value): 
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value): 
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value): 
                    $type = PDO::PARAM_NULL;
                    break;
                default: 
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute() {
        return $this->stmt->execute();
    }

    public function fetchAll() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function closeConnection() {
        $this->db = null;
    }
}