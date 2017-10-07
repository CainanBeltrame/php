<?PHP
        //PEGA A IMAGEM
    $img = file_get_contents("Imagens/Capa/Capa-Aoharaidovol13.jpg");
        
        //CRIPTOGRAFA
    echo $bas64 = base64_encode($img);
        //EXIBI A IMAGEM DESCRIPTOGRAFANDO
    echo '<img src="data:image/jpg;base64,'.$bas64.'"/>'
?>