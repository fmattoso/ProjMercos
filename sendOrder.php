<?php

    header("Content-type: application/json; charset=UTF-8",true);
    session_start();

    if (isset($_POST['id'])) {
        $idCliente = $_POST['id'];
    } else {
        $json = array("status" => 300, "msg" => "Erro: Cliente não especificado");
    }

    if (isset($json)) {
        echo json_encode($json);
        exit;
    }

    // Estabelece Conexão
    require "incMySQLConn.php";

    $sql = " UPDATE pedido SET status = 'N' WHERE idCliente = " . $idCliente . " AND status = 'P'" ;
    if ($mysqli->query($sql) === TRUE) {
        $json = array("status" => 200, "msg" => "sucesso");
    } else {
        $json = array("status" => 300, "msg" => "Erro: Novo item do pedido não pode ser alterado.");
    }

    echo json_encode($json);

?>