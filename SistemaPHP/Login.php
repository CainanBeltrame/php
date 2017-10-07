<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    require_once "DAL/DAL.php"; 
    $_SESSION['erro'] = 0; 
    if(!(empty($username))&&(!(empty($password))))
    {
       $logL = Login($username,$password);
       
       if($logL == 1)
       {
            header('location:Home.php');
       }
        if($logL == 0)
        {
            $_SESSION['erro'] = 1; 
            $_SESSION['MsgErro'] = "Usuario ou Senha Incorretos!"; 
            header('location:Home.php');
        }
        
    }
    else
    {
        $_SESSION['erro'] = 1; 
        $_SESSION['MsgErro'] = "Porfavor insira as credenciais!"; 
        header('location:Home.php'); 
    }
?>