<?php
set_include_path(ini_get("include_path") . ':/home/edney/NetBeansProjects/cryptosGeraDAO');
require_once 'config.php';
require_once 'conexao.php';
require_once 'DAO.php';

class Query {

    public static $INSERT = '';
    public static $UPDATE = '';
    public static $SELECT = '';
    public static $DELETE = '';

    public static function getInsert($tabela) {

        $colunas = DAO::campos($tabela);

        self::$INSERT = "INSERT INTO " . $tabela . " (";
        $cont = 1;
        foreach ($colunas as $col) {

            self::$INSERT = self::$INSERT . $col->Field;
            if ($cont < count($colunas)) {
                self::$INSERT = self::$INSERT . ", ";
            }
            $cont++;
        }

        $cont = 1;
        self::$INSERT = self::$INSERT . ")\n VALUES(";

        foreach ($colunas as $col) {

            self::$INSERT = self::$INSERT . ":" . $col->Field . "";
            if ($cont < count($colunas)) {
                self::$INSERT = self::$INSERT . ", ";
            }
            $cont++;
        }

        self::$INSERT = self::$INSERT . ");";

        return self::$INSERT;
    }

    
    public static function getlogin($tabela, $chave = false) {

        if ($chave == false) {
            self::$SELECT = "SELECT * FROM " . $tabela;
        } else {
            $colunas = DAO::campos($tabela);
            $key = '';
            foreach ($colunas as $col) {
                if ($col->Key == 'PRI') {
                    $key = $col->Field;
                }
            }
            self::$SELECT = "SELECT * FROM " . $tabela . " WHERE login = :login AND senha = :senha";
        }
        return self::$SELECT;
    }
    
    
    
    public static function getSelect($tabela, $chave = false) {

        if ($chave == false) {
            self::$SELECT = "SELECT * FROM " . $tabela;
        } else {
            $colunas = DAO::campos($tabela);
            $key = '';
            foreach ($colunas as $col) {
                if ($col->Key == 'PRI') {
                    $key = $col->Field;
                }
            }
            self::$SELECT = "SELECT * FROM " . $tabela . " WHERE " . $key . " = :id";
        }
        return self::$SELECT;
    }

    public static function getUpdate($tabela) {

        $colunas = DAO::campos($tabela);
        $chave = '';

        self::$UPDATE = "UPDATE " . $tabela . " SET ";
        $cont = 1;
        $flag = 0;
        foreach ($colunas as $col) {
            if ($flag == 0 && $col->Key == 'PRI') {
                $chave = $col->Field;
                $flag++;
            }
            self::$UPDATE = self::$UPDATE . $col->Field . " = :" . $col->Field . " ";
            if ($cont < count($colunas)) {
                self::$UPDATE = self::$UPDATE . ", ";
            }
            $cont++;
        }



        self::$UPDATE = self::$UPDATE . " WHERE " . $chave . " = :" . $chave . " ";

        return self::$UPDATE;
    }

    public static function getDelete($tabela, $chave = false) {
        if ($chave == false) {
            self::$DELETE = "DELETE FROM " . $tabela;
        } else {
            $colunas = DAO::campos($tabela);
            $key = '';
            foreach ($colunas as $col) {
                if ($col->Key == 'PRI') {
                    $key = $col->Field;
                }
            }
            self::$DELETE = "DELETE FROM " . $tabela . " WHERE " . $key . " = :id";
        }

        return self::$DELETE;
    }

}
