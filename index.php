<?php

define('USER','root');
define('PASS','');
define('BANCO','quatroma_elearning');
define('HOST','localhost');
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body>
        <form method="POST" action="lista_tabelas.php">
            <p><label>Digite o host do banco de dados: </label><input type="text" name="host" value="<?=HOST?>" /></p>
            <p><label>Digite o nome do banco de dados: </label><input type="text" name="dbname" value="<?=BANCO?>" /></p>
            <p><label>Digite o nome de usuario do banco de dados: </label><input type="text" name="usrname" value="<?=USER?>" /></p>
            <p><label>Digite a senha do banco de dados: </label><input type="password" name="pass" value="<?=PASS?>" /></p>
            <p><input type="submit" value="Enviar" /></p>            
        </form>
    </body>
</html>