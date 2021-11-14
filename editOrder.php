<?php

    session_start();

    include "incConstants.php";

    // Estabelece Conexão
    require "incMySQLConn.php";

    $tabItens = '';
    $sql = " SELECT ped.id, ped.dataPedido, ped.status, cli.nome";
    $sql .= ", SUM(pit.quantidade) AS totItens, SUM(pit.precoUnitario) AS totValor";
    $sql .= " FROM pedido ped";
    $sql .= " JOIN cliente cli ON cli.id = ped.idCliente";
    $sql .= " JOIN pedidoItem pit ON pit.idPedido = ped.id";
    $sql .= " WHERE ped.status in ('P', 'N')";
    $sql .= " GROUP BY ped.id, ped.dataPedido, ped.status, cli.nome";

    $query = $mysqli->query($sql);
    while ($row = $query->fetch_array()) {
        $tabItens .= '<tr><td><a href="/editOrderItens.php?id=' . $row['id'] . '" class="btn btn-secondary btn-sm">'. $icoEdit . '</a></td>';
        $tabItens .= '<td style="text-align:right">' . $row['id'] . '</td>';
        $tabItens .= '<td style="text-align:center">' . $row['dataPedido'] . '</td>';
        $tabItens .= '<td>' . $row['nome'] . '</td>';
        $tabItens .= '<td style="text-align:right">' . $row['totItens'] . '</td>';
        $tabItens .= '<td style="text-align:right">' . number_format($row['totValor'], 2, ',', '.') . '</td>';
        $tabItens .= '<td>' . $row['status'] . '</td></tr>';
    }

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <?php include "defHeader.php" ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/bootstrap5/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <main>
            <div class="py-5 text-center">
              <h2>Pedidos Pendentes</h2>
              <p class="lead">Relação de pedidos.</p>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr><th>Act</th><th style="text-align:center">Ped. Num.</th><th style="text-align:center">Data</th><th>Cliente</th><th style="text-align:center">Tot. Itens</th><th style="text-align:center">Vlr. Total</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        <?php print $tabItens; ?>
                    </tbody>
                </table>
            </div>

        </main>
    </div>

</body>
</html>
