<?php 
    $servidor = 'localhost';
    $usuario = 'u849221687_merco_adm';
    $senha = ']+K6cR;1p';
    $banco = 'u849221687_merco';

    $mysqli = new mysqli($servidor, $usuario, $senha, $banco);

    if (mysqli_connect_errno())
        trigger_error(mysqli_connect_error());
?>