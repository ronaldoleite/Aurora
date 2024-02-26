<?php require_once 'Views/Shared/Header.php'; ?>
<div class="container">
    <?php
    $url = $_SERVER["REQUEST_URI"];
    $controle = str_replace('Controller', '', $_GET['controller']);
    $metodo   = $_GET['metodo'];
    ?>
    <!-- Menu Lateral -->
    <nav class="menu-lateral bg-p7-deep-grape box-2 ">
        <div class=" mg-b-3 bg-branco radius mg-t-1 pd-10">
            <div class="">
                <i class="fa-solid fa-handshake-angle fonte16 fnc-preto-1"></i>
                <span class="fonte12 fnc-preto-1 espaco-letra fonte-fredoca mg-l-1">
                    Olá <?php echo $_SESSION['nome'] ?>, seja bem vindo!
                </span>
            </div>
        </div>

        <ul class="mg-l-2">

            <li class="mg-b-1 pd-b-1">
                <!-- <i class="fas fa-tags fonte16 fnc-azul"></i> -->
                <i class="fa-brands fa-shopify fonte16 fnc-sucesso"></i>
                <a href="index.php?controller=CarrinhoController&metodo=InserirCarrinho" class="pd-10 fonte12 fnc-sucesso espaco-letra fonte-fredoca mg-l-1">PDV</a>
            </li>
            <li class="mg-b-1 pd-b-1">
                <!-- <i class="fas fa-tags fonte16 fnc-azul"></i> -->
                <i class="fa-solid fa-cash-register fonte16 fnc-laranja"></i>
                <a href="index.php?controller=CaixasController&metodo=FecharCaixa" class="pd-10 fonte12 fnc-laranja espaco-letra fonte-fredoca mg-l-1">Fechar Caixa</a>
            </li>

            <li class="mg-b-1 pd-b-1">
                <i class="fas fa-tags fonte16 fnc-cinza-claro"></i>
                <a href="index.php?controller=CategoriaController&metodo=Listar" class="pd-10 fonte12 fnc-cinza-claro espaco-letra fonte-fredoca mg-l-1">Categoria</a>
            </li>

            <li class="mg-b-1 pd-b-1">
                <i class="fas fa-users fonte16 fnc-cinza-claro"></i>
                <a href="index.php?controller=ClienteController&metodo=Listar" class="pd-10 fonte12 fnc-cinza-claro espaco-letra fonte-fredoca mg-l-1">Cliente</a>
            </li>

            <li class="mg-b-1 pd-b-1">
                <i class="fas fa-file-signature fonte16 fnc-cinza-claro"></i>
                <a href="index.php?controller=ProdutoController&metodo=Listar" class="pd-10 fonte12 fnc-cinza-claro espaco-letra fonte-fredoca mg-l-1">Produto</a>
            </li>

            <li class="mg-b-1 pd-b-1">
                <i class="fa-solid fa-user-pen fonte16 fnc-cinza-claro"></i>
                <a href="index.php?controller=UsuarioController&metodo=Listar" class="pd-10 fonte12 fnc-cinza-claro espaco-letra fonte-fredoca mg-l-1">Usuario</a>
            </li>

            <li class="mg-b-1 pd-b-1">
                <i class="fa-solid fa-user-tie fonte16 fnc-cinza-claro"></i>
                <a href="index.php?controller=FornecedorController&metodo=Listar" class="pd-10 fonte12 fnc-cinza-claro espaco-letra fonte-fredoca mg-l-1">Fornecedor</a>
            </li>

            <li class="mg-b-1 pd-b-1">
                <i class="fa-solid fa-store fonte16 fnc-cinza-claro"></i>
                <a href="index.php?controller=EstabelecimentoController&metodo=Listar" class="pd-10 fonte12 fnc-cinza-claro espaco-letra fonte-fredoca mg-l-1">Empresa</a>
            </li>

            <li class="mg-b-1 pd-b-1">
                <i class="fa-solid fa-right-from-bracket fonte16 fnc-branco"></i>
                <a href="index.php?controller=UsuarioController&metodo=sair" class="pd-10 fonte12 fnc-branco espaco-letra fonte-fredoca mg-l-1">Logout</a>
            </li>

        </ul>

    </nav>

    <section class="box-10 bg-branco mg-t-1 shadow-down radius">
        <div class="box-12 bg-p3-paper limpar mg-b-4 shadow-down">
            <ul class="flex justify-end">
                <li>
                    <i class="fa-solid fa-house fonte24 mg-r-1"></i>
                    <a href="index.php?controller=PainelController&metodo=Index" class="">
                        Home
                    </a>
                </li>
            </ul>
        </div>

        <?php
        require_once "Views/" . $controle . "/" . $metodo . ".php";
        ?>

        <?php

        if ($controle == "Painel" && $metodo == "Index") { ?>
            <section class="box-12">
                <header>
                    <div class="box-12 flex justify-between">

                        <div class="box-3 shadow-down bg-p3-paper pd-10 item-centro">
                            <span class="box-3"><i class="fa-solid fa-dollar-sign fonte-roboto fonte48 bold"></i></span>
                            <div class="box-9">
                                <h3 class="fonte12 espaco-letra fonte-montserrat txt-e mg-b-1">Vendas do mês atual...</h3>
                                <h4 class="fonte16 espaco-letra fonte-montserrat fw-bold txt-c radius bg-branco pd-5"> R$ <?php echo $Formater->converterMoeda($getVenda[0]->TOTALVENDAMES); ?> </h4>
                            </div>
                        </div>

                        <div class="box-3 shadow-down bg-p3-paper pd-10 item-centro">
                            <span class="box-3"><i class="fa-solid fa-dollar-sign fonte-roboto fonte48 bold"></i></span>
                            <div class="box-9">
                                <h3 class="fonte12 espaco-letra fonte-montserrat txt-e mg-b-1">Vendas do mês Anterior...</h3>
                                <h4 class="fonte16 espaco-letra fonte-montserrat fw-bold txt-c radius bg-branco pd-5"> R$ <?php echo $Formater->converterMoeda($getVenda[0]->TOTALVENDAMESANTERIOR); ?> </h4>
                            </div>
                        </div>

                        <div class="box-3 shadow-down bg-p3-paper pd-10 item-centro">
                            <span class="box-3"><i class="fa-solid fa-dollar-sign fonte-roboto fonte48 bold"></i></span>
                            <div class="box-9">
                                <h3 class="fonte12 espaco-letra fonte-montserrat txt-e mg-b-1">Vendas no ano de... <?php echo date('Y'); ?></h3>
                                <h4 class="fonte16 espaco-letra fonte-montserrat fw-bold txt-c radius bg-branco pd-5"> R$ <?php echo $Formater->converterMoeda($getVenda[0]->TOTALVENDANOANO); ?> </h4>
                            </div>
                        </div>

                    </div>
                </header>

                <article class="board mg-t-4 box-12">
                    <div class="wd-100">
                        <!-- Grafico de barras com os 10 produtos mais vendidos -->
                        <div class="box-12 mg-b-8">
                            <div class="box-12 hg-chart shadow-down">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                        <!-- Grafico pizza com sumarizando os tipos de pagamentos -->
                        <div class="box-6">
                            <div class="box-12 hg-chart shadow-down">
                                <canvas id="myChartPizza"></canvas>
                            </div>
                        </div>

                    </div>
                </article>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script type="text/javascript" src="lib/js/chart.js"></script>
            </section>
        <?php   } ?>
    </section>
</div>
<!--  Sessão destinada a cadastro  -->
<?php require_once 'Views/Shared/Footer.php'; ?>