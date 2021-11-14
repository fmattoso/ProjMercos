<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <?php include "defHeader.php" ?>
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
                <a href="/newOrder.php" class="btn btn-primary btn-lg px-4">Novo Pedido</a>
                <a href="/editOrder.php" class="btn btn-primary btn-lg px-4">Editar Pedido</a>
            </div>

            <hr class="col-3 col-md-2 mb-5">

            <div class="row g-5">
                <div class="col-md-6">
                    <h2>Métricas</h2>
                    <p>Sugestão de projeto, um controle de pedidos para jedi, padawans e stormtroopers descolados.</p>
                    <ul class="icon-list">
                        <li><a href="https://github.com/twbs/bootstrap-npm-starter" rel="noopener" target="_blank">Requisitos</a></li>
                        <li class="text-muted">Regras de Negócio</li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h2>Código Fonte</h2>
                    <p>O código fonte deste projeto pode ser encontrado no GitHub.</p>
                    <ul class="icon-list">
                    <li><a href="https://github.com/fmattoso/ProjMercos">Repositório deste projeto no GitHub</a></li>
                    <li><a href="https://www.linkedin.com/in/fabiano-mattoso-70983529/">Meu perfil no LinkedIn</a></li>
                    </ul>
                </div>
            </div>
        </main>

        <?php include "defFooter.php" ?>
    </div>

    <script src="/bootstrap5/js/bootstrap.bundle.min.js"></script>

</body>
</html>