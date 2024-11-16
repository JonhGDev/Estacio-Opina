<?php
    session_start();
    //print_r($_REQUEST)

    if(isset($_POST['submit_login']) && !empty($_POST['matricula']) && !empty($_POST['senha']))
    {
        include_once('./config/database.php');
        $_SESSION['id_usuario'] = $id_usuario; // Durante o login
        $matricula = $_POST['matricula'];
        $senha = $_POST['senha'];

        //print_r('login: '. $matricula);
        //print_r('senha: '. $senha); 

        $sql = "SELECT * FROM usuario WHERE matricula = '$matricula' AND senha = '$senha'";

        $result = $conexao->query($sql);

        //print_r($result);

        if(mysqli_num_rows($result) < 1) 
        {
           unset($_SESSION['matricula']);
           unset($_SESSION['senha']);
           header('Location testelogin.php');
        }
        
        else 
        {
          $_SESSION['matricula'] = $matricula;
          $_SESSION['senha'] = $senha;
          header('Location: reclamacoes.php');
        }

    }
   
?>