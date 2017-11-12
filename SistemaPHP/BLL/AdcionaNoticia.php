<?PHP

include_once "../DAL/DAL.php";
if(empty($_SESSION['ID'])||$_SESSION['PRIVILEGIO'] != 1)
{
     header('location:Home.php');
}
else
{
    $UPLOADDIR = '../Imagens/Capas/noticias';
    $UPLOADFILE = $UPLOADDIR . basename($_FILES['imgNoticia']['name']);
    
     echo '<pre>';
     if (move_uploaded_file($_FILES['imgNoticia']['tmp_name'], $UPLOADFILE)) 
     {
        $tipo = $_SESSION['tipoList'];
        $img = file_get_contents($UPLOADFILE);
        $imgNoticia = base64_encode($img);
        
        $idUser = $_SESSION['ID'];
        $titulo = $_POST['tituloNoticia'];
        $descricaoBreve = $_POST['descBr'];
        $descricao = $_POST['DescComNoticia'];
        $data = date('Y/m/d');
        
        $validaNoticia = selectNoticiabyName($tituloNoticia);
        $_SESSION['aviso'] = 1;

        if($validaNoticia == 0)
        {
            $_SESSION['MsgAviso'] = addNoticia( $titulo, $descricaoBreve, $descricao, $data, $imgNoticia, $idUser);
            $datare = date("Y/m/d");
            $relata = "O Administrador ".$_SESSION['NOME']." Inseriu uma nova noticia!";
            $tipore = 2;
            RelatorioDAL($relata,$datare,$tipore);
            header("location:../Listas.php?type=$tipo&pagina=1");
            exit;
        }
        else
        {
            $_SESSION['MsgAviso'] = "Falha noticia ja Cadastrado";
            header("location:../Listas.php?type=$tipo&pagina=1");
            exit;
        }
    }
}
?>