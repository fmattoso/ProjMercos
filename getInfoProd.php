<?php
    header("Content-type: application/json; charset=UTF-8",true);
    session_start();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        exit;
    }

    // Estabelece Conexão
    require "incMySQLConn.php";
    $sql = "SELECT id, precoUnitario, multiplo FROM produto WHERE id = " . $id;
    $query = $mysqli->query($sql);
    $row = $query->fetch_array();
    if ($row) {
        $json = array("id" => $row['id'], "preco" => $row['precoUnitario'], "multiplo" => $row['multiplo']);
        echo json_encode($json);
    }
    $query = null;  
?>