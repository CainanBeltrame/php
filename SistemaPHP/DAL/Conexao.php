<?php
function open_conexao(){
    $conexao = new mysqli("localhost", "root", "","nossomanga");
    if (mysqli_connect_errno()) {
        printf("Erro de conexão: %s\n", mysqli_connect_error());
        exit;
    }
    return $conexao; 
}

function close_conexao($conexao) {
    if (!$conexao) {
        echo "Erro ao fechar banco MySql...";
        //exit;   
    }
     mysqli_close($conexao);
}
 
?>