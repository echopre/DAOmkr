<?php 

require_once './geracod.php';

$aux = geracod::getCodigo('usuario');

//echo "<pre>\n\n";

echo $aux;

//echo "\n\n</pre>";







/*<?php                   *****  REWARDS  ********

require_once 'stConexao.php';

class compra {
    
    public static $instance;
    public static $tabela = 'amizade';

    private function __construct() {
        //
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new compra();        

        return self::$instance;
    }   

    public static function insert($cpr) {
        $stmt = Conexao::getInstance()->prepare("INSERT INTO ".self::$tabela
                . " (cod_usuario, cod_amigo, data_hora)"
                . " VALUES (':cod_usuario', ':cod_amigo', "
                . " ':data_hora');");



        $param = array(
            ":cod_usuario" => $cpr->cod_usuario,
            ":cod_amigo" => $cpr->cod_amigo,
            ":data_hora" => $cpr->data_hora
        );

        if ($stmt->execute($param)) {
            return true;
        } else {
            return false;
        }
    }

   public static function update($usr) {
        $stmt = Conexao::getInstance()->prepare("UPDATE ".self::$tabela." SET "
          ."`nivel_usuario` = ':nivel_usuario', `cpf_usuario` = ':cpf_usuario', "
          ."`nome_usuario` = ':nome_usuario', `senha` = ':senha', "
          ."`pontos_reais` = ':pontos_reais', `pontos_bonus` = ':pontos_bonus', "
          . "cod_categoria_usuario = ':cod_categoria_usuario' "
          ." WHERE `cod_usuario` = :cod_usuario;");


        $param = array(
            ":nivel_usuario" => $usr->nivel_usuario,
            ":cpf_usuario" => $usr->cpf_usuario,
            ":nome_usuario" => $usr->nome_usuario,
            ":senha" => $usr->senha,
            ":pontos_reais" => $usr->pontos_reais,
            ":pontos_bonus" => $usr->pontos_bonus,
            ":cod_categoria_usuario" => $usr->cod_categoria_usuario,
            ":cod_usuario" => $usr->cod_usuario
        );

        if ($stmt->execute($param)) {
            return true;
        } else {
            return false;
        }
    }


    public static function getByUsuario($usr) {
        $stmt = Conexao::getInstance()->prepare(\"SELECT * FROM ".self::$tabela." WHERE cod_usuario= :usr");

        $stmt->bindParam(":usr", $usr);
        $compras = array();
        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {                
                array_push($compras, $row);
            }
            return $compras;
        } else {
            return null;
        }
    }

    public static function delete($cod_produto, $cod_usuario) {
        $stmt = Conexao::getInstance()->prepare("DELETE FROM ".self::$tabela
                ." WHERE cod_usuario= :cod_usuario"
                . " AND cod_amigo= :cod_amigo");
        
        $stmt->bindParam(":cod_usuario", $cod_usuario);
        $stmt->bindParam(":cod_amigo", $cod_amigo);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }    

}*/
