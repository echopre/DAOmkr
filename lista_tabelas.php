<?php
require_once './DAO.php';


$checked = false;


$host = $_POST['host'];
$banco = $_POST['dbname'];
$user = $_POST['usrname'];
$pass = $_POST['pass'];

DAO::setConfig($host, $banco, $user, $pass);
$tabelas = DAO::tabelas();
$dir = 'output/'.$banco;
//    echo '<pre>';
//    print_r($_POST);
//    echo '</pre><hr><hr>';
//    mkdir($dir);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body>
        <h2>Selecione as tabelas que você quer gerar as classes DAO: </h2>
        <form method="POST" action="geraclassedao.php"> 
            <input type="hidden" name="host" value="<?=$host?>">
            <input type="hidden" name="banco" value="<?=$banco?>">
            <input type="hidden" name="usrname" value="<?=$user?>">
            <input type="hidden" name="pass" value="<?=$pass?>">
            <?php foreach ($tabelas as $tab){ ?>
            <p><input type="checkbox" name="tab[]" <?=($checked) ? 'checked="checked"' : '' ?>  value="<?=$tab->tabelas?>" /><?=$tab->tabelas?></p>            
            
            <?php } ?>
            <p><input type="submit" value="Gerar classes DAO" />
                <input type="reset" value="limpar" />
            </p>
        </form>
    </body>
</html>