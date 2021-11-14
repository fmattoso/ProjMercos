<?php

    header("Content-type: application/json; charset=UTF-8",true);
    session_start();

    if (isset($_POST['idItem'])) {
        $idItem = $_POST['idItem'];
    } else {
        $json = array("status" => 300, "msg" => "Erro: Item não especificado");
    }

    if (isset($_POST['idProduto'])) {
        $idProduto = $_POST['idProduto'];
    } else {
        $json = array("status" => 300, "msg" => "Erro: Produto não especificado");
    }
    
    if (isset($_POST['precoProd'])) {
        $precoProd = $_POST['precoProd'];
    } else {
        $json = array("status" => 300, "msg" => "Erro: Preço não especificado");
    }

    if (isset($_POST['qtdProd'])) {
        $qtdProd = $_POST['qtdProd'];
    } else {
        $json = array("status" => 300, "msg" => "Erro: Quantidade não especificado");
    }

    if (isset($json)) {
        echo json_encode($json);
        exit;
    }

    // Estabelece Conexão
    require "incMySQLConn.php";

    $sql = " UPDATE pedidoItem SET ";
    $sql .= "idProduto = " . $idProduto;
    $sql .= ", quantidade = " . $qtdProd;
    $sql .= ", precoUnitario = " . $precoProd;
    $sql .= " WHERE id = " . $idItem;
    if ($mysqli->query($sql) === TRUE) {
        $json = array("status" => 200, "msg" => "sucesso");
    } else {
        $json = array("status" => 300, "msg" => "Erro: Novo item do pedido não pode ser alterado.");
    }

    echo json_encode($json);

?>