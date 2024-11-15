<?php
    $dbHost = 'LocalHost';
    $dbUserName = 'root';
    $dbPassword = '';
    $dbName = 'estacio_opina';
    

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