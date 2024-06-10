<?php

class Conexion{
    private $DB_HOST;
    private $DB_USER;
    private $DB_PASS;
    private $DB_DATA;
    private $DB_PORT;
    private $DB_CHARSET;

    public $conection;

    function __construct(){
        $this->DB_HOST = defined('SERVER') ? SERVER: '';
        $this->DB_USER = defined('USER') ? USER: '';
        $this->DB_PASS = defined('PASS') ? PASS: '';
        $this->DB_DATA = defined('DB') ? DB: '';
        $this->DB_PORT = defined('PORT') ? PORT: '';
        $this->DB_CHARSET = defined('CHARSET') ? CHARSET: '';
    }

    public function connect(){
        $mysql = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_DATA, $this->DB_PORT);
        if($mysql->connect_error){
            return false;
        } else {
            $mysql->set_charset($this->DB_CHARSET);
            $this->conection = $mysql;
            return true;
        }
    }

    public function desconect(){
        $this->conection->close();
    }
}
?>