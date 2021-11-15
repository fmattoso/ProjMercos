<?php
    session_start();

    include "incConstants.php";

    // Estabelece Conexão
    require "incMySQLConn.php";

    if (isset($_GET['id'])) {
        $idPedido = $_GET['id'];
    }

    $totPedido = 0;
    $qtdItens = 0;
    $pedNum = '';
    $tabItens = '';
    if (isset($idPedido)) {
        $sql = " SELECT pit.id, prd.nome, pit.idProduto, pit.idPedido, pit.precoUnitario, pit.quantidade,"; 
        $sql .= " CASE ";
        $sql .= "  WHEN (pit.precoUnitario > prd.precoUnitario) THEN 'ótima' ";
        $sql .= "  WHEN (pit.precoUnitario <= (prd.precoUnitario * 0.9)) THEN 'ruim' ";
        $sql .= "  ELSE 'boa' END AS rentabilidade, ";
        $sql .= " (pit.precoUnitario * pit.quantidade) AS toalItem ";
        $sql .= " FROM pedidoItem pit ";
        $sql .= " JOIN produto prd ON prd.id = pit.idProduto ";
        $sql .= " JOIN pedido ped ON ped.id = pit.idPedido AND ped.status IN ('P','N')";
        $sql .= " WHERE pit.idPedido = " . $idPedido;
        $query = $mysqli->query($sql);
        while ($row = $query->fetch_array()) {
            // "mb-1 mb-md-0" margem inferior = 1, exceto em dispositivos com display a partir de tamanho médio
            $tabItens .= '<tr><td><button type="button" class="btn btn-secondary btn-sm me-1 mb-1 mb-md-0" data-bs-toggle="modal" data-bs-target="#dlgDelItem" onClick=btnDeleteClick('.$row['id'].')>'. $icoLixo . '</button>';
            $tabItens .= '<button type="button" class="btn btn-secondary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#dlgEditItem" onClick="btnEditClick('. $row['id']. ','. $row['idProduto'] . ')">'. $icoEdit . '</button></td>';
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
    } else {
        $tabItens = '<tr><td style="text-align:center" colspan="6">Pârametro Incorreto!</td></tr>';
    }

    $lisProd = '';
    $sql = "SELECT id, nome FROM produto ORDER BY nome";
    $query = $mysqli->query($sql);
    while ($row = $query->fetch_array()) {
        $lisProd .= '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
    }

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <?php include "defHeader.php" ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/bootstrap5/js/bootstrap.bundle.min.js"></script>
    <script src="/editOrderItens.js"></script>
</head>
<body>
    <div class="container">
        <main>
            <div class="py-5 text-center">
              <h2>Itens do Pedido <?php print $pedNum?></h2>
              <p class="lead">Relação de itens do pedido.</p>
            </div>

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

            <form id="formEditItem" >
                <!-- Caixa de diálog Modal para adicionar itens -->
                <div class="modal fade" id="dlgEditItem" data-bs-backdrop="static" tabindex="-1" aria-labelledby="dlgEditItemLabel" aria-hidden="true" role="dialog">
                    <div class="modal-dialog">
                        <!-- Corpo -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="dlgEditItemLabel">Alterar Item</h4>
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
                                <button type="submit" class="btn btn-primary" name="editItem">Salvar</button>
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
            
        </main>

        <footer>
            <p>
                <a class="btn btn-primary me-2" href="/default.php" role="button" rel="prev"><?php print $icoInicio; ?> Principal</a>
                <a class="btn btn-primary me-2" href="/editOrder.php" role="button" rel="prev"><?php print $icoCheck; ?> Pedidos</a>
            </p>
        </footer>

    </div>

</body>
</html>
