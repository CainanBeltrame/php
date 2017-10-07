<?PHP
    session_start();
    if(!(empty($_SESSION['ID']))){$idUser = $_SESSION['ID'];}
    if(!(empty($_SESSION['PRIVILEGIO']))){$priviUser = $_SESSION['PRIVILEGIO'];}
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Inicio</title>

        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script src="bootstrap/js/ajax/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        
    </head>
    
    <body>
        <!--navbar-->
        <nav class="navbar navbar-default">
            <div class="container" ID = "NavBar">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="#"><img src="Imagens/logo-navBar.png"></a></li>
                    <li role="presentation"><a href="#">Catálago<img src=""></a></li>
                    <li role="presentation"><a href="#">Notícias<img src=""></a></li>
                    <li role="presentation"><a href="#">Sobre<img src=""></a></li>
                    
                    <form class = "navbar-form navbar-left">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">         
<!--PHP-->              <?PHP if(!(isset($idUser))) {?>
                        <li role="presentation"><a data-toggle="modal" href="#loginModal">
                            <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Login</a>
                        </li>
<!--PHP-->              <?PHP } ?>                    
<!--PHP-->              <?PHP if((isset($idUser))) {?>
                        <li role="presentation"><a data-toggle="modal" href="#FadeWarning">
                            <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Sair</a>
                        </li>
                        <li role="presentation"><a href="#">
                            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a>
                        </li>
<!--PHP-->              <?PHP if((isset($priviUser))) { ?>
                            <li role="presentation"><a href="Administrativa.php"> Área Administrativa </a>
                            </li>
<!--PHP-->              <?PHP } ?>
<!--PHP-->              <?PHP }?>
                    </ul>
                </ul>
            </div>
        </nav> <!--NAVBAR-->

        <!--LoginModalFade-->
        <div id="loginModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class = "col-xs-15">
                        <div class = "modal-header">
                            <button type= "button" class = "close" data-dismiss = "modal" arial-labe = "close"><span aria-hidden = "true">&times;</span></button>
                            <h4 class = "modal-title">LOGIN NossoMangá</h4>
                        </div>
                        <div class = "modal-body">
                            <form id="loginForm" method="POST" action="login.php" novalidate="novalidate">
                                <div class="form-group">
                                    <label for="Usuario" class="control-label">Usuario</label>
                                    <input type="text" class="form-control" id="Usuario" name="username" value="" required title="Please enter you username" placeholder="exemplo@gmail.com">
                                    <span class="help-block"></span>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="control-label">Password</label>
                                    <input type="password" class="form-control" id="Password" name="password" value="" required title="Please enter your password">
                                    <span class="help-block"></span>
                                </div>

                                <div id="loginErrorMsg" class="alert alert-error hide">Wrong username or password</div>
                                
                                <button type="submit" class="btn btn-success btn-block">Login</button>

                                <p><BR>
                                    <a href="#">Forgot Password?</a>
                                </p>
                            </form>
                            <div class="modal-footer">
                                Novo no NossoMangá?
                                <a href="#" class="btn btn-primary">Cadastra-se</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!--LOGINMODALFADE-->

        <!--ErrorFade-->
        <div ID = "FadeError" class = "modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class = "col-xs-15">
                        <div class = "modal-header">
                            <button type= "button" class = "close" data-dismiss = "modal" arial-labe = "close"><span aria-hidden = "true">&times;</span></button>
                            <h4 class = "modal-title">Falha de Login</h4>
                        </div>
                        <div class = "modal-body">
                            <p><?php  echo $_SESSION['MsgErro']?></p>
                            <p><button type="button" class="btn btn-danger btn-block" data-dismiss = "modal"></a> OK</button></p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--ERRORFADE-->

        <!--WarningFade-->
        <div ID = "FadeWarning" class = "modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class = "col-xs-15">
                        <div class = "modal-header">
                            <button type= "button" class = "close" data-dismiss = "modal" arial-labe = "close"><span aria-hidden = "true">&times;</span></button>
                            <center><h4 class = "modal-title">ATENÇÃO</h4></center>
                        </div>
                        <div class = "modal-body">
                            <form id="loginForm" method="POST" action="Logout.php" novalidate="novalidate">
                                <label for="logour" class="control-label">Realmente deseja sair?</label>
                                <button type="submit" class="btn btn-default btn-block">sim</button>
                                <button type="button" class="btn btn-success btn-block" data-dismiss = "modal">Não</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--WARNINGFADE-->

        <div id = "conteudo">
            <div class = "col-md-12">
                <div class = "configdiv">
                    <!--centraliza-->
                    <div id="centraliza" class = "col-md-6 col-md-offset-3">
                        <!--carousel slide-->
                        <div id = "TopMangas" class="carousel slide" data-ride="carousel">
                            <!--indicadores-->
                            <ol class="carousel-indicators">
                                <li data-target="#TopMangas" data-slide-to="0" class="active"></li>
                                <li data-target="#TopMangas" data-slide-to="1"></li>
                            </ol><!--INDICADORES-->

                            <!--itensSlide-->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="Imagens/teste1.jpg">
                                    <div class = "carousel-caption hidden-xs">
                                        <h3>teste</h3>
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="Imagens/teste2.jpg">
                                </div>
                            </div><!--ITENSSLIDE-->

                            <!--Controles-->
                            <div>
                                <a class="left carousel-control" href="#TopMangas" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#TopMangas" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                                </div><!--CONTROLES-->
                        </div><!--CAROUSEL SLIDE-->

                        <!--lançamento-->
                        <div id = "lancamentos">
                            <div id = "titulo">
                                <h3>Lançamentos</h3>
                            </div>
                            <div class = "row">
                                <div class = "col-xs-3 col-md-3">
                                    <a href="#" class = "thumbnail">
                                        <img src="Imagens/capas lançamento -a voz do silencio.jpg" alt="...">
                                    </a>
                                </div>
                                <div class = "col-xs-3 col-md-3">
                                    <a href="#" class = "thumbnail">
                                        <img src="Imagens/capas lançamento -owari" alt="...">
                                    </a>
                                </div>
                                <div class = "col-xs-3 col-md-3">
                                    <a href="#" class = "thumbnail">
                                        <img src="Imagens/capas lançamento -rezero" alt="...">
                                    </a>
                                </div>
                                <div class = "col-xs-3 col-md-3">
                                    <a href="#" class = "thumbnail">
                                        <img src="Imagens/capas lançamento -yourname" alt="...">
                                    </a>
                                </div>
                            </div>
                        </div><!--LANÇAMENTO-->
                        
                        <!--noticias-->
                        <div id = "Noticias">
                            <div id = "titulo">
                                <H3>Noticias</H3>
                            </div>
                            <div class = "row">
                                <!--Item-->
                                <div class = "col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <img src="Imagens/capas lançamento -rezero" alt="">
                                        <div class = "caption">
                                            <h3>titulo 1</h3>
                                            <p>
                                                descricao breve
                                            </p>
                                            <p>
                                                <a href="#">leia mais</a>
                                            </p>
                                        </div>
                                    </div>
                                </div><!--ITEM-->
                                <!--Item-->
                                <div class = "col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <img src="Imagens/capas lançamento -yourname" alt="">
                                        <div class = "caption">
                                            <h3>titulo 1</h3>
                                            <p>
                                                descricao breve
                                            </p>
                                            <p>
                                                <a href="#">leia mais</a>
                                            </p>
                                        </div>
                                    </div>
                                </div><!--ITEM-->
                                <!--Item-->
                                <div class = "col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <img src="Imagens/capas lançamento -owari" alt="">
                                        <div class = "caption">
                                            <h3>titulo 1</h3>
                                            <p>
                                                descricao breve
                                            </p>
                                            <p>
                                                <a href="#">leia mais</a>
                                            </p>
                                        </div>
                                    </div>
                                </div><!--ITEM-->
                            </div>
                        </div> <!--NOTICIAS-->

                        
                    </div><!--CENTRALIZA-->


                </div>            
            </div>
        </div>    
    </body>

<?php
if(!(empty($_SESSION['erro'])))
{
    $erro = $_SESSION['erro'];
    if($erro == 1)
        {
            unset($_SESSION['erro']);
            unset($_SESSION['MsgErro']);
?>
            <script>
                $(function(){
                $('#FadeError').modal('show');
                });
            </script>
<?php         
        }
}
?>
</html>