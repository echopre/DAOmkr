<?php

class Conexao {

    public static $instance;
    private static $host;
    private static $banco;
    private static $user;
    private static $pass;

    private function __construct() {
        //
    }
    
    public static function setConfig($host, $banco, $user, $pass){
        self::$host = $host;
        self::$banco = $banco;
        self::$user = $user;
        self::$pass = $pass;
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host='.self::$host.';dbname='.self::$banco, self::$user, 
                    self::$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }

        return self::$instance;
    }
}