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
        $UPLOADFILE = $UPLOADDIR . basename($_FILES['iManga']['name']);
       
        echo '<pre>';

        if (move_uploaded_file($_FILES['iManga']['tmp_name'], $UPLOADFILE)) 
        {
            $img = file_get_contents($UPLOADFILE);
            $imgManga = base64_encode($img);
            
            $idManga = $_POST['id'];
            $nameManga = $_POST['nManga'];
            $desManga = $_POST['dManga'];
            $sinopManga = $_POST['sManga'];
            $precoManga = $_POST['pManga'];
            $qtdManga = $_POST['qManga'];
            $validaManga = selectMangabyName($nameManga);
            $_SESSION['aviso'] = 1;
            if($validaManga == 0)
            {
                $idUser = $_SESSION['ID'];
                $_SESSION['MsgAviso'] = UpdateManga($idManga,$nameManga,$desManga,$sinopManga,$precoManga,$qtdManga,$imgManga);
                $desc = "Usuario ".$_SESSION['NOME']." Editou 1 Manga  no  dia ";
                $data = date('Y/m/d');
                InsereRelatorioAadm($idUser,$desc,$data);
                header("location:../Listas.php?type=$tipo&pagina=1");
            }
            else
            {
                $_SESSION['MsgAviso'] =  "Falha Mangá ja existe";
                header("location:../Listas.php?type=$tipo&pagina=1");
                exit;
            }


        }
    }
?>