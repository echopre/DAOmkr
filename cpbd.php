<?php
/**
 * @copyright (c) 2016, Cryptos Segurança e Tecnologia da Informação
 */
require_once './DAO.php';


require_once 'DAO.php';

$host = 'localhost';
$user = 'root';
$pass = '';
$banco = 'docka_database';

// link do json remoto
$url_json = 'http://docka.com.br/tmp/bdjson.php';


DAO::setConfig($host, $banco, $user, $pass);


$banco_remoto = '';



$tabelas_local = DAO::showTables();


//echo '<pre>';
//print_r($tabelas_local);
//die();


$banco_local = array();
foreach ($tabelas_local as $tabela):

    $colunas = DAO::campos($tabela);

    if (!is_array($banco_local[$tabela])):
        $banco_local[$tabela] = array();
    endif;

    $banco_local[$tabela] = $banco_local[$tabela] + $colunas;


endforeach;


//echo '<pre>';
//print_r($banco_local);
//die();



$json = file_get_contents($url_json);
//echo $json;
$array_remota = json_decode($json, true);
?>
<table border="1">
    <thead>
        <tr>
            <th>Bd local</th>
            <th>bd remoto</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($banco_local as $index => $tabela):
            if(json_encode($banco_local[$index]) != json_encode($array_remota[$index])):
                $style = 'style="background-color: #EBD5A4"';
            else:
                $style = '';
            endif;
            
            ?>
            <tr <?= $style ?> >
                <td>
                    <p><?= $index ?></p>
                    <pre>                        
                        <?php print_r($banco_local[$index]) ?>
                    </pre>
                </td>
                <td>
                    <p><?= $index ?></p>
                    <pre>                        
                        <?php print_r($array_remota[$index]) ?>
                    </pre>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
