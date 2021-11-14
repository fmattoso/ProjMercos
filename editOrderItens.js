function getInfoProd() {
    let idProduto = $('#cbProdutos').val();
    $.getJSON('getInfoProd.php', {id: idProduto},
    function(dados){
        if (dados != '' && dados != null) {
            let step = 1;
            if (dados['multiplo'] != null) {
                step = dados['multiplo'];
            }
            // Alguns produtos só podem ser vendidos em quantidades múltiplas de um determinado número ...
            $('#precoProd').val(dados['preco']);
            $('#precoProd').attr("min", (dados['preco']*0.9));
            $('#qtdProd').val(step);
            $('#qtdProd').attr("step", step);
            $('#qtdProd').attr("min", step);
        }
    })
    return;
}

function btnEditClick(idItem, idProduto) {
    idSelItem = idItem;
    document.getElementById('cbProdutos').value = idProduto;
    getInfoProd();
}

function btnDeleteClick(idItem) {
    idSelItem = idItem;
}

function editItem() {
    let _idItem = idSelItem;
    let _idProduto = $('#cbProdutos').val();
    let _precoProd = $('#precoProd').val();
    let _qtdProd = $('#qtdProd').val();
    $.post('editItemOrder.php',
        {
        idItem: _idItem,
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
                } 
            } 
        })
}

function deleteItem() {
    $.post('/delItemOrder.php', {id: idSelItem},
    function(dados) {
        if (dados != '' && dados != null) {
            location.reload();
        }
    })
}

// "Máquina de estados" principal ...
$(document).ready(function(){
    // Variavel com scopo do documento
    var idSelItem = 0;
    // Carrega os dados do produto quando o documento está pronto
    getInfoProd();
    // Carrega os dados do produto quando selecionado no "comboBox"
    $('#cbProdutos').change(function(e){
        getInfoProd();
    })
    $('#formEditItem').submit(function(e){
        editItem();
        e.preventDefault(); // Bloqueia o envio padrão do FORM
    })
    $('#delItem').click(function() {
        deleteItem();
    })   
})
