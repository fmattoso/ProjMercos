<?php

    session_start();

    include "incConstants.php";

    // Estabelece Conexão
    require "incMySQLConn.php";

    $listCli = '';
    $lisProd = '';
    $tabItens = '';

    $sql = "SELECT `id`, `nome` FROM `cliente` ORDER BY `nome`";
    $query = $mysqli->query($sql);
    while ($row = $query->fetch_array()) {
        if (!isset($_SESSION['idCliente'])) {
            $_SESSION['idCliente'] =  $row['id'];
        }
        if ($_SESSION['idCliente'] == $row['id']) {
            $listCli .= '<option selected value="' . $row['id'] . '">' . $row['nome'] . '</option>';
        } else {
            $listCli .= '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
        }
    }
 
    $sql = "SELECT `id`, `nome` FROM `produto` ORDER BY `nome`";
    $query = $mysqli->query($sql);
    while ($row = $query->fetch_array()) {
        $lisProd .= '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
    }

    $totPedido = 0;
    $qtdItens = 0;
    $pedNum = '';
    if (isset($_SESSION['idCliente'])) {
        $sql =  "SELECT pit.id, prd.nome, pit.idPedido, pit.precoUnitario, pit.quantidade,"; 
        $sql .= "CASE ";
        $sql .= "  WHEN (pit.precoUnitario > prd.precoUnitario) THEN 'ótima' ";
        $sql .= "  WHEN (pit.precoUnitario <= (prd.precoUnitario * 0.9)) THEN 'ruim' ";
        $sql .= "  ELSE 'boa' END AS rentabilidade, ";
        $sql .= "(pit.precoUnitario * pit.quantidade) AS toalItem ";
        $sql .= "FROM pedidoItem pit ";
        $sql .= "JOIN produto prd ON prd.id = pit.idProduto ";
        $sql .= "JOIN pedido ped ON ped.id = pit.idPedido AND ped.idCliente = " . $_SESSION['idCliente'] . " AND ped.status = 'P'";
        $query = $mysqli->query($sql);
        while ($row = $query->fetch_array()) {
            $tabItens .= '<tr><td><button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#dlgDelItem" onclick=btnDeleteClick('.$row['id'].')>'. $icoLixo . '</button></td>';
            $tabItens .= '<td>' . $row['nome'] . '</td>';
            $tabItens .= '<td style="text-align:right">' . number_format($row['precoUnitario'], 2, ',', '.') . '</td>';
            $tabItens .= '<td style="text-align:right">' . $row['quantidade'] . '</td>';
            $tabItens .= '<td style="text-align:right">' . number_format($row['toalItem'], 2, ',', '.') . '</td>';
            $tabItens .= '<td>' . $row['rentabilidade'] . '</td></tr>';
            $totPedido += $row['toalItem'];
            $qtdItens += $row['quantidade'];
            $pedNum = $row['idPedido'];
        }
        $totPedido =  number_format($totPedido, 2, ',', '.');           
    }

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <?php include "defHeader.php" ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/bootstrap5/js/bootstrap.bundle.min.js"></script>
    <script src="/newOrder.js"></script>
</head>
<body>
    <div class="container">
        <main>
            <div class="py-5 text-center">
              <h2>Novo Pedido</h2>
              <p class="lead">Faça o seu pedido.</p>
            </div>
            <form id="formNewItem" action="<?php print $_SERVER['PHP_SELF'];?>" method="POST">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="cbClientes" class="form-label">Selecione um cliente:</label>
                        <select name="cbClientes" id="cbClientes" class="form-control">
                            <?php print $listCli; ?>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <button type="button" class="w-100 btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#dlgAddItem">Adicionar Item</button>
                    </div>
                </div>

                <!-- Caixa de diálog Modal para adicionar itens -->
                <div class="modal fade" id="dlgAddItem" data-bs-backdrop="static" tabindex="-1" aria-labelledby="dlgAddItemLabel" aria-hidden="true" role="dialog">
                    <div class="modal-dialog">
                        <!-- Corpo -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="dlgAddItemLabel">Adicionar Item</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 ms-auto">
                                        <label for="cbProdutos" class="form-label">Selecione um Produto:</label>
                                        <select name="cbProdutos" id="cbProdutos" class="form-control">
                                            <?php print $lisProd; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 ms-auto">
                                        <label for="precoProd" class="form-label">Preço:</label>
                                        <input type="number" class="form-control" name="precoProd" id="precoProd" placeholder="0.00" step="0.01" required>
                                    </div>
                                    <div class="col-md-6 ms-auto">
                                        <label for="qtdProd" class="form-label">Quantidade:</label>
                                        <input type="number" class="form-control" name="qtdProd" id="qtdProd" placeholder="0" min="1" value="1" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary" name="addItem">Adicionar</button>
                            </div>
                        </div>                    
                    </div>
                </div>
            </form>

            <!-- Caixa de diálog Modal perguntar se deseja apagar o item -->
            <div class="modal fade" id="dlgDelItem" data-bs-backdrop="static" tabindex="-1" aria-labelledby="dlgDelItemLabel" aria-hidden="true" role="dialog">
                <div class="modal-dialog">
                    <!-- Corpo -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="dlgDelItemLabel">Excluir Item</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Deseja excluir este item do Pedido?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                            <button type="button" class="btn btn-danger" id="delItem">Sim</button>
                        </div>
                    </div>                    
                </div>
            </div>

            <!-- Exibe a mensagem de erro, se houver ... -->
            <div id="errMsg" class="row py-2">
            </div>

            <h2>Itens do Pedido <?php print $pedNum; ?></h2>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr><th>Act</th><th>Item</th><th style="text-align:center">Preço Unit.</th><th style="text-align:center">Qtd.</th><th style="text-align:center">Total</th><th>Rentabilidade</th></tr>
                    </thead>
                    <tbody>
                        <?php print $tabItens; ?>
                    </tbody>
                    <tfoot>
                        <tr><td></td><td></td><td></td><td style="text-align:right"><?php print $qtdItens; ?></td><td style="text-align:right"><?php print $totPedido; ?></td><td></td></tr>
                    </tfoot>
                </table>
            </div>

        </main>
    </div>

</body>
</html>
