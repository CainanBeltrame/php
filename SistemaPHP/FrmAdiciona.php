<?PHP
    include_once "BLL/BLL_Administrativa.php";
    if(empty($_SESSION['ID'])||$_SESSION['PRIVILEGIO'] != 1)
    {
         header('location:Home.php');
    }
    else
    {
        $useID = $_SESSION['ID'];
        $req = $_GET['type'];
        if($req == 1)
        {

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <title>Adicionar Mangá</title>

        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script src="bootstrap/js/ajax/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>

    </head>
    <body>
        <div class = "container">
            <div id = "conteudo" class = "col-md-12">
                <div class="configdiv">
                    <form enctype="multipart/form-data" role="form" data-toggle="validator" action="BLL/AdicionarManga.php" method="POST" class="form-horizontal">
                        <div id = "titulo" class = "col-md-6 col-md-offset-4">
                            <label for="tituo" class = "title"><h1>ADICIONAR MANGÁS</label></h1>
                        </div>
                        <div class = "col-md-12"> 
                            <hr>
                        </div>
                        
                        <div id = "formulario" class = "col-md-10 col-md-offset-2">
                            <div class = "form-group">
                                <label for="imgManga" class = "col-sm-2 control-label">Capa</label>
                                <div class = "col-xs-6 .col-sm-4">
                                    <input type="file" id = "imgManga" name="Imanga"required> 
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="NameManga" class="col-sm-2 control-label">Mangá</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name = "Nmanga" placeholder="Noragami VOL 1" required/>
                                </div>
                            </div>

                            <div class = "form-group">
                                <label for="descManga"class="col-sm-2 control-label">Descrição</label>
                                <div class = "col-sm-10">
                                    <textarea name="Dmanga" class="form-control" placeholder="Descreva o produto" rows="3" required></textarea>
                                </div>
                            </div>

                            <div class = "form-group">
                                <label for="sinopse" class="col-sm-2 control-label">Sinópse</label>
                                <div class = "col-sm-10">
                                    <textarea name="SManga" rows="5" class = "form-control" placeholder = "sinopse do Manga" required></textarea>
                                </div>
                            </div>

                            <div class = "form-group">
                                <label for="preco" class="col-sm-2 control-label">Preço R$</label>
                                <div class = "col-sm-10">
                                    <input type="number" step=0.01 min = 0 name = "Pmanga" class = "form-control" placeholder = "14.50" required>
                                </div>
                            </div>

                            <div class = "form-group">
                                <label for="quantidade" class="col-sm-2 control-label">Quantidade</label>
                                <div class = "col-sm-10">
                                    <input type="number" name="QTDmanga" class="form-control" placeholder="5" required>
                                </div>
                            </div>

                            <div class = "col-sm-10 form-group">
                                <button type="button" min = 0 class = "btn btn-primary" onclick = "history.back()">CANCELAR</button>
                                <button type="submit" class="btn btn-success">ADICIONAR</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<?PHP
        }
        else
        {
            if($req == 2)
            { ?>

                <!DOCTYPE html>
                <html lang="pt-br">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>Adicionar Noticia</title>

                    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
                    <script src="bootstrap/js/ajax/jquery.min.js"></script>
                    <script src="bootstrap/js/bootstrap.min.js"></script>
                    <script src="js/validator.min.js"></script>
                </head>
                
                <body>
                    <div id = "conteudo">
                        <div class = "col-md-12">
                            <div id = "titulo" class = "col-md-offset-4">
                                <h2>EDITAR NOTÍCIA</h2>
                            </div>
                            <hr>
                            <div id = "edicao" class = "col-md-6 col-md-offset-2">
                                <form data-toggle = "validator" enctype="multipart/form-data" role="form" method="POST" class="form-horizontal" action="BLL/AdcionaNoticia.php">
                                    
                                    <div class = "form-group">
                                        <label for="imgNoticia" class="col-sm-2 control-label">Capa</label>
                                        <div class = "col-xs-6 col-sm-4">
                                            <input type="file" name="imgNoticia" required>
                                        </div>
                                    </div>

                                    <div class = "form-group">
                                        <label for="tituloNo" class="col-sm-2 control-label">Titulo</label>
                                        <div class = "col-sm-10">
                                            <input type="text" class="form-control" name="tituloNoticia" required placeholder= "lancamento noragami">
                                        </div>
                                    </div>

                                    <div class = "form-group">
                                        <label for="descNoticia" class="col-sm-2 control-label">Descrição Breve</label>
                                        <div class = "col-sm-10">
                                            <textarea class="form-control" name="descBr" rows="3" required placeholder ="escreva aki uma descricao curta para atrair leitor"></textarea>
                                        </div>
                                    </div>

                                    <div class = "form-group">
                                        <label for="descComNoticia" class="col-sm-2 control-label"></label>
                                        <div class = "col-sm-10">
                                            <textarea name="DescComNoticia" class="form-control" rows="10" placeholder = "Escreva aki uma descricao completa"></textarea>
                                        </div>
                                    </div>

                                    <div class = "col-sm-10">
                                        <input type="button" class = "btn btn-primary" value = "CANCELAR" onclick = "history.back()">
                                        <input type="submit" class = "btn btn-warning" value = "ATUALIZAR"><br>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>    
                </body>
                </html>
<?PHP       }
        }
    }
    ?>