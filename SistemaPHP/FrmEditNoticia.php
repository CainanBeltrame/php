<?PHP
    include_once "BLL/BLL_Administrativa.php";
    if(empty($_SESSION['ID'])||$_SESSION['PRIVILEGIO'] != 1)
    {
         header('location:Home.php');
    }
    else
    {
        $tipo = $_GET['tipo'];
        $idN = $_GET['id'];

        if($tipo == 1)
        {
            unset($_GET['tipo']);
            $rs = selectNoticiaById($idN);
            $row = mysqli_fetch_array($rs);

            $bas64 = $row['Imagem'];
?>            
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    
                    <title>Document</title>

                    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
                    <script src="bootstrap/js/ajax/jquery.min.js"></script>
                    <script src="bootstrap/js/bootstrap.min.js"></script>

                </head>

                <body>
                    <div id = "conteudo">
                        <div class = "col-md-12">
                            <div id = "titulo" class = "col-md-offset-4">
                                <h2>EDITAR NOTÍCIA</h2>
                            </div>
                            <hr>
                            <div id = "edicao" class = "col-md-6 col-md-offset-2">
                                <form enctype="multipart/form-data" role="form"  data-toggle="validator" method="POST" class="form-horizontal" action="BLL/EditarNoticia.php">
                                    
                                    <div class = "form-group">
                                        <label for="imgNoticia" class="col-sm-2 control-label">Capa</label>
                                        <div class = "col-md-3">
                                            <?PHP ECHO '<img class="img-thumbnail" src="data:image/jpg;base64,'.$bas64.'"/>' ?>
                                        </div>
                                        <div class = "col-xs-6 col-sm-4">
                                            <input type="file" name="imgNoticia" required>
                                        </div>
                                    </div>

                                    <div class = "form-group">
                                        <label for="tituloNo" class="col-sm-2 control-label">Titulo</label>
                                        <input type="text" class = "form-control hidden" name = "id" value = "<?PHP echo $row['id']; ?>">
                                        <div class = "col-sm-10">
                                            <input type="text" class="form-control" name="tituloNoticia" value = "<?PHP ECHO $row['Titulo'] ?>" required>
                                        </div>
                                    </div>

                                    <div class = "form-group">
                                        <label for="descNoticia" class="col-sm-2 control-label">Descrição Breve</label>
                                        <div class = "col-sm-10">
                                            <textarea class="form-control" name="descBrTitulo" rows="3" required><?PHP ECHO $row['DescricaoBreve'];?></textarea>
                                        </div>
                                    </div>

                                    <div class = "form-group">
                                        <label for="descComNoticia" class="col-sm-2 control-label">Descricao Completa</label>
                                        <div class = "col-sm-10">
                                            <textarea name="DescComNoticia" class="form-control" rows="10"><?PHP ECHO $row['Descricao']; ?></textarea>
                                        </div>
                                    </div>

                                    <div class = "form-group">
                                        <label for="dataNoticia" class="col-sm-2 control-label">Data</label>
                                        <div class = "col-sm-10">
                                            <input type="date" class="form-control" name="dataNoticia" required value = "<?PHP ECHO date("d/m/Y",strtotime($row['Data'])); ?>">
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
<?PHP
        }

    }
?>