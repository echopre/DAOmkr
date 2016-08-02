<?php

require_once 'DAO.php';

$host = 'localhost';
$user = 'root';
$pass = '';


//$teste = true;
$teste = false;

$banco = 'europaed_europa';
//$tabelas = array('arbitro', 'arbitro_curso', 'arbitro_empresa', 'arbitro_escola', 'arbitro_familia', 'arbitro_info', 'arbitro_banco');
//$tabelas = array('arbitro_banco');
$tabelas = array('curso_candidato');


DAO::setConfig($host, $banco, $user, $pass);


echo '<pre>';


echo htmlspecialchars("\$$tabelas[0] = new stdClass();");

foreach ($tabelas as $tabela):
    echo '<br> // ------' . $tabela . '<br>';
    $campos = DAO::campos($tabela);

    foreach ($campos as $campo):
        if ($teste):
            
            $value = $campo->Type == 'int(11)' ? '1' : '"teste"';
            
            $php = '$' . $tabelas[0] . '->' . $campo->Field . ' = '.$value.';';              
            echo '<br>' . htmlspecialchars($php);
            
        else:
            $php = '$' . $tabelas[0] . '->' . $campo->Field . ' = isset($_POST["' . $campo->Field . '"]) ? $_POST["' . $campo->Field . '"] : null;';
            echo '<br>' . htmlspecialchars($php);
        endif;



    endforeach;
    echo '<br>';
endforeach;

echo '</pre>';
