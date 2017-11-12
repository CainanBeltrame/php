<?PHP
    include_once "BLL/BLL_Administrativa.php";
    $TypeList = $_GET['type'];
    $_SESSION['tipoList'] = $TypeList;
    if(empty($_SESSION['ID'])||$_SESSION['PRIVILEGIO'] != 1)
    {
         header('location:Home.php');
    }
    else
    {
        //MANGÁS DO USUARIO LSTADOS
        if($TypeList == 1)
        {
            $quantidade = 10;
            $pagina = intval($_GET['pagina']);
            $inicio = ($quantidade * $pagina) - $quantidade;

            $rs = SelectMangasbyUser($_SESSION['ID'],$inicio,$quantidade, 1);
            $num = mysqli_num_rows($rs);

            $rsNlimt = SelectMangasbyUser($_SESSION['ID'],$inicio,$quantidade, 0);
            $num_total = mysqli_num_rows($rsNlimt);

            $numPagina = ceil($num_total/$quantidade);
            $i = 1;
?>


       <!DOCTYPE html>
        <html lang="pt_br">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">

                <title>Seus Mangás</title>

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
                                        <li><a href="FrmRelatorio.php?typeRela=2">relatorios Usuário</a></li>
                                        <li><a href="FrmRelatorio.php?typeRela=3">relatorios Mangás</a></li>
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


                <div id = "conteudo">
                    <div class = "col-md-12">
                        <div id = "ajuste" class = "col-md-offset-1">
                            <h1>Seus Mangás Postados!</h1>
                        </div>
                        <div class = "col-md-offset-1">
                            <div class="table-hover col-md12">
<?PHP if($num > 0){?>
                                <table class = "table table-bordered">
                                    <tr class = "active">
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th>Preço</th>
                                        <th>Quantidade</th>
                                        <th></th>
                                        <th></th>
                                        
                                    </tr>
<?PHP                               while($row = mysqli_fetch_array($rs)) { 
                                    if($row['Qtd'] <= 5)
                                    {?>
                                        <tr class="danger">
                                        <td><?PHP echo $row['id'];?></td>
                                        <td><?PHP echo $row['Nome'];?></td>
                                        <td><?PHP echo $row['Descricao'];?></td>
                                        <td>R$ <?PHP echo $row['ValorUnit'];?></td>
                                        <td><?PHP echo $row['Qtd'];?></td>
                                        <td>
                                            <button class="btn btn-warning" onclick="javascript: location.href='FrmEditManga.php?tipo=1&id=' +
                                <?php echo $row['id'] ?>">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span> 
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" onclick = "javascript: location.href='FrmEditManga.php?tipo=2&id=' +
                                <?php echo $row['id'] ?>"> 
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button>
                                        </td>
                                        </tr>
<?PHP                               }
                                    else
                                    {
                                        if($row['Qtd'] <= 15)
                                        {?>
                                            <tr class="warning">
                                            <td><?PHP echo $row['id'];?></td>
                                            <td><?PHP echo $row['Nome'];?></td>
                                            <td><?PHP echo $row['Descricao'];?></td>
                                            <td>R$ <?PHP echo $row['ValorUnit'];?></td>
                                            <td><?PHP echo $row['Qtd'];?></td>
                                            <td>
                                                <button class="btn btn-warning" onclick="javascript: location.href='FrmEditManga.php?tipo=1&id=' +
                                    <?php echo $row['id'] ?>">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span> 
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger" onclick = "javascript: location.href='FrmEditManga.php?tipo=2&id=' +
                                    <?php echo $row['id'] ?>"> 
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button>
                                            </td>
                                            </tr>
    <?PHP                               }
                                        else
                                        {?>
                                            <tr class="success">
                                            <td><?PHP echo $row['id'];?></td>
                                            <td><?PHP echo $row['Nome'];?></td>
                                            <td><?PHP echo $row['Descricao'];?></td>
                                            <td>R$ <?PHP echo $row['ValorUnit'];?></td>
                                            <td><?PHP echo $row['Qtd'];?></td>
                                            <td>
                                                <button class="btn btn-warning" onclick="javascript: location.href='FrmEditManga.php?tipo=1&id=' +
                                    <?php echo $row['id'] ?>">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span> 
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger" onclick = "javascript: location.href='FrmEditManga.php?tipo=2&id=' +
                                    <?php echo $row['id'] ?>"> 
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button>
                                            </td>
                                            </tr>
<?PHP                                        }
                                    }   
                       }?>
                                </table>
                                
                                <div class = "col-md-offset-4">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            <li>
                                                <a href="Listas.php?type=1&pagina=1" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <?PHP while($i <= $numPagina)
                                            {?>
                                                <li><a href="Listas.php?type=1&pagina=<?PHP ECHO $i;?>"><?PHP ECHO $i;?></a></li>
                                            <?PHP $i++;
                                            }?>
                                            <li>
                                                <a href="Listas.php?type=1&pagina=<?PHP ECHO $numPagina;?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
<?PHP }
    else
    {?>
                                <div class = "col-md-offset-4">
                                    <h2>Sem Registro no Servidor</h2>
                                </div>
<?PHP    } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div id = "fades">
                    <div ID = "FadeAviso" class = "modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class = "col-xs-15">
                                    <div class = "modal-header">
                                        <button type= "button" class = "close" data-dismiss = "modal" arial-labe = "close"><span aria-hidden = "true">&times;</span></button>
                                        <center><h4 class = "modal-title">ATENÇÃO</h4></center>
                                    </div>
                                    <div class = "modal-body">
                                        <label for="logour" class="control-label"><?PHP echo $_SESSION['MsgAviso'];?> </label>
                                        <button type="button" class="btn btn-success btn-block" data-dismiss = "modal">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--WARNINGFADE-->
                </div>
            </body>
<?PHP
if(!(empty($_SESSION['aviso'])))
{
    $Aviso = $_SESSION['aviso'];
    if($Aviso == 1)
        {
            unset($_SESSION['aviso']);
            unset($_SESSION['MsgAviso']);
?>
            <script>
                $(function(){
                $('#FadeAviso').modal('show');
                });
            </script>
<?php         
        }
}
?>
            





        </html>     


<?PHP
    }  
    else
    {
        if($TypeList == 2)
        {
?>
            
<?PHP        }
        else
        {
            //TODOS MANGÁS LISTADOS
            if($TypeList == 3)
            {
                $quantidade = 10;
                $pagina = intval($_GET['pagina']);
                $inicio = ($quantidade * $pagina) - $quantidade;

                $rs = seleManga($inicio, $quantidade, 1);
                $num = mysqli_num_rows($rs);

                $rsNlimt = seleManga($inicio, $quantidade, 0);
                $num_total = mysqli_num_rows($rsNlimt);

                $numPagina = ceil($num_total/$quantidade);
                $i = 1;
?>
               <!DOCTYPE html>
                <html lang="pt_br">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta http-equiv="X-UA-Compatible" content="ie=edge">

                        <title>Lista de Mangá</title>

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
                                                <li><a href="FrmRelatorio.php?typeRela=2">relatorios Usuário</a></li>
                                                <li><a href="FrmRelatorio.php?typeRela=3">relatorios Mangás</a></li>
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


                        <div id = "conteudo">
                            <div class = "col-md-12">
                                <div id = "ajuste" class = "col-md-offset-1">
                                    <h1>Mangás Postados!</h1>
                                </div>
                                <div class = "col-md-offset-1">
                                    <div class="table-hover col-md-12">
<?PHP if($num > 0){ ?>
                                        <table class = "table table-bordered">
                                            <tr class = "active">
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Descrição</th>
                                                <th>Preço</th>
                                                <th>Quantidade</th>
                                                <th></th>
                                                <th></th>
                                                <th>
                                                    <button type = "button" class="btn btn-success" onclick = "javascript: location.href='FrmAdiciona.php?type=1'">
                                                        <span class = "glyphicon glyphicon-plus" aria-hidden="true"></span>
                                                    </button>
                                                </th>
                                            </tr>
        <?PHP                               while($row = mysqli_fetch_array($rs)) {   
                                                if($row['Qtd'] <= 5)
                                                {?>
                                                    <tr class="danger">
                                                    <td><?PHP echo $row['id'];?></td>
                                                    <td><?PHP echo $row['Nome'];?></td>
                                                    <td><?PHP echo $row['Descricao'];?></td>
                                                    <td>R$ <?PHP echo $row['ValorUnit'];?></td>
                                                    <td><?PHP echo $row['Qtd'];?></td>
                                                    <td>
                                                        <button class="btn btn-warning" onclick="javascript: location.href='FrmEditManga.php?tipo=1&id=' +
                                            <?php echo $row['id'] ?>">
                                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span> 
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger" onclick = "javascript: location.href='FrmEditManga.php?tipo=2&id=' +
                                            <?php echo $row['id'] ?>"> 
                                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button>
                                                    </td>
                                                    <TD></TD>
                                                    </tr>
                                    <?PHP                               }
                                                else
                                                {
                                                    if($row['Qtd'] <= 15)
                                                    {?>
                                                        <tr class="warning">
                                                        <td><?PHP echo $row['id'];?></td>
                                                        <td><?PHP echo $row['Nome'];?></td>
                                                        <td><?PHP echo $row['Descricao'];?></td>
                                                        <td>R$ <?PHP echo $row['ValorUnit'];?></td>
                                                        <td><?PHP echo $row['Qtd'];?></td>
                                                        <td>
                                                            <button class="btn btn-warning" onclick="javascript: location.href='FrmEditManga.php?tipo=1&id=' +
                                                <?php echo $row['id'] ?>">
                                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span> 
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger" onclick = "javascript: location.href='FrmEditManga.php?tipo=2&id=' +
                                                <?php echo $row['id'] ?>"> 
                                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button>
                                                        </td>
                                                        <td></td>
                                                        </tr>
                                    <?PHP                               }
                                                    else
                                                    {?>
                                                        <tr class="success">
                                                        <td><?PHP echo $row['id'];?></td>
                                                        <td><?PHP echo $row['Nome'];?></td>
                                                        <td><?PHP echo $row['Descricao'];?></td>
                                                        <td>R$ <?PHP echo $row['ValorUnit'];?></td>
                                                        <td><?PHP echo $row['Qtd'];?></td>
                                                        <td>
                                                            <button class="btn btn-warning" onclick="javascript: location.href='FrmEditManga.php?tipo=1&id=' +
                                                <?php echo $row['id'] ?>">
                                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span> 
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger" onclick = "javascript: location.href='FrmEditManga.php?tipo=2&id=' +
                                                <?php echo $row['id'] ?>"> 
                                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button>
                                                        </td>
                                                        <td></td>
                                                        </tr>
                                    <?PHP                                        }
                                        }
                                    }?>
                                        </table>

                                        <div class = "col-md-offset-4">
                                            <nav aria-label="Page navigation">
                                                <ul class="pagination">
                                                    <li>
                                                        <a href="Listas.php?type=3&pagina=1" aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                        </a>
                                                    </li>
                                                    <?PHP while($i <= $numPagina)
                                                    {?>
                                                        <li><a href="Listas.php?type=3&pagina=<?PHP ECHO $i;?>"><?PHP ECHO $i;?></a></li>
                                                    <?PHP $i++;
                                                    }?>
                                                    <li>
                                                        <a href="Listas.php?type=3&pagina=<?PHP ECHO $numPagina;?>" aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
<?PHP   }
        else
        {?>
                            <div class = "col-md-offset-4">
                                <h2>Sem Registro no Servidor</h2>
                                <button type = "button" class="btn btn-success" onclick = "javascript: location.href='FrmAdiciona.php?type=1'">
                                    <span class = "glyphicon glyphicon-plus" aria-hidden="true">Adicionar Mangá</span>
                                </button>

                            </div>
<?PHP   } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </body>

                    <div id = "fades">
                        <div ID = "FadeAviso" class = "modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class = "col-xs-15">
                                        <div class = "modal-header">
                                            <button type= "button" class = "close" data-dismiss = "modal" arial-labe = "close"><span aria-hidden = "true">&times;</span></button>
                                            <center><h4 class = "modal-title">ATENÇÃO</h4></center>
                                        </div>
                                        <div class = "modal-body">
                                            <label for="logour" class="control-label"><?PHP echo $_SESSION['MsgAviso'];?> </label>
                                            <button type="button" class="btn btn-success btn-block" data-dismiss = "modal">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--WARNINGFADE-->
                    </div>
                </body>
<?PHP
if(!(empty($_SESSION['aviso'])))
{
    $Aviso = $_SESSION['aviso'];
    if($Aviso == 1)
        {
            unset($_SESSION['aviso']);
            unset($_SESSION['MsgAviso']);
?>
            <script>
                $(function(){
                $('#FadeAviso').modal('show');
                });
            </script>
<?php         
        }
}
?>
            





        </html>     
<?PHP            }
            else
            {
                if($TypeList == 4)
                {
                    $quantidade = 10;
                    $pagina = intval($_GET['pagina']);
                    $inicio = ($quantidade * $pagina) - $quantidade;
                    $num = 0;
                    if($rs = selecNoticia($inicio, $quantidade, 1)){$num = mysqli_num_rows($rs);}
                    

                    if($rsNlimt = selecNoticia($inicio, $quantidade, 0)){
                        $num_total = mysqli_num_rows($rsNlimt);
                        $numPagina = ceil($num_total/$quantidade);
                        $i = 1;}
                   
?>               
                    <!DOCTYPE html>
                    <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <meta http-equiv="X-UA-Compatible" content="ie=edge">
                            
                            <title>Lista de Notícias</title>
                            
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
                                                    <li><a href="FrmRelatorio.php?typeRela=2">relatorios Usuário</a></li>
                                                    <li><a href="FrmRelatorio.php?typeRela=3">relatorios Mangás</a></li>
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

                            <div id = "conteudo">
                                <div class = "col-md-12">
                                    <div id "titulo" class = "col-md-offset-1">
                                        <h1>Notícias Postadas</h1>
                                    </div>
                                    <div class = "col-md-offset-1">
                                        <div class = "table-hover col-md-12">
<?PHP   if($num > 0){?>
                                            <table class = "table table-bordered">
                                                <tr class = "active">
                                                    <th>ID</th>
                                                    <th>Titulo</th>
                                                    <th>Descrição Breve</th>
                                                    <th>Data</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>
                                                        <button type = "button" class="btn btn-success" onclick = "javascript: location.href='FrmAdiciona.php?type=2'">
                                                            <span class = "glyphicon glyphicon-plus" aria-hidden="true"></span>
                                                        </button>
                                                    </th>
                                                </tr>
<?PHP while($row = mysqli_fetch_array($rs))
{?>
                                            <tr>
                                                <td><?PHP ECHO $row['id'];?></td>
                                                <td><?PHP ECHO $row['Titulo'];?></td>
                                                <td><?PHP ECHO $row['DescricaoBreve'];?></td>
                                                <td><?PHP ECHO $row['Data'];?></td>
                                                <td>
                                                    <button class="btn btn-warning" onclick="javascript:location.href='FrmEditNoticia.php?tipo=1&id=' + <?PHP ECHO $row['id']?>">
                                                        <span class="glyphicon glyphicon-pencil" arial-hidden="true"></span>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger" onclick="javascript:location.href='FrmEditNoticia.php?tipo=2&id=' + <?PHP ECHO $row['id']?>">
                                                        <span class="glyphicon glyphicon-remove" arial-hidden="true"></span>
                                                    </button>
                                                </td>
                                            </tr>
<?PHP   }?>
                                            </table>

                                            <div class = "col-md-offset-4">
                                                <nav aria-label="Page navigation">
                                                    <ul class="pagination">
                                                        <li>
                                                            <a href="Listas.php?type=3&pagina=1" aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>
                                                        <?PHP while($i <= $numPagina)
                                                        {?>
                                                            <li><a href="Listas.php?type=3&pagina=<?PHP ECHO $i;?>"><?PHP ECHO $i;?></a></li>
                                                        <?PHP $i++;
                                                        }?>
                                                        <li>
                                                            <a href="Listas.php?type=3&pagina=<?PHP ECHO $numPagina;?>" aria-label="Next">
                                                                <span aria-hidden="true">&raquo;</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
<?PHP   }
        else
        {?>
                                            <div class = "col-md-offset-4">
                                                <h2>Sem Registro no Servidor</h2>
                                                <button type = "button" class="btn btn-success" onclick = "javascript: location.href='FrmAdiciona.php?type=2'">
                                                    <span class = "glyphicon glyphicon-plus" aria-hidden="true">Adicionar Noticia</span>
                                                </button>
                                            </div>
<?PHP   }?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id = "fades">
                                <div ID = "FadeAviso" class = "modal fade" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class = "col-xs-15">
                                                <div class = "modal-header">
                                                    <button type= "button" class = "close" data-dismiss = "modal" arial-labe = "close"><span aria-hidden = "true">&times;</span></button>
                                                    <center><h4 class = "modal-title">ATENÇÃO</h4></center>
                                                </div>
                                                <div class = "modal-body">
                                                    <label for="logour" class="control-label"><?PHP echo $_SESSION['MsgAviso'];?> </label>
                                                    <button type="button" class="btn btn-success btn-block" data-dismiss = "modal">OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--WARNINGFADE-->
                            </div>

<?PHP
    if(!(empty($_SESSION['aviso'])))
    {
        $Aviso = $_SESSION['aviso'];
        if($Aviso == 1)
            {
                unset($_SESSION['aviso']);
                unset($_SESSION['MsgAviso']);
?>
                <script>
                    $(function(){
                    $('#FadeAviso').modal('show');
                    });
                </script>
<?php         
            }
    }
?>
                        </body>
                    </html>
                    
<?PHP           }
                else
                {
                    echo "<script>history.go(-1)</script>";
                }
            }
            
        }
    }
}
?>