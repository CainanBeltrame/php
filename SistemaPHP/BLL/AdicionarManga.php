<?PHP
    include_once "../DAL/DAL.php";
    if(empty($_SESSION['ID'])||$_SESSION['PRIVILEGIO'] != 1)
    {
         header('location:Home.php');
    }
    else
    {
        $UPLOADDIR = '../Imagens/Capas/';
        $UPLOADFILE = $UPLOADDIR . basename($_FILES['Imanga']['name']);
       
        echo '<pre>';
        if (move_uploaded_file($_FILES['Imanga']['tmp_name'], $UPLOADFILE)) 
        {
            $tipo = $_SESSION['tipoList'];
            $img = file_get_contents($UPLOADFILE);
            $imgManga = base64_encode($img);
            
            $idUser = $_SESSION['ID'];
            $nameManga = $_POST['Nmanga'];
            $desManga = $_POST['Dmanga'];
            $sinopManga = $_POST['SManga'];
            $precoManga = $_POST['Pmanga'];
            $qtdManga = $_POST['QTDmanga'];
            $validaManga = selectMangabyName($nameManga);
            $_SESSION['aviso'] = 1;
            if($validaManga == 0)
            {
                $_SESSION['MsgAviso'] = AddManga($idUser,$nameManga,$desManga,$sinopManga,$precoManga,$qtdManga,$imgManga);
                $desc = "Usuario ".$_SESSION['NOME']." Adicionou 1 Manga";
                $data = date('Y/m/d');
                InsereRelatorioAadm($idUser,$desc,$data);
                header("location:../Listas.php?type=$tipo&pagina=1");
                exit;
            }
            else
            {
                $_SESSION['MsgAviso'] = "Falha Mangá ja Cadastrado";
                header("location:../Listas.php?type=$tipo&pagina=1");
                exit;
            }


        }
    }
?>