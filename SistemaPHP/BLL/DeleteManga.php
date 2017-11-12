<?PHP
    require_once "../DAL/DAL.php";
    if(empty($_SESSION['ID'])||$_SESSION['PRIVILEGIO'] != 1)
    {
         header('location:Home.php');
    }
    else
    {
        $id = $_POST['id'];
        $tipo = $_POST['type'];
        $result = DeleteManga($id);
        $_SESSION['aviso'] = 1;
        if($result != 1)
        { 
            $_SESSION['MsgAviso'] = "Falha ao Deletar Mangá!";
        }
        else
        {
           
            $_SESSION['MsgAviso'] = "Mangá deletado com Sucesso!";
        }
        $list = $_SESSION['tipoList'];
        header("location:../Listas.php?type=$list&pagina=1");
    }
?>