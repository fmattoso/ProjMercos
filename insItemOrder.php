<?php

    header("Content-type: application/json; charset=UTF-8",true);
    session_start();

    if (isset($_POST['idCliente'])) {
        $_SESSION['idCliente'] = $_POST['idCliente'];
    } else {
        $json = array("status" => 300, "msg" => "Erro: Cliente não especificado");
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

    $sql = "SELECT id FROM pedido WHERE idCliente = " . $_SESSION['idCliente'] . " AND status = 'P'";
    $query = $mysqli->query($sql);
    $row = $query->fetch_array();
    if (!$row) {
        // Inserir um novo pedido para o cliente atual ...
        $sql = "INSERT INTO pedido (idCliente, dataPedido, status) VALUES (";
        $sql .= $_SESSION['idCliente'] . ',';
        $sql .= "NOW(),'P')"; // Data atual e status Pendente
        if ($mysqli->query($sql) === TRUE) {
            $_SESSION['idPedido'] = $mysqli->insert_id;
        } else {
            $json = array("status" => 300, "msg" => "Erro: Novo pedido não pode ser criado.");
        }
    } else {
        $_SESSION['idPedido'] = $row['id'];
    }

    if (isset($json)) {
        echo json_encode($json);
        exit;
    }

    $sql = "INSERT INTO pedidoItem (idPedido, idProduto, quantidade, precoUnitario) VALUES (";
    $sql .= $_SESSION['idPedido'] . ',';
    $sql .= $idProduto . ',';
    $sql .= $qtdProd . ',';
    $sql .= $precoProd . ')';
    if ($mysqli->query($sql) === TRUE) {
        $json = array("status" => 200, "msg" => "sucesso");
    } else {
        $json = array("status" => 300, "msg" => "Erro: Novo item do pedido não pode ser criado.");
    }

    echo json_encode($json);

?>