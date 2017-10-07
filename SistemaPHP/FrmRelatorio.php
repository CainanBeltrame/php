<?PHP
    include_once "BLL/BLL_Administrativa.php";
    if(empty($_SESSION['ID'])||$_SESSION['PRIVILEGIO'] != 1)
    {
         header('location:Home.php');
    }
    else
    {
        $relatorio = $_GET['typeRela'];

        if($relatorio == 1)
        {
            $quantidade = 10;
            $pagina = intval($_GET['pagina']);
            $inicio = ($quantidade * $pagina) - $quantidade;

            $rs = selectRelatorio($inicio, $quantidade, 1);
            $num = mysqli_num_rows($rs);

            $rsnLimit = selectRelatorio($inicio, $quantidade, 0);
            $num_Total = mysqli_num_rows($rsnLimit);

            $numPagina = ceil($num_Total/$quantidade);
            $i = 1;
?>  

        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">

                <title>Relatório Administradores</title>

                <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
                <script src="bootstrap/js/ajax/jquery.min.js"></script>
                <script src="bootstrap/js/bootstrap.min.js"></script>
            </head>

            <body>
                <!--NavBar/DropDown-->
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="Administrativa.php">Administrativa</a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav">
                                
                                <li role="presentation" id = "dropMangá">
                                    <a href="Listas.php?type=3&pagina=1" role="button" aria-haspopup="true" aria-expanded="false">
                                        Mangás
                                    </a>
                                </li>

                                <li role="presentation" id = "dropNoticiass">
                                    <a href="Listas.php?type=4&pagina=1" role="button" aria-haspopup="true" aria-expanded="false">
                                        Notícias
                                    </a>
                                </li>

                                <li class="dropdown" id = "dropRelatorios">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        Relatórios 
                                        <span class="caret"></span>
                                    </a>
                                    <ul class = "dropdown-menu">
                                        <li><a href="FrmRelatorio.php?typeRela=1&pagina=1">relatorios Administradores</a></li>
                                        <li><a href="FrmRelatorio.php?typeRela=2&pagina=1">relatorios Usuário</a></li>
                                        <li><a href="FrmRelatorio.php?typeRela=3&pagina=1">relatorios Mangás</a></li>
                                    </ul>
                                </li>

                            </ul>

                            <ul class = "nav navbar-nav navbar-right">
                                <li role="presentation">
                                    <a href = "Home.php">
                                        Área Publica
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav><!--NAVBAR/DROPDOWN-->


                <div id = "titulo" class = "col-md-6 col-md-offset-4">
                   <h1>RELATÓRIO ADMINISTRADORES</h1>
                </div>
                <div class = "col-md-12">
                    <hr>
                </div>

                <div id = "Table" class = "col-md-12">
                    <div class = "col-md-offset-1">
                        <div class = "table-hover col-md-12">
<?PHP                   if($num > 0){?>        
                            <table class = "table table-bordered">
                                <tr class="active">
                                    <td>Ação</td>
                                    <td>Data</td>
                                </tr>
<?PHP                           while($rowadm = mysqli_fetch_array($rs)) {
                                    if(strpos($rowadm['Dercricao'],"Adicionou"))
                                    {?>
                                        <tr class="success">
                                            <td><?PHP echo $rowadm['Dercricao'];?></td>
                                            <td><?PHP echo date("d/m/Y",strtotime($rowadm['Data']));?></td>
                                        </tr>  
<?PHP                               }
                                    else
                                    {
                                        if(strpos($rowadm['Dercricao'],"Excluiu"))
                                        {?>
                                            <tr class="danger">
                                                <td><?PHP echo $rowadm['Dercricao'];?></td>
                                                <td><?PHP echo date("d/m/Y",strtotime($rowadm['Data']));?></td>
                                            </tr>  
<?PHP                                   }
                                        else
                                        {
                                            if(strpos($rowadm['Dercricao'],"Editou"))
                                            {?>
                                                <tr class="warning">
                                                    <td><?PHP echo $rowadm['Dercricao'];?></td>
                                                    <td><?PHP echo date("d/m/Y",strtotime($rowadm['Data']));?></td>
                                                </tr>     
<?PHP                                       }
                                            else
                                            {?>
                                                <tr class="info">
                                                <td><?PHP echo $rowadm['Dercricao'];?></td>
                                                <td><?PHP echo date("d/m/Y",strtotime($rowadm['Data']));?></td>
                                            </tr>  
<?PHP                                       }
                                        }
                                    }
                                }?>                            
                            </table>

                            <div class = "col-md-offset-4">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <li>
                                            <a href="FrmRelatorio.php?typeRela=1&pagina=1" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <?PHP while($i <= $numPagina)
                                        {?>
                                            <li><a href="FrmRelatorio.php?typeRela=1&pagina=<?PHP ECHO $i;?>"><?PHP ECHO $i;?></a></li>
                                        <?PHP $i++;
                                        }?>
                                        <li>
                                            <a href="FrmRelatorio.php?typeRela=1&pagina=<?PHP ECHO $numPagina;?>" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
<?PHP                   }
                        else
                        {?>
                            <div class = "col-md-offset-4">
                                <h2>Sem Registro no Servidor</h2>
                            </div>
                        <?PHP } ?>             
                        </div>          
                    </div>
                </div>
            </body>
        </html>

<?PHP   }
        else
        {
            if($relatorio == 2)
            {?>

<?PHP       }
            else
            {
                if($relatorio == 3)
                {?>

<?PHP                }
                else
                {
                    echo "<script>history.go(-1)</script>";
                }
            }
        }
    }
?>