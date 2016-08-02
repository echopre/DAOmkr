<?php

require_once 'conexao.php';

class DAO {

    public static $instance;
    private static $host;
    private static $banco;
    private static $user;
    private static $pass;

    private function __construct() {
        //
    }
    
    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new DAO();
        return self::$instance;
    }

    public static function setConfig($host, $banco, $user, $pass){
        self::$host = $host;
        self::$banco = $banco;
        self::$user = $user;
        self::$pass = $pass;
        Conexao::setConfig(self::$host, self::$banco, self::$user, self::$pass);
    }    
    
    public static function campos($tabela) {
        
        $stmt = Conexao::getInstance()->prepare("SHOW COLUMNS FROM " . $tabela);
        if ($stmt->execute()) {
            
            $colunas = array();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                array_push($colunas, $row);
            }
            return $colunas;
        } else {
            return null;
        }
    }
    
    public static function tabelas() {
        
//        $stmt = Conexao::getInstance()->prepare("SHOW TABLES FROM " . self::$banco);
        $stmt = Conexao::getInstance()->prepare("SELECT table_name AS tabelas"
                . " FROM  information_schema.tables"
                . " WHERE table_schema = DATABASE()");
        if ($stmt->execute()) {
            
            $tabelas = array();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                array_push($tabelas, $row);
            }
            return $tabelas;
        } else {
            return null;
        }
    }
    
    public static function showTables() {
        
//        $stmt = Conexao::getInstance()->prepare("SHOW TABLES FROM " . self::$banco);
        $stmt = Conexao::getInstance()->prepare("SELECT table_name AS tabelas"
                . " FROM  information_schema.tables"
                . " WHERE table_schema = DATABASE()");
        if ($stmt->execute()) {
            
            $tabelas = array();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                array_push($tabelas, $row->tabelas);
            }
            return $tabelas;
        } else {
            return null;
        }
    }

}
