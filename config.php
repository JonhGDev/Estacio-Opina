<?php
    $dbHost = 'LocalHost';
    $dbUserName = 'root';
    $dbPassword = '';
    $dbName = 'formulario_opinioes';
    

    $conexao = new mysqli($dbHost,$dbUserName,$dbPassword,$dbName);

    //if ($conexao->connect_errno) 
    //{
    //   echo "erro"; 
   //}

    //else
    //{
   //    echo "Conectado";
   //}
?>