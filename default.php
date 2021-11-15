<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <?php include "defHeader.php" ?>
    <script src="/bootstrap5/js/bootstrap.bundle.min.js"></script>    
</head>
<body>
    <div class="col-lg-8 mx-auto p-3 py-md-5">
        <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
            <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-gear-wide" viewBox="0 0 16 16">
            <path d="M8.932.727c-.243-.97-1.62-.97-1.864 0l-.071.286a.96.96 0 0 1-1.622.434l-.205-.211c-.695-.719-1.888-.03-1.613.931l.08.284a.96.96 0 0 1-1.186 1.187l-.284-.081c-.96-.275-1.65.918-.931 1.613l.211.205a.96.96 0 0 1-.434 1.622l-.286.071c-.97.243-.97 1.62 0 1.864l.286.071a.96.96 0 0 1 .434 1.622l-.211.205c-.719.695-.03 1.888.931 1.613l.284-.08a.96.96 0 0 1 1.187 1.187l-.081.283c-.275.96.918 1.65 1.613.931l.205-.211a.96.96 0 0 1 1.622.434l.071.286c.243.97 1.62.97 1.864 0l.071-.286a.96.96 0 0 1 1.622-.434l.205.211c.695.719 1.888.03 1.613-.931l-.08-.284a.96.96 0 0 1 1.187-1.187l.283.081c.96.275 1.65-.918.931-1.613l-.211-.205a.96.96 0 0 1 .434-1.622l.286-.071c.97-.243.97-1.62 0-1.864l-.286-.071a.96.96 0 0 1-.434-1.622l.211-.205c.719-.695.03-1.888-.931-1.613l-.284.08a.96.96 0 0 1-1.187-1.186l.081-.284c.275-.96-.918-1.65-1.613-.931l-.205.211a.96.96 0 0 1-1.622-.434L8.932.727zM8 12.997a4.998 4.998 0 1 1 0-9.995 4.998 4.998 0 0 1 0 9.996z"/>
            </svg> 
            <span class="fs-4">Teste técnico</span>
            </a>
        </header>

        <main>
            <h1>Pessoa Desenvolvedora FullStack</h1>
            <p class="fs-5 col-md-8">
                Em uma galáxia muito, muito distante ...
            </p>

            <div class="mb-5">
                <a href="/newOrder.php" class="btn btn-primary btn-lg px-4 me-2">Novo Pedido</a>
                <a href="/editOrder.php" class="btn btn-primary btn-lg px-4 me-2">Editar Pedido</a>
            </div>

            <hr class="col-3 col-md-2 mb-5">

            <div class="row g-5">
                <div class="col-md-6">
                    <h2>Métricas</h2>
                    <p>Sugestão de projeto, um controle de pedidos para jedi, padawans e stormtroopers descolados.</p>
                    <ul class="icon-list">
                        <li><a href="#"  data-bs-toggle="modal" data-bs-target="#dlgInfoRequisitos" rel="noopener" target="_blank">Requisitos</a></li>
                        <li><a href="#"  data-bs-toggle="modal" data-bs-target="#dlgInfoRegras" rel="noopener" target="_blank" >Regras de Negócio</a></li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h2>Código Fonte</h2>
                    <p>O código fonte deste projeto pode ser encontrado no GitHub.</p>
                    <ul class="icon-list">
                    <li><a href="https://github.com/fmattoso/ProjMercos" target="_blank">Repositório deste projeto no GitHub</a></li>
                    <li><a href="https://www.linkedin.com/in/fabiano-mattoso-70983529/" target="_blank">Meu perfil no LinkedIn</a></li>
                    </ul>
                </div>
            </div>

            <div class="modal fade" id="dlgInfoRequisitos" tabindex="-1" aria-labelledby="dlgInfoRequisitosLabel" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-scrollable">
                        <!-- Corpo -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="dlgInfoRequisitosLabel">Requisitos</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Uma aplicação web simulando de forma simplificada a emissão de pedidos.</p>
                                <p>O usuário desta aplicação poderá ​criar novos pedidos e ​alterar os pedidos existentes. Portanto, é indispensável que estas informações sejam armazenadas de forma persistente.
                                   Um​ ​pedido​ ​é​ ​composto​ ​pelas​ ​seguintes​ ​informações:</p>
                                <p>Cliente: O usuário deve escolher uma opção entre os clientes pré-cadastrados no sistema (tabela​ ​1).​</p>
                                <p>Itens:​​ ​Cada​ ​item​ ​do​ ​pedido​ ​é​ ​composto​ ​pelas​ ​seguintes​ ​informações:
                                <ul><li>Produto: o usuário deve escolher uma opção entre os produtos pré-cadastrados no sistema​ ​(tabela​ ​2).​</li>
                                <li>Quantidade:​​ ​a​ ​quantidade​ ​do​ ​produto​ ​deve​ ​ser​ ​um​ ​número​ ​inteiro​ ​maior​ ​que​ ​zero.</li>
                                <li>Preço unitário: o sistema deve sugerir o preço unitário do produto, mas deve permitir que o usuário o altere (tanto para mais quanto para menos). O preço deve ter no máximo​ ​2​ ​casas​ ​decimais​ ​e​ ​precisa​ ​ser​ ​maior​ ​que​ ​zero.</li>
                                </ul>
                                <h5>Informações pré-cadastradas</h5>
                                <p>A tabelas a seguir listam as informações utilizadas no pedido que devem ser pré-cadastradas no sistema.<p>
                                <table>
                                    <caption>Clientes</caption>
                                    <thead>
                                        <tr><th>ID</th><th>Nome</th></tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>1</td><td>Darth​ ​Vader</td></tr>
                                        <tr><td>2</td><td>Obi-Wan​ ​Kenobi</td></tr>
                                        <tr><td>3</td><td>Luke​ ​Skywalker</td></tr>
                                        <tr><td>4</td><td>Imperador​ ​Palpatine</td></tr>
                                        <tr><td>5</td><td>Han​ ​Solo</td></tr>
                                    </tbody>
                                </table>
                                <table>
                                    <caption>Produtos</caption>
                                    <thead>
                                        <tr><th>ID</th><th>Nome</th><th>Preço Unitário (R$)</th><th>Múltiplo</th></tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>1</td><td>Millenium​ ​Falcon</td><td>550.000,00</td><td></td></tr>
                                        <tr><td>2</td><td>X-Wing 60.000,00</td><td>2</td><td></td></tr>
                                        <tr><td>3</td><td>Super​ ​Star​ ​Destroyer</td><td>4.570.000,00</td><td></td></tr>
                                        <tr><td>4</td><td>TIE​ ​Fighter</td><td>75.000,00</td><td>2</td></tr>
                                        <tr><td>5</td><td>Lightsaber</td><td>6.000,00</td><td>5</td></tr>
                                        <tr><td>6</td><td>DLT-19​ ​Heavy​ ​Blaster​ ​Rifle</td><td>5.800,00</td><td></td></tr>
                                        <tr><td>7</td><td>DL-44​ ​Heavy​ ​Blaster​ ​Pistol</td><td>1.500,00</td><td>10</td></tr>
                                        </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>

            <div class="modal fade" id="dlgInfoRegras" tabindex="-1" aria-labelledby="dlgInfoRegrasLabel" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-scrollable">
                        <!-- Corpo -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="dlgInfoRegras">Regras de Negócio</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <h5>Rentabilidade</h5>
                            <p>Os itens do pedido devem ser classificados em três níveis de rentabilidade, de acordo com a diferença entre o preço do item (que é informado pelo usuário) e o preço do produto​ ​(que​ ​é​ ​fixo):</p>
                            <p><dfn>Rentabilidade ótima</dfn>: quando o preço usado no pedido é maior que o preço do produto. Ex: se o preço do produto é de R$ 100, a rentabilidade será ótima se o item for​ ​vendido​ ​por​ ​R$​ ​100,01​ ​(inclusive)​ ​ou​ ​mais.</p>
                            <p><dfn>Rentabilidade boa</dfn>: quando o preço do item é no máximo 10% menor que o preço do produto. Ex: se o preço do produto é de R$ 100, a rentabilidade será boa se o item for vendido​ ​por​ ​qualquer​ ​preço​ ​entre​ ​R$​ ​90​ ​(inclusive)​ ​e​ ​R$​ ​100​ ​(inclusive).</p>
                            <p><dfn>Rentabilidade ruim</dfn>: quando o preço do item é inferior ao preço do produto menos 10%. Ex: se o preço do produto é de R$ 100, a rentabilidade será ruim se o preço for menor​ ​ou​ ​igual​ ​a​ ​R$​ ​89,99.</p>
                            <p>Quando o usuário escolher o produto para inserir no pedido, o sistema deve calcular e exibir a rentabilidade na tela. Sempre que o preço for modificado, a rentabilidade deve ser recalculada e reexibida. Itens que ficarem com rentabilidade ruim não podem ser inseridos no pedido.</p>
                            <h5>Múltiplo de venda</h5>
                            <p>Alguns produtos só podem ser vendidos em quantidades múltiplas de um determinado número. Por exemplo, o produto X-Wing só pode ser vendido em múltiplos de 2, por exemplo, 2, 4, 6, 8, etc. Já o produto Lightsaber só pode ser vendido em múltiplos de 5, ou seja, 5, 10, 15, 20 e assim por diante. Produtos que não possuem múltiplos podem ser vendidos​ ​em​ ​qualquer​ ​quantidade.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>

        </main>

        <?php include "defFooter.php" ?>
    </div>
</body>
</html>