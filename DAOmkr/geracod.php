<?php

set_include_path(ini_get("include_path") . ':/home/edney/NetBeansProjects/cryptosGeraDAO');
require_once 'querys/query.php';
require_once 'DAO.php';

class geracod {

    public static $text = "";

    public static function setConfig($host, $banco, $user, $pass) {
        DAO::setConfig($host, $banco, $user, $pass);
    }

    public static function getCodigo($tabela) {
        $campos = DAO::campos($tabela);
        self::$text = "<?php"
                . "\nrequire_once 'stConexao.php';\n"
                . "\nclass $tabela { \n"
                . "\n\tpublic static \$instance;"
                . "\n\tpublic static \$tabela = '" . $tabela . "';"
//-----------------------  FUNCTION INSERT ----------------------------------//
                . "\n\n\n//--------- function insert(\$obj) --------------//\n\n"
                . "\n\n\tpublic static function insert(\$obj) {"
                . "\n\t\t try{"
                . "\n\t\t\$stmt = Conexao::getInstance()->prepare(\""
                . Query::getInsert($tabela)
                . "\");\n";
        foreach ($campos AS $campo) {
            self::$text = self::$text . "\n\t\t\$stmt->bindParam(\":" . $campo->Field . "\", \$obj->" . $campo->Field . ");";
        }
        self::$text = self::$text . "\n\n\t\t\$stmt->execute(); "
                . "\n\t\t\treturn true;"
                . "\n\t\t} catch(PDOException \$ex) {"
                . "\n\t\treturn false;"
                . "\n\t\t}"
                . "\n\t}"
//-----------------------  FUNCTION INSERT(fim) ----------------------------------//
//-----------------------  FUNCTION UPDATE ---------------------------------------//
                . "\n\n\n //------------------ function update(\$obj)  ---------//"
                . "\n\n\tpublic static function update(\$obj) {"
                . "\n\t\t try{"
                . "\n\t\t\$stmt = Conexao::getInstance()->prepare(\""
                . Query::getUpdate($tabela)
                . "\");\n";
        foreach ($campos AS $campo) {
            self::$text = self::$text . "\n\t\t\$stmt->bindParam(\":" . $campo->Field . "\", \$obj->" . $campo->Field . ");";
        }



        self::$text = self::$text . "\n\n\t\t\$stmt->execute(); "
                . "\n\t\t\treturn true;"
                . "\n\t\t} catch(PDOException \$ex) {"
                . "\n\t\treturn false;"
                . "\n\t\t}"
                . "\n\t}"
//-----------------------  FUNCTION UPDATE(fim)-------------------------------------//
//-----------------------  FUNCTION SELECT      ------------------------------------//
                . "\n\n\n //------------------ function select(\$id)---------//\n\n"
                . "\n\n\tpublic static function getById(\$id) {"
                . "\n\n\t try {"
                . "\n\t\t\$stmt = Conexao::getInstance()->prepare(\""
                . Query::getSelect($tabela, true)
                . "\");\n"
                . "\n\t\t\$stmt->bindParam(\":id\", \$id);"
                . "\n\t\t \$stmt->execute();"
                . "\n\t\t\t\$colunas = array();"
                . "\n\t\t\twhile (\$row = \$stmt->fetch(PDO::FETCH_OBJ)) {"
                . "\n\t\t\t\tarray_push(\$colunas, \$row);"
                . "\n\t\t\t}"
                . "\n\t\t\treturn \$colunas;"
                . "\n\t\t} catch(PDOException \$ex) {"
                . "\n\t\treturn false;"
                . "\n\t\t}"
                . "\n\t}"
                //-----------------------  FUNCTION SELECT(fim) ------------------------------------//
                //
 //-----------------------  FUNCTION DELETE -----------------------------------------// 
                . "\n\n\n //------------------ function delete(\$id)---------//\n\n"
                . "\n\n\tpublic static function delete(\$id) {"
                . "\n\t\t try{ "
                . "\n\t\t\$stmt = Conexao::getInstance()->prepare(\""
                . Query::getDelete($tabela, true)
                . "\");\n"
                . "\n\t\t\$stmt->bindParam(\":id\", \$id);"
                . "\n\n\t\t\$stmt->execute(); "
                . "\n\t\t\treturn true;"
                . "\n\t\t} catch(PDOException \$ex) {"
                . "\n\t\treturn false;"
                . "\n\t\t}"
                . "\n\t}"
                . "\n}";

        return self::$text;
    }

}
