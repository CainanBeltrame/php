<?php
    session_start();
    require_once "Conexao.php";
    
    function Login($user, $pass)
    {
        $con = open_conexao();

        $nick = sha1($user);
        $senha = sha1($pass);
        if($rs = mysqli_query($con, "SELECT * FROM `usuario` WHERE `Nick` = '$nick' and `Senha` =  '$senha';"))
        {
            if($row = mysqli_fetch_array($rs))
            {  
                $_SESSION['ID'] = $row['ID'];
                $_SESSION['NOME'] = $row['Nome'];
                $_SESSION['PRIVILEGIO'] = $row['Privilegio_ID'];
                $logV = 1;
            }
            else
            {
                $logV = 0;
            }
            
        }
        else
        {
            $logV = 0;
        }
        return $logV;
        close_conexao($con);
    }

    function LogOut()
    {
        unset($_SESSION['ID']);
        unset($_SESSION['PRIVILEGIO']);
    }

    function totalpostsManga($iduser)
    {
        $con = open_conexao();
        if($rsManga = mysqli_query($con,"SELECT COUNT(*) FROM mangas WHERE Usuario_ID = ".$iduser))
        {
            if($rowManga = mysqli_fetch_array($rsManga))
            {
                $cManga = $rowManga['COUNT(*)'];
            }
        }
        close_conexao($con);
        return $cManga;
    }

    function totalpostsNoticia($iduser)
    {
        $con = open_conexao();
        if($rsnoticia = mysqli_query($con,"SELECT COUNT(*) FROM noticias WHERE Usuario_ID = ".$iduser))
        {
            if($rowNoticia = mysqli_fetch_array($rsnoticia))
            {
                $cNoticia = $rowNoticia['COUNT(*)'];
            }
        }
        close_conexao($con);
        return $cNoticia;

    }

    function  SelectMangasbyUser($iduser)
    {
        $con = open_conexao();
        
        if($rs = mysqli_query($con,"SELECT * FROM mangas INNER JOIN estoque ON mangas.Estoque_ID = estoque.ID AND `Usuario_ID` =".$iduser))
        {
            return $rs;
        }
        else
        {
            return 0;
        }
        
        close_conexao($con);
    }
    function selectMangasByUserLimit($idM ,$inicio, $qtd)
    {
        $con = open_conexao();
        $sql = "SELECT * FROM mangas INNER JOIN estoque ON mangas.Estoque_ID = estoque.ID AND `Usuario_ID` = $iduser ORDER BY ASC LIMIT $inicio, $qtd";
        if($rs = mysqli_query($con,$sql))
        {
            return $rs;
        }
        else
        {
            return 0;
        }
        close_conexao($con);
    }
    
    function SelectMangabyID($idManga)
    {
        $con = open_conexao();
        
            if($rs = mysqli_query($con, "SELECT * FROM mangas INNER JOIN img_manga on img_manga.Manga_ID = mangas.ID INNER JOIN estoque on mangas.Estoque_ID = estoque.ID AND mangas.ID = ".$idManga))
            {
                return $rs;
            }
            else
            {
                return 0;
            }
        close_conexao($con);
    }

    function DeleteManga($id)
    {
        $r = 0;
        $con = open_conexao();
            if($rs = mysqli_query($con, "DELETE mangas, estoque, img_manga FROM mangas INNER JOIN img_manga on img_manga.Manga_ID = mangas.ID INNER JOIN estoque on mangas.Estoque_ID = estoque.ID AND mangas.ID = ".$id))
            {
                $r = 1;
            }
        close_conexao($con);
        return $r;
    }
    function SelectMangas()
    {
        $con = open_conexao();
            if($rs = mysqli_query($con, "SELECT * FROM mangas INNER JOIN estoque ON mangas.Estoque_ID = estoque.ID ORDER BY mangas.Nome"))
            {
                return $rs;
            }
            else
            {
                return 0;
            }
        close_conexao($con);
    }
    function SelectMangasLimt($inicio, $qtd)
    {
        $con = open_conexao();
        $sql = "SELECT * FROM mangas INNER JOIN estoque ON mangas.Estoque_ID = estoque.ID ORDER BY mangas.Nome LIMIT $inicio, $qtd";
        if($rs = mysqli_query($con,$sql))
        {
            return $rs;
        }
        else
        {
            return 0;
        }
        close_conexao($con);
    }

    function AddManga($idUser,$nManga,$dManga,$sManga,$pManga,$qManga,$iManga)
    {
        $con = open_conexao();
        //Insere Estoque
        $sqlEst = "INSERT INTO `estoque`(`Quantidade`) VALUES ('$qManga')";
        if(mysqli_query($con,$sqlEst))
        {
            //Pega IDEstpque
            $sqlIDE = "SELECT MAX(ID) FROM estoque";
            if($rsIDE = mysqli_query($con,$sqlIDE))
            {
                if($rowIDE = mysqli_fetch_array($rsIDE))
                {
                    $idEstoq = $rowIDE['MAX(ID)'];
                    
                    //InsereManga
                    $sqlManga = "INSERT INTO `mangas`(`Nome`, `Descricao`, `Sinopse`, `Preco`, `Usuario_ID`, `Estoque_ID`) VALUES ('$nManga','$dManga','$sManga','$pManga','$idUser','$idEstoq')";
                    if(mysqli_query($con,$sqlManga))
                    {
                        //Pega IDMangá
                        $sqlIDM = "SELECT MAX(ID) FROM mangas";
                        if($rsIDM = mysqli_query($con,$sqlIDM))
                        {
                            if($rowIDM = mysqli_fetch_array($rsIDM))
                            {
                                $idManga = $rowIDM['MAX(ID)'];

                                //Inserir Imagem/Inserir Gênero
                                $sqlImg = "INSERT INTO `img_manga`(`Imagem`, `Manga_ID`) VALUES ('$iManga','$idManga')";
                                
                                if(mysqli_query($con,$sqlImg))
                                {
                                    $msg = "Dados Inseridos com sucesso";
                                }
                                else
                                {
                                    $msg = "Falha ao inserir dados - Falha IMAGEM";
                                }

                            }
                            else
                            {
                                $msg = "Falha ao inserir dados - Falha ID MANGÁ";
                            }
                        }
                        else 
                        {
                            $msg = "Falha ao inserir dados - Falha CONSULTA ID MANGÁ";
                        }
                    }
                    else 
                    {
                        $msg = "Falha ao inserir dados - Falha INSERIR MANGÁ";
                    }
                }
                else 
                {
                    $msg = "Falha ao inserir dados - Falha ID ESTOQUE";
                }
            }
            else 
            {
                $msg = "Falha ao inserir dados - Falha CONSULTA ID ESTOQUE";               
            }
        }
        else 
        {
            $msg = "Falha ao inserir dados - Falha inserir estoque";
        }
        
        close_conexao($con);
        return $msg;
    }
    function selectMangabyName($name)
    {
        $con = open_conexao();
            if($rs = mysqli_query($con, "SELECT COUNT(*) FROM mangas WHERE Nome = '$name'"))
            {
                if($row = mysqli_fetch_array($rs))
                {
                    return $manga = $row['COUNT(*)']; 
                }
            }
        close_conexao($con);
    }

    function UpdateManga($idManga,$nameManga,$desManga,$sinopManga,$precoManga,$qtdManga,$imgManga)
    {
        $con = open_conexao();

        $sqlUP = "UPDATE mangas INNER JOIN estoque ON mangas.Estoque_ID = estoque.ID INNER JOIN img_manga ON img_manga.Manga_ID = mangas.ID SET mangas.Nome = '$nameManga', mangas.Descricao = '$desManga', mangas.Sinopse = '$sinopManga', mangas.Preco = $precoManga, estoque.Quantidade = $qtdManga, img_manga.Imagem = '$imgManga' WHERE mangas.ID = $idManga";
        if($rs = mysqli_query($con, $sqlUP))
        {
            $msg = "Dados Atualizados com sucesso";
        }
        else
        {
            $msg = "Falha ao atualizar dados!";
        }
        close_conexao($con);
        return $msg;
    }
    function InsereRelatorioAadm($idUser,$desc,$data)
    {
        $con = open_conexao();
        $sql = "INSERT INTO `relatorioadm`(`UserID`, `Dercricao`, `Data`) VALUES ($idUser,'$desc','$data')";
        mysqli_query($con,$sql);
        close_conexao($con);
    }
    function ListaRelatorioAdmLimit($inicio,$quantidade)
    {
        $con = open_conexao();
        $sql = "SELECT * FROM relatorioadm ORDER BY Data DESC LIMIT $inicio, $quantidade";
        if($rs = mysqli_query($con, $sql))
        {
            return $rs;
        }
        else
        {
            return 0;
        }
        close_conexao($con);
    }
    function ListaRelatorioAdm()
    {
        $con = open_conexao();
        $sql = "SELECT * FROM relatorioadm ORDER BY Data DESC";
        if($rs = mysqli_query($con, $sql))
        {
            return $rs;
        }
        else
        {
            return 0;
        }
        close_conexao($con);
    }

    function SelectNotcia()
    {
        $con = open_conexao();
        
        $sql = "SELECT * FROM noticias INNER JOIN imagem_noticias ON imagem_noticias.Noticia_ID = noticias.ID ORDER BY noticias.Data DESC";
        
        if($rs = mysqli_query($con, $sql))
        {
            return $rs;
        }
        
        close_conexao($con);
    }
    function SelectNotciaLimt($inicio, $qtd)
    {
        $con = open_conexao();
        $sql = "SELECT * FROM noticias INNER JOIN imagem_noticias ON imagem_noticias.Noticia_ID = noticias.ID ORDER BY noticias.Data DESC LIMIT $inicio, $qtd";
        
        if($rs = mysqli_query($con, $sql))
        {
            return $rs;
        }
        close_conexao($con);
    }
?>



