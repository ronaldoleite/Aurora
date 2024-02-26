<?php
//echo "<pre class='fonte16'>"; var_dump($cre);  echo "</pre>";
?>
<section class='canva shadow-down mg-t-2 bg-branco radius'>
    <div class="container">
        <div class="box-12">

            <?php
            if (isset($cre) && count($cre) > 0) {
                echo "<h1 class='fonte32 fonte-roboto fw-300 mg-b-6'>
                <i class='fas fa-users fonte28 fnc-cinza mg-r-1'></i>
                Crediario de {$cre[0]->NOME}...
            </h1>";

                $contador = 1;
                foreach ($cre as $dados) { ?>

                    <ul class="box-3 shadow-down pd-10 bg-p5-neutral radius">
                        <h2 class="fonte14 espaco-letra mg-b-1 fonte-open fnc-preto-1 "> Crediário <?php echo $contador; ?> </h2>

                        <li class=" fonte12 mg-b-02 ">
                            <span class="fw-bold espaco-letra"> Compra realizada em: </span>
                            <?php echo $Formater->formatarData($dados->DATAVENDA); ?>
                        </li>

                        <li class="fonte12 mg-b-02">
                            <span class="fw-bold espaco-letra"> Valor da Venda </span>
                            <?php echo "R$ " . $Formater->converterMoeda($dados->VALORTOTAL); ?>
                        </li>

                        <li class="fonte12 mg-b-02">
                            <span class="fw-bold espaco-letra"> Parcelas</span>
                            <?php echo $dados->QTDEPARCELAS; ?>
                        </li>

                        
                        <li class="fonte12 mg-b-02">
                            <span class="fw-bold espaco-letra"> Valor das Parcelas</span>
                            <?php echo "R$ " . $Formater->converterMoeda($dados->VALORTOTAL / $dados->QTDEPARCELAS) ; ?>
                        </li>

                        <li class="fonte12 mg-b-02">
                            <span class="fw-bold espaco-letra "> Parcelas Pagas</span>
                            <?php echo $dados->PARCELASPAGAS . " de " . $dados->QTDEPARCELAS; ?>
                        </li>

                        <li class="fonte12 mg-b-02">
                            <span class="fw-bold espaco-letra "> Valor pago </span>
                            <?php echo "R$ " . $Formater->converterMoeda($dados->VALORTOTALPAGO); ?>
                        </li>

                        <li class="fonte12 mg-b-02">
                            <span class="fw-bold espaco-letra "> Valor em aberto </span>
                            <?php echo "R$ " . $Formater->converterMoeda($dados->VALORTOTAL - $dados->VALORTOTALPAGO); ?>
                        </li>

                        <?php
                        if ($dados->PARCELASPAGAS < $dados->QTDEPARCELAS) { ?>

                            <li class='radius txt-c pd-10 fnc-branco fonte12 mg-b-02  bg-p1-amarelo mg-t-2 '> Em aberto </li>
                            
                                <form action="index.php?controller=CrediarioController&metodo=PagarCrediario" method="POST" class="pd-10">
                                    <h1 class="fonte14 espaco-letra fonte-montserrat txt-c mg-b-2">Efetuar Pagamento</h1>
                                    <div class="divider mg-b-1"></div>

                                    <input type="hidden" name="venda" value="<?php if ($id != '') { echo $dados->VENDA; } ?>" class=""/>
                                    <input type="hidden" name="cliente" value="<?php if ($id != '') { echo $dados->IDCLIENTE;} ?>" class=""/>
                                    <input type="hidden" name="parcelaspagas" value="<?php if ($id != '') { echo $dados->PARCELASPAGAS; } ?>" class=""/>
                                    
                                    
                                    <label> Valor que deseja pagar:</label>
                                    <input type="text" name="valorpago" class="mg-b-2"/>

                                    <input type="submit" class="btn-100 bg-p2-azul fnc-branco uppercase" value="Confirmar valor"/>

                                </form>
                            <!-- <li class='radius mg-b-02 bg-p7-electric mg-t-1'> <a href='index.php?controller=CrediarioController&metodo=PagarCrediario&id={$dados->VENDA}&parcelaspagas={$dados->PARCELASPAGAS}' class='btn-100 fnc-branco'> Efetuar pagamento </a> </li> -->
                        <?php } else {
                            echo "<li class='radius txt-c pd-t-1 fnc-branco fonte12 mg-b-02 hg-40 bg-p2-verde'>Pago valor total </li>";
                        }

                        ?>

                    </ul>

                <?php $contador++;
                }
            } else { ?>
                <div class="container">
                    <div class="box-12 flex justify-center item-centro mg-t-10">
                        <h1 class="fonte16 espaco-letra fonte-fredoca">Cliente não possui nenhum Crediário! </h1>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>

</section>