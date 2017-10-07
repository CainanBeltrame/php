<?PHP
   require_once "BLL/BLL_Administrativa.php";

   if(empty($_SESSION['ID'])||$_SESSION['PRIVILEGIO'] != 1)
   {
        header('location:Home.php');
   }
   else
   {
        $id = $_SESSION['ID'];
        $nome = $_SESSION['NOME'];

        $cManga = CountMangaPost($id);
        $cNoticia = CountNoticiaPost($id);

   }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <title>Área Administrativa</title>

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

        <div id = "Conteudo">
            <div class = "col-md-12">
                <!--Ajusta-->
                <div id = "Ajuste">
                    <div id = "bem-vindo" class = "col-md-offset-1">
                        <h1> Seja bem-vindo  <?PHP ECHO $nome;?> </h1><BR>
                    </div>
                </div>
            </div>

            <div class = "col-md-12">
                <div class = "col-md-offset-1">
                    <h2>Suas Postagem do site:</h2>
                    <div class="table-responsive col-md-6">
                        <table class="table">
                            <tr>
                                <th>Posts</th>
                                <th>Quantidade</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>Mangás</td>
                                <td ><?PHP ECHO $cManga;?></td>
                                <?PHP if ($cManga != 0){?>

                                <td><a href="Listas.php?type=1&pagina=1">Listar</a></td>
                                <?PHP }
                                    else { ?>
                                <td><a href="Listas.php?type=1&pagina=1" class = "btn disabled">Listar</a></td>
                                    <?PHP }?>
                                    
                            </tr>
                            <tr>
                                <td>Notícias</td>
                                <td><?PHP ECHO $cNoticia?></td>
                                <?PHP if($cNoticia != 0 ) {?>
                                <td><a href="Listas.php?type=2&pagina=1">Listar</a></td>
                                <?PHP }
                                    else { ?>
                                <td><a href="Listas.php?type=2&pagina=1" class = "btn disabled">Listar</a></td>
                                    <?PHP } ?>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>