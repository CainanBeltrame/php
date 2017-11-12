<?PHP
    require_once(".\DAL\DAL.php");

    function CountMangaPost($idUser)
    {
       return $Manga = totalpostsManga($idUser);
    }
    function CountNoticiaPost($idUser)
    {
        return $Noticia = totalpostsNoticia($idUser);
    }

    function MangasbyID($idM)
    {
        return $Manga = SelectMangabyID($idM);        
    }

    function selectmangabyUser($idUser,$inicio,$qtd,$op)
    {
        if($op == 1)
        {
            $rs = selectMangasByUserLimit($idUser ,$inicio, $qtd);
        }
        else
        {
            $rs = SelectMangasbyUser($idUser);
        }
    }

    function DeleteM($id)
    {
        $result = DeleteManga($id);
        if($result != 1)
        {
            $_SESSION['MsgErro'] = "Falha ao excluir Mangá!";
            $_SESSION['erro'] = 1;
        }
        return $result;
    }
    function seleManga($inicio, $quantidade, $op)
    {
        if($op == 1)
        {
            $rs = SelectMangasLimt($inicio, $quantidade);
        }
        else
        {
            $rs = SelectMangas();
        }
        return $rs;
    }
    function selectRelatorio($inicio, $quantidade, $op)
    {
        if($op == 1)
        {
            
        }
        else
        {
            
        }
        return $rs;
    }

    function selecNoticia($inicio, $quantidade, $op)
    {
        if($op == 1)
        {
            $rs = SelectNotciaLimt($inicio, $quantidade);
        }
        else
        {
            $rs = SelectNotcia();
        }
        return $rs;
    }

    function selectNoticiaById($id)
    {
        return NoticiaByID($id);
    }
    
?>