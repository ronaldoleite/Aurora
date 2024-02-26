<?php require_once 'Views/Shared/Header.php'; ?>
<section class="fopa">
    <div class="container flex justify-center">
        <div class="box-4 animated bounceInDown bg-branco">
            <form action="#" method="POST" class="formFinalizar pd-20 shadow-down mg-t-4  radius">
                <h1 class="txt-c espaco-letra mg-b-2 fnc-preto-1">Finalizar Venda </h1>

                <input type="hidden" name="id" class="" value="<?php if ($id != "") echo $venda->getId(); ?>" readonly="" />
                <input type="hidden" name="data" class="" value="<?php if ($id != "") echo "{$retorno[0]->DATAVENDA}"; ?>" readonly="" />
                <input type="hidden" name="qtde" class="" value="<?php if ($id != "") echo "{$retorno[0]->QUANTIDADEITENS}"; ?>" readonly="" />
                <input type="hidden" name="valor" class="" value="<?php if ($id != "") echo $retorno[0]->VALOR; ?>" readonly="" />
                <input type='hidden' name='usuario' class='' value='<?php if ($id != "") echo $retorno[0]->USUARIO; ?>' readonly=''/>
                
                <label class="fnc-preto-1"> Atribuir à um cliente. </label>
                <select type='text' name='cliente' class='mg-b-3 bg-branco fonte-open-sans fonte16 fnc-cinza-claro espaco pd-l-1'>
                    <?php
                    if (count($cli) > 0) {
                        foreach ($cli as $dados) {
                            echo "<option value='{$dados->ID}' selected>{$dados->NOME}</option>";
                        }
                    }
                    ?>
                </select>

                <label class="fnc-preto-1"> Escolher a forma de pagamento </label>
                <select type='text' name='formapag' class='mg-b-3 bg-branco fonte-open-sans fonte16 fnc-cinza-claro espaco pd-l-1'>
                    <?php
                    if (count($fp) > 0) {
                        foreach ($fp as $pgto) {
                            echo "<option value='{$pgto->ID} '>{$pgto->DESCRICAO}</option>";
                        }
                    }
                    ?>
                </select>

                <label class="fnc-preto-1"> Quantidade de parcelas</label>
                <select name='parcela' class='bg-branco fonte-open-sans fonte16 fnc-cinza-claro espaco pd-l-1'>
                    <?php
                    for ($i = 1; $i <= 20; $i++) { ?>
                        <option value="<?php echo $i; ?>"> <?php echo "<h2 class='fonte-open-sans espaco-letra fw-bold'>" . $i . " de  R$" . number_format($retorno[0]->VALOR / $i, 2, ',', '.') . "</h2"; ?> </option>
                    <?php   }
                    ?>
                </select>

                <input type="submit" name="Cadastrar" value="CONFIRMAR" class="w-100 bg-p1-cinza fw-bold sem-borda fnc-cinza mg-t-4" />


            </form>
        </div>
    </div>
    <div class='limpar'></div>
</section>