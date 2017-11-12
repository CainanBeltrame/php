<?PHP
    include_once "../DAL/DAL.php";
    if(empty($_SESSION['ID'])||$_SESSION['PRIVILEGIO'] != 1)
    {
        header('location:Home.php');
    }
    else
    {
        $tipo = $_SESSION['tipoList'];

        $UPLOADDIR = '../Imagens/Capas/';
        $UPLOADFILE = $UPLOADDIR . basename($_FILES['imgNoticia']['name']);
       
        echo '<pre>';

        if (move_uploaded_file($_FILES['imgNoticia']['tmp_name'], $UPLOADFILE)) 
        {
            $img = file_get_contents($UPLOADFILE);
            
            $imgNoticia = base64_encode($img);
            $idNoticia = $_POST['id'];
            $tituloNoticia = $_POST['tituloNoticia'];
            $descBNoticia = $_POST['descBrTitulo'];
            $descCNoticia = $_POST['DescComNoticia'];
            $dataNoticia = $_POST['dataNoticia'];

            $validaNoticia = selectNoticiabyName($tituloNoticia);
            $_SESSION['aviso'] = 1;

            if($validaNoticia == 0)
            {
                $dataNoticia = substr($dataNoticia,6,4)."/".substr($dataNoticia,3,2)."/".substr($dataNoticia,0,2);
                $idUser = $_SESSION['ID'];
                $_SESSION['MsgAviso'] = UpdateNoticia($idNoticia, $tituloNoticia, $descBNoticia, $descCNoticia, $dataNoticia, $imgNoticia);
                header("location:../Listas.php?type=$tipo&pagina=1");
            }else
            {
                $_SESSION['MsgAviso'] =  "Falha Noticia ja existe";
                header("location:../Listas.php?type=$tipo&pagina=1");
                exit;
            }
    }
}
?>