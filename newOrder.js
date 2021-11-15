function getInfoProd() {
    let idProduto = $('#cbProdutos').val();
    $.getJSON('getInfoProd.php', {id: idProduto},
    function(dados){
        if (dados != '' && dados != null) {
            let step = 1;
            if (dados['multiplo'] != null) {
                step = dados['multiplo'];
            }
            // Alguns produtos só podem ser vendidos em quantidades múltiplas de um determinado número
            // Itens que ficarem com rentabilidade ruim não podem ser inseridos no pedido
            $('#precoProd').val(dados['preco']);
            $('#precoProd').attr("min", (dados['preco']*0.9));
            $('#qtdProd').val(step);
            $('#qtdProd').attr("step", step);
            $('#qtdProd').attr("min", step);
        }
    })
    return;
}

function addNewItem() {
    let _idCliente = $('#cbClientes').val();
    let _idProduto = $('#cbProdutos').val();
    let _precoProd = $('#precoProd').val();
    let _qtdProd = $('#qtdProd').val();
    $('#errMsg').html('');
    $.post('insItemOrder.php',
        {
        idCliente: _idCliente,
        idProduto: _idProduto,
        precoProd: _precoProd,
        qtdProd: _qtdProd
        },
        function(dados) {
            let errSrv = '';
            if (dados != '' && dados != null) {
                if (dados['status'] == 200) {
                    location.reload();
                    return;
                } else {
                    errSrv = dados['msg'];
                }
            } 
            $('#errMsg').html( 
                '<div class="alert alert-danger d-flex align-items-center" role="alert">' +
                '<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>' +
                '<div>' +
                '  Todo mundo erra! ' + errSrv + 
                '</div></div>');
        })
}

// Captura o id do item antes de executar a exclusão
function btnDeleteClick(id) {
    idDeleteItem = id;
}

function deleteItem() {
    $.post('/delItemOrder.php', {id: idDeleteItem},
    function(dados) {
        if (dados != '' && dados != null) {
            location.reload();
        }
    })
}

function btnSendClick(idCliente) {
    $.post('/sendOrder.php', {id: idCliente},
    function(dados) {
        if (dados != '' && dados != null) {
            location.reload();
        }
    })
}

// "Máquina de estados" principal ...
$(document).ready(function(){
    // Variavel com scopo do documento
    var idDeleteItem = 0;
    // Carrega os dados do produto quando o documento está pronto
    getInfoProd();
    // Carrega os dados do produto quando selecionado no "comboBox"
    $('#cbProdutos').change(function(e){
        getInfoProd();
    })
    $('#formNewItem').submit(function(e){
        addNewItem();
        e.preventDefault(); // Bloqueia o envio padrão do FORM
    })
    $('#delItem').click(function() {
        deleteItem();
    })

})
