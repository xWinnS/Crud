<?php

    try
    {
        $PDO = new PDO("mysql:host=localhost;dbname=techhardware","root", "");
        //mysql:host=nomedohost;dbname=nomedobd,"usuario","senha"
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo 'Erro ao conectar com o MySQL: '.$e->getMessage();// or getCode
    }
   
?> 