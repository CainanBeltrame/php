<?PHP
    include_once "BLL/BLL_Administrativa.php";
    if(empty($_SESSION['ID'])||$_SESSION['PRIVILEGIO'] != 1)
    {
         header('location:Home.php');
    }
    else
    {
        $tipo = $_GET['tipo'];
        $idM = $_GET['id'];
        if($tipo == 1)
        {
            unset($_GET['tipo']);
            $rs = MangasbyID($idM);
            $row = mysqli_fetch_array($rs);
            
            $bas64 = $row['Imagem'];
?>
        <!DOCTYPE html>
        <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">

                <title>Editar Mánga</title>

                <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
                <script src="bootstrap/js/ajax/jquery.min.js"></script>
                <script src="bootstrap/js/bootstrap.min.js"></script>

            </head>
            <body>
                <div id = "conteudo">
                    <div class = "col-md-12">
                        <div id = "titulo" class = "col-md-offset-4">
                            <h2>EDITAR O MANGÁ <i> <?php echo $row['Nome']; ?></h2></i>
                        </div>
                        <hr>
                        <div id = "conteudo" class = "col-md-6 col-md-offset-2">
                            <form enctype="multipart/form-data" role="form" data-toggle="validator" action="BLL/EditarManga.php" method="POST" class="form-horizontal">
                                <div class = "form-group">
                                    <label for="imgManga" class = "col-sm-2 control-label">Capa</label>
                                    <div class = "col-md-3">
                                        <?PHP ECHO '<img class="img-thumbnail" src="data:image/jpg;base64,'.$bas64.'"/>' ?>
                                    </div>
                                    <div class = "col-xs-6 .col-sm-4">
                                        <input type="file" id = "imgManga" name = "iManga" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="NameManga" class="col-sm-2 control-label">Mangá</label>
                                    <input type="text" class = "form-control hidden" name = "id" value = "<?PHP echo $row['id']; ?>">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="NameManga" name ="nManga"  placeholder="Noragami VOL 1" value = "<?PHP ECHO $row['Nome']; ?>" required />
                                    </div>
                                </div>

                                <div class = "form-group">
                                    <label for="DescManga" class = "col-sm-2 control-label">Descrição</label>
                                    <div class = "col-sm-10">
                                        <textarea id="descManga" name = "dManga" rows="3" class = "form-control" required><?PHP ECHO $row['Descricao'];?></textarea>    
                                    </div>
                                </div>
                                
                                <div class = "form-group">  
                                    <label for="sinoManga" class = "col-sm-2 control-label">Sinópse</label>
                                    <div class = "col-sm-10">
                                        <textarea name="sManga" id="sinoManga" rows="5" class = "form-control" required><?PHP ECHO $row['Sinopse'];?></textarea>
                                    </div>
                                </div>

                                <div class = "form-group">
                                    <label for="preco" class = "col-sm-2 control-label">Preço R$</label>
                                    <div class = "col-sm-10">
                                        <input type="number" class = "form-control" step=0.01 min = 0 name = "pManga" placeholder = "14.50" value = "<?PHP ECHO $row['ValorUnit'];?>" required>
                                    </div>
                                </div>
                                <div class = "form-group">
                                    <label for="qtdManga" class = "col-sm-2 control-label">Quantidade</label>
                                    <div class = "col-sm-10">
                                        <input type="number"  min = 0 class = "form-control" name = "qManga" placeholder = "5" value = "<?PHP ECHO $row['Qtd'];?>"required/>
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
<?PHP    }
    else
    {
        if($tipo == 2)
        {   
            unset($_GET['tipo']);
            $rs = MangasbyID($idM);
            $row = mysqli_fetch_array($rs);
            
            $bas64 = $row['Imagem'];
    ?>
            <!DOCTYPE html>
            <html lang="pt-br">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
                    <title>Excluir Mánga</title>
    
                    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
                    <script src="bootstrap/js/ajax/jquery.min.js"></script>
                    <script src="bootstrap/js/bootstrap.min.js"></script>
    
                </head>
                <body>
                    <div id = "conteudo">
                        <div class = "col-md-12">
                            <div id = "titulo" class = "col-md-offset-4">
                                <h2>EXCLUIR O MANGÁ <i> <?php echo $row['Nome']; ?></h2></i>
                            </div>
                            <hr>
                            <div id = "conteudo" class = "col-md-6 col-md-offset-2">
                                <form class="form-horizontal" method = "post" action="BLL/DeleteManga.php">
                                    <div class = "form-group">
                                        <label for="imgManga" class = "col-sm-2 control-label">Capa</label>
                                        <div class = "col-md-3">
                                            <?PHP ECHO '<img class="img-thumbnail" src="data:image/jpg;base64,'.$bas64.'"/>' ?>
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <label for="NameManga" class="col-sm-2 control-label">Mangá</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="NameManga" placeholder="Noragami VOL 1" disabled value = "<?PHP ECHO $row['Nome']; ?>" />
                                            <input type="text" class = "form-control hidden" name = "id" value = "<?PHP echo $row['id']; ?>">
                                            <input type="text" class = "form-control hidden" name = "type" value = "<?PHP echo $tipo; ?>">
                                        </div>
                                    </div>
    
                                    <div class = "form-group">
                                        <label for="DescManga" class = "col-sm-2 control-label">Descrição</label>
                                        <div class = "col-sm-10">
                                            <textarea name="Descricao" id="descManga" rows="3" class = "form-control" disabled><?PHP ECHO $row['Descricao'];?></textarea>    
                                        </div>
                                    </div>
                                    
                                    <div class = "form-group">  
                                        <label for="sinoManga" class = "col-sm-2 control-label">Sinópse</label>
                                        <div class = "col-sm-10">
                                            <textarea name="sinopse" id="sinoManga" rows="5" class = "form-control" disabled><?PHP ECHO $row['Sinopse'];?></textarea>
                                        </div>
                                    </div>
    
                                    <div class = "form-group">
                                        <label for="preco" class = "col-sm-2 control-label">Preço R$</label>
                                        <div class = "col-sm-10">
                                            <input type="number" class = "form-control" step=0.01 min = 0 name = "precoManga" placeholder = "14.50" disabled value = "<?PHP ECHO $row['ValorUnit'];?>">
                                        </div>
                                    </div>
                                    <div class = "form-group">
                                        <label for="qtdManga" class = "col-sm-2 control-label">Quantidade</label>
                                        <div class = "col-sm-10">
                                            <input type="number" class = "form-control" min = 0 name = "qtdManga" placeholder = "5" disabled value = "<?PHP ECHO $row['Qtd'];?>"/>
                                        </div>
                                    </div>
                                    <div class = "col-sm-10">
                                        <input type="button" class = "btn btn-primary" value = "CANCELAR" onclick = "history.back()">
                                        <button type="submit" class = "btn btn-warning">EXCLUIR</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </body>
            </html>
        <?php   }
                else
                {
                    echo "<script>history.go(-1)</script>";
                }
        }
    }
?>