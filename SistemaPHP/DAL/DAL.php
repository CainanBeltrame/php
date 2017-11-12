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
                $_SESSION['ID'] = $row['Id'];
                $_SESSION['NOME'] = $row['Nome'];
                $_SESSION['PRIVILEGIO'] = $row['TipoUser_id'];
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
        if($rsManga = mysqli_query($con,"SELECT COUNT(*) FROM mangas WHERE Usuario_Id = ".$iduser))
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
        if($rsnoticia = mysqli_query($con,"SELECT COUNT(*) FROM noticias WHERE Usuario_Id = ".$iduser))
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
        
        if($rs = mysqli_query($con,"SELECT * FROM mangas INNER JOIN estoque ON mangas.Estoque_id = Estoque.id AND `Usuario_Id` =".$iduser))
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
        $sql = "SELECT * FROM mangas INNER JOIN estoque ON mangas.Estoque_id = estoque.id AND `Usuario_Id` = $iduser ORDER BY ASC LIMIT $inicio, $qtd";
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
        
            if($rs = mysqli_query($con, "SELECT * FROM mangas INNER JOIN imagensmangas on imagensmangas.Mangas_id = mangas.id INNER JOIN estoque on mangas.Estoque_id = estoque.id AND mangas.id = ".$idManga))
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
            if($rs = mysqli_query($con, "DELETE mangas,estoque,imagensmangas from mangas INNER JOIN estoque ON mangas.Estoque_id = estoque.id INNER JOIN imagensmangas on 
            imagensmangas.Mangas_id = mangas.id WHERE mangas.id = ".$id))
            {
                $r = 1;
            }
        close_conexao($con);
        return $r;
    }
    function SelectMangas()
    {
        $con = open_conexao();
            if($rs = mysqli_query($con, "SELECT * FROM mangas INNER JOIN estoque ON mangas.Estoque_id = estoque.id ORDER BY mangas.Nome"))
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
        $sql = "SELECT * FROM mangas INNER JOIN estoque ON mangas.Estoque_id = estoque.id ORDER BY mangas.Nome LIMIT $inicio, $qtd";
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
        $sqlEst = "INSERT INTO `estoque`(`Qtd`) VALUES ($qManga)";
        if(mysqli_query($con,$sqlEst))
        {
            //Pega IDEstpque
            $sqlIDE = "SELECT MAX(id) FROM estoque";
            if($rsIDE = mysqli_query($con,$sqlIDE))
            {
                if($rowIDE = mysqli_fetch_array($rsIDE))
                {
                    $idEstoq = $rowIDE['MAX(id)'];
                    
                    //InsereManga
                    $sqlManga = "INSERT INTO `mangas`(`Nome`, `Descricao`, `Sinopse`, `ValorUnit`, `Usuario_Id`, `Estoque_id`) VALUES ('$nManga','$dManga','$sManga','$pManga','$idUser','$idEstoq')";
                    if(mysqli_query($con,$sqlManga))
                    {
                        //Pega IDMangá
                        $sqlIDM = "SELECT MAX(id) FROM mangas";
                        if($rsIDM = mysqli_query($con,$sqlIDM))
                        {
                            if($rowIDM = mysqli_fetch_array($rsIDM))
                            {
                                $idManga = $rowIDM['MAX(id)'];

                                //Inserir Imagem/
                                $sqlImg = "INSERT INTO `imagensmangas`(`Imagem`, `Mangas_id`) VALUES ('$iManga','$idManga')";
                                
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

    function selectNoticiabyName($titulo)
    {
        $con = open_conexao();
        $sql = "SELECT COUNT(*) FROM noticias WHERE Titulo = '$titulo'";
        if($rs = mysqli_query($con,$sql))
        {
            if($row = mysqli_fetch_array($rs))
            {
                return $noticias = $row['COUNT(*)']; 
            }
        }
        close_conexao($con);
    }

    function UpdateManga($idManga,$nameManga,$desManga,$sinopManga,$precoManga,$qtdManga,$imgManga)
    {
        $con = open_conexao();

        $sqlUP = "UPDATE mangas INNER JOIN estoque ON mangas.Estoque_id = estoque.id INNER JOIN imagensmangas ON imagensmangas.Mangas_id = mangas.id SET mangas.Nome = '$nameManga', mangas.Descricao = '$desManga', mangas.Sinopse = '$sinopManga', mangas.ValorUnit = $precoManga, estoque.Qtd = $qtdManga, imagensmangas.Imagem = '$imgManga' WHERE mangas.id = $idManga";
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
    
    function UpdateNoticia($idNoticia, $tituloN, $descBN, $DescCN, $data, $imagemN)
    {
        $con = open_conexao();
        $sql = "UPDATE noticias INNER JOIN imagensnoticias ON imagensnoticias.Noticias_id = noticias.id SET noticias.Titulo = '$tituloN', noticias.DescricaoBreve = '$descBN', noticias.Descricao = '$DescCN', noticias.Data = '$data', imagensnoticias.Imagem = '$imagemN' WHERE noticias.id = $idNoticia";
        if($rs = mysqli_query($con, $sql))
        {
            $msg = "Dados Atualizados com Sucesso!";
        }
        else
        {
            $msg = "Falha na atualização de Dados!";
        }
        close_conexao($con);
        return $msg;
    }
    
    function SelectNotcia()
    {
        $con = open_conexao();
        
        $sql = "SELECT * FROM noticias INNER JOIN imagensnoticias ON imagensnoticias.Noticias_id = noticias.id ORDER BY noticias.Data DESC";
        
        if($rs = mysqli_query($con, $sql))
        {
            return $rs;
        }
        
        close_conexao($con);
    }
    function SelectNotciaLimt($inicio, $qtd)
    {
        $con = open_conexao();
        $sql = "SELECT * FROM noticias INNER JOIN imagensnoticias ON imagensnoticias.Noticias_id = noticias.id ORDER BY noticias.Data DESC LIMIT $inicio, $qtd";

        
        if($rs = mysqli_query($con, $sql))
        {
            return $rs;
        }
        close_conexao($con);
    }
    function NoticiaByID($idN)
    {
        $con = open_conexao();
        $sql = "SELECT * FROM noticias INNER JOIN imagensnoticias on imagensnoticias.Noticias_id = noticias.id AND noticias.id =".$idN;
        if($rs = mysqli_query($con,$sql))
        {
            return $rs;
        }
        close_conexao($con);
    }

    function RelatorioDAL($desc,$data,$relat)
    {
        $con = open_conexao();
        
        $sql = "INSERT INTO `relatorios`(`Descricao`, `Data`, `TiposRelatorios_id`) VALUES ('$desc',$data,$relat)";
        $rs = mysqli_query($con,$sql);
        return $rs;
        
        close_conexao($con);
    }

    function addNoticia( $titulo, $descricaoBreve, $descricao, $data, $imgNoticia, $idUser)
    {
        $con = open_conexao();

        //insere noticias
        $sql = "INSERT INTO `noticias`( `Titulo`, `DescricaoBreve`, `Descricao`, `Data`, `Usuario_Id`) VALUES ('$titulo','$descricaoBreve','$descricao','$data',$idUser)";
        if(mysqli_query($con,$sql))
        {
            $sqlIDN = "SELECT MAX(id) FROM noticias";
            if($rsIDN = mysqli_query($con,$sqlIDN))
            {
                if($rowIDN = mysqli_fetch_array($rsIDN))
                {
                    $idNot = $rowIDN['MAX(id)'];

                    $sqlIMGNOT = "INSERT INTO `imagensnoticias`(`Imagem`, `Noticias_id`) VALUES ('$imgNoticia',$idNot)";
                    if(mysqli_query($con,$sqlIMGNOT))
                    {
                        $msg = "noticia Adicionado com sucesso";
                    }
                    else
                    {
                        $msg = "Erro ao adicionar noticia - falha inserir imagem";
                    }
                }
                else
                {
                    $msg = "Erro ao adicionar noticia - falha receber informacao noticia";
                }
            }
            else
            {
                $msg = "Erro ao adicionar noticia - falha consulta";
            }
        }
        else
        {
            $msg = "Erro ao adicionar noticia - falha inserir noticia";
        }

        close_conexao($con);
        return $msg;
    }
?>
