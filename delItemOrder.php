<?php
    header("Content-type: application/json; charset=UTF-8",true);
    session_start();

    if (!isset($_SESSION['idCliente'])) {
        exit;
    }

    if (!isset($_POST['id'])) {
        exit;
    }

    // Estabelece Conexão
    require "incMySQLConn.php";
    // Nem tão inseguro ... só permite excluir itens de pedidos abertos
    $sql = "DELETE FROM pedidoItem WHERE pedidoItem.id = " . $_POST['id'] . " AND pedidoItem.idPedido IN (SELECT id FROM pedido WHERE id = pedidoItem.idPedido AND STATUS IN ('P','N'))";
    if ($mysqli->query($sql) === TRUE) {
        $json = array("status" => 200);
        echo json_encode($json);
    }

?>