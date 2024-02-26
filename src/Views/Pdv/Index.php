<?php include_once "Views/Shared/Header.php"; ?>
<div class="body-car wd-100 hg-full bg-p7-bluebarry">
    <div class="container">
        <div class="box-12 mg-t-1 radius">
            <form method='POST' class='wd-50 bg-branco radius'>
                <input type="text" name="codigo" class='enviaProd pd-l-1 fnc-preto sem-borda' placeholder="Digite o Codigo do produto" />
            </form>
            <div class="w-50 flex justify-end"> <a href="index.php?controller=PainelController&metodo=Index" class="btn-painel">Painel</a></div>
        </div>
        <div class="limpar"></div>
    </div>
    <!--Carrinhode compras -->
    <section class='carrinho float-n'>
        <div class='container'>
            <div class='box-12 flex justify-center bg-branco radius hg-90v radius'>
                <?php
                $total = 0;
                $totalDesc = 0;
                if (isset($_SESSION["carrinho"]) && count($_SESSION["carrinho"]) > 0) {
                ?>
                    <div class="limpar"></div>
                    <form action='#' method='POST' class="box-12 radius bg-branco shadow-down">

                        <table class="box-8 grid wd-100">
                            <tr class="car-descricao">
                                <th class='pd-t-1 pd-b-1 radius txt-c fnc-cinza fonte14 uppercase fonte-poppin fw-bold espaco-letra'>Código</th>
                                <th class='pd-t-1 pd-b-1 radius txt-c fnc-cinza fonte14 uppercase fonte-poppin fw-bold espaco-letra'>Produto</th>
                                <th class='pd-t-1 pd-b-1 radius txt-c fnc-cinza fonte14 uppercase fonte-poppin fw-bold espaco-letra'>Preço Unidade</th>
                                <th class='pd-t-1 pd-b-1 radius txt-c fnc-cinza fonte14 uppercase fonte-poppin fw-bold espaco-letra'>Desconto</th>
                                <th class='pd-t-1 pd-b-1 radius txt-c fnc-cinza fonte14 uppercase fonte-poppin fw-bold espaco-letra'>Quantidade</th>
                                <th class='pd-t-1 pd-b-1 radius txt-c fnc-cinza fonte14 uppercase fonte-poppin fw-bold espaco-letra'>Subtotal</th>
                                <th class='pd-t-1 pd-b-1 radius txt-c fnc-cinza fonte14 uppercase fonte-poppin fw-bold espaco-letra'>Excluir</th>
                                <th class=''></th>
                            </tr>
                            <?php foreach ($_SESSION["carrinho"] as $lin => $val) {  ?>
                                <tr class='car-mobile zebra'>
                                    <td class='hg-40 txt-c fnc-cinza-claro espaco-letra '>
                                        <?php echo $_SESSION['carrinho'][$lin]['codS']; ?>
                                    </td>

                                    <td class='nome txt-c fnc-cinza-claro espaco-letra'>
                                        <!-- <span>Produto </span>&nbsp;&nbsp;&nbsp; -->
                                        <?php echo $_SESSION['carrinho'][$lin]['nomeS']; ?>
                                    </td>

                                    <td class='preco txt-c fnc-cinza-claro fonte12 espaco-letra'>
                                        <!-- <span>Preço </span>&nbsp;&nbsp;&nbsp; -->
                                        R$ <?php echo number_format($_SESSION['carrinho'][$lin]['precoS'], 2, ',', '.'); ?>
                                    </td>

                                    <td class='desc txt-c fnc-cinza-claro fonte12 espaco-letra'>
                                        <!-- <span> Desc </span>&nbsp;&nbsp;&nbsp; -->
                                        <?php echo $_SESSION['carrinho'][$lin]['descS'] ?>%
                                    </td>

                                    <td class='txt-c fnc-cinza-claro fonte12 espaco-letra pd-10'>
                                        <!-- <span class='pd-t-10'> Qtde </span>&nbsp;&nbsp;&nbsp; -->
                                        <input class='mg-auto qtde fnc-cinza-claro txt-c fonte12' rel='<?php echo $lin; ?>' type='text' name='qtde' size='2' value='<?php echo $_SESSION['carrinho'][$lin]['qtdeS']; ?>' />
                                    </td>

                                    <?php
                                    //calcula o subtotal
                                    $subtotal = $_SESSION["carrinho"][$lin]["precoS"] * $_SESSION["carrinho"][$lin]["qtdeS"];
                                    //calcula o desconto
                                    $desc = $subtotal * $_SESSION['carrinho'][$lin]['descS'] / 100;
                                    //tira do subtotal o desconto
                                    $subtotal = $subtotal - $desc;
                                    //acumula o total
                                    $total = $total + $subtotal;
                                    $totalDesc = $totalDesc + $desc;
                                    ?>
                                    <td class='subTotal fonte12 fnc-cinza-claro txt-c fw-bold'>
                                        R$ <?php echo number_format($subtotal, 2, ',', '.'); ?>
                                    </td>
                                    <td class="txt-c">
                                        <a href='index.php?controller=BaseController&metodo=validarExclusaoProdCarrinho&linha=<?php echo $lin; ?>'>
                                            <i class="fa-solid fa-trash-can fonte24 fnc-erro txt-c"></i>                                            
                                        </a>
                                        <a href="index.php?controller=ProdutoController&metodo=Index&id=<?php echo $_SESSION['carrinho'][$lin]['id']; ?>"> <i class="fa-regular fa-pen-to-square mg-l-1 fonte24 fnc-laranja"></i> </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                        <div class='box-4  bg-p3-paper'>
                           
                            <!-- Checkbox para selecionar a forma de pagamento da compra atual -->
                            <!-- <div class="limpar wd-100 mg-t-2 form-pag">
                                <h2 class='fonte16 pd-10 fw-400 fonte-open espaco-letra txt-c bg-p1-cinza mg-b-2'>Forma de pagamento </h2>

                                <?php if(count($getFp)>0){ 
                                    foreach($getFp as $dados) {?>
                                    <?php if($dados->ID == 1) {?>
                                <div class="box-3 hg-100 bg-p7-marine txt-c relative pd-10">
                                    <h2 class="fonte12 espaco-letra fnc-branco pd-10 txt-c">Dinheiro</h2>
                                    <i class="fa-solid fa-money-bill-wave fnc-branco fonte40 txt-c"></i>
                                    <input type="checkbox" name="form-pag" value="<?php echo $dados->ID?>" />

                                </div>
                                <?php }?>
                                <?php if($dados->ID == 2) {?>
                                <div class="box-3 box-2 hg-100 bg-p1-amarelo  txt-c relative">
                                    <h2 class="fonte12 espaco-letra fnc-branco pd-10 txt-c">Cart Debito</h2>
                                    <i class="fa-solid fa-credit-card fnc-branco fonte40 txt-c"></i>
                                    <input type="checkbox" name="form-pag" value="<?php echo $dados->ID?>" />
                                </div>
                                <?php }?>
                                <?php if($dados->ID == 3) {?>

                                <div class="box-3 box-2 hg-100 bg-p7-grape2 txt-c relative">
                                    <h2 class="fonte12 espaco-letra fnc-branco pd-10 txt-c">Cart Credito</h2>
                                    <i class="fa-solid fa-credit-card fnc-branco fonte40 txt-c"></i>
                                    <input type="checkbox" name="form-pag" value="<?php echo $dados->ID?>" />
                                </div>
                                <?php }?>
                                <?php if($dados->ID == 5) {?>

                                <div class="box-3 box-2 hg-100 bg-p7-papaya2 txt-c relative">
                                    <h2 class="fonte12 espaco-letra fnc-branco pd-10 txt-c">Crediario loja</h2>
                                    <i class="fa-solid fa-money-check-dollar fnc-branco fonte40 txt-c"></i>
                                    <input type="checkbox" name="form-pag" value="<?php echo $dados->ID?>" />
                                </div>
                                <?php }?>
                                <?php } } ?>
                                <div class="limpar"></div>
                            </div> -->

                            <!-- caixa de seleção do cliente a ser tribuido a venda atual -->
                            <!-- <div class="limpar wd-100 mg-t-6">
                                <h2 class='fonte16 pd-10 fw-400 fonte-open espaco-letra txt-c bg-p1-cinza mg-b-2'>Atribuir Cliente <i class="fa-regular fa-user fnc-cinza mg-l-1"></i></h2>
                                <select name="cliente" id="">
                                    <option value=""> Atribua um cliente a esta venda...</option>
                                    <?php
                                    
                                    if (count($getC) > 0) {
                                        $cliente = 0;
                                        foreach($getC as $dados){
                                            echo "<option value='{$dados->ID}' class='enviaCliente' selected>{$dados->NOME} </option>";
                                        }                                      
                                    }
                                    ?>
                                </select>

                            </div> -->

                            <div class="wd-100 mg-t-4">
                                <h2 class='fonte16 pd-10 fw-400 fonte-open espaco-letra txt-c bg-p1-cinza mg-b-2'>Resumo da compra </h2>
                                <h3 class=" pd-l-1 pd-r-1 mg-b-2 fonte-montserat fonte12 espaco-letra flex justify-between">Sub-total <span class=""> R$ <?php $sub = $total + $totalDesc;
                                                                                                                                                            echo number_format($sub, 2, ' ,', '.'); ?></span></h3>
                                <h3 class=" pd-l-1 pd-r-1 mg-b-2 fonte-montserat fonte12 espaco- flex justify-between">Descontos <span class=""> R$ <?php echo number_format($totalDesc, 2, ' ,', '.') ?></span></h3>
                                <h2 class='fonte16 pd-10 fw-500 fonte-montserat espaco-letra txt-c pd-t-2 bg-p1-cinza fnc-preto-1 flex justify-between'>Total a pagar: <span class="fw-bold fonte20 fonte-fredoca"> R$ <?php echo number_format($total, 2, ' ,', '.'); ?></span></h2>
                                <input type='hidden' name='total' value='R$ <?php echo number_format($total, 2, ' ,', '.'); ?> ' class='shadow-down fnc-branco fonte28 bg-p2-azul fonte-poppin fw-bold txt-c mg-t-1' />

                            </div>
                            <a class='btn-100 block wd-100 bg-p7-electric fnc-branco' href='index.php?controller=CarrinhoController&metodo=FinalizarCarrinho'> Finalizar Venda </a>
                               
                               <!-- <input type="submit" value="Finalizar Carrinho" class="btn-100 bg-p7-electric fnc-branco"> -->

                        </div>
                    </form>

                <?php
                } else {
                    echo "<h1 class='txt-c mg-t-12 fonte100 fonte-roboto espaco-letra caixa-disponivel'>Caixa disponivel!</h1>";
                }
                ?>
            </div>
        </div>
        <div class='limpar'></div>
    </section>
</div>