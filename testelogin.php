<?php
    
    //print_r($_REQUEST)

    if(isset($_POST['submit_login']) && !empty($_POST['matricula']) && !empty($_POST['senha']))
    {
        include_once('config.php');
        $matricula = $_POST['matricula'];
        $senha = $_POST['senha'];

        //print_r('login: '. $matricula);
        //print_r('senha: '. $senha); 

        $sql = "SELECT * FROM usuario WHERE matricula = '$matricula' AND senha = '$senha'";

        $result = $conexao->query($sql);

        //print_r($result);

        if(mysqli_num_rows($result) < 1) 
        {
           header('Location testelogin.php');
        }
        
        else 
        {
          header('Location: reclamacoes.php');
        }

    }
   
?>