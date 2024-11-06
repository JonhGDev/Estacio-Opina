<?php
    $dbHost = 'LocalHost';
    $dbUserName = 'root';
    $dbsenha = '';
    $dbName = 'mydb';
    

    $conexao = new mysqli($dbHost,$dbUserName,$dbsenha,$dbName);
    //if ($conexao->connect_errno) 
    //{
   //     echo "erro"; 
   //}

    //else
    //{
    //    echo "Conectado";
   //}
