<div class="form-cad bg-branco pd-10 box-12">
    <div class="box-12 flex justify-start limpar">
        <div class="box-8">
            <?php if (isset($id) && $id != '') {
                echo "<h1 class='fonte32 fonte-roboto fw-300 mg-b-2'><i class='fas fa-users fonte30 fnc-azul mg-r-1'></i> Editar Cliente</h1>";
            } else {
                echo "<h1 class='fonte32 fonte-roboto fw-300 mg-b-2'><i class='fas fa-users fonte30 fnc-azul mg-r-1'></i> Cadastrar Cliente</h1>";
            }
            ?>
        </div>
    </div>
    <div class="divider limpar"></div>

    <form action="" method="post" class="">

        <div class="box-12">
            <input type="hidden" name="id" value="<?php if (isset($id) && $id != '') echo $return[0]->ID;  ?>" />
        </div>

        <div class="box-12">
            <input type="hidden" name="codigo" value="" />
        </div>

        <div class="box-6">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php if (isset($id) && $id != '') echo $return[0]->NOME; ?>" />
        </div>

        <div class="box-3">
            <label>Cpf:</label>
            <input type="text" name="cpf" onkeypress="formata_mascara(this, '###.###.###-##')" value="<?php if (isset($id) && $id != '') echo $return[0]->CPF; ?>" maxlength="14" />
        </div>

        <div class="box-3">
            <label>Rg:</label>
            <input type="text" name="rg" onkeypress="formata_mascara(this, '##.###.###-#')" value="<?php if (isset($id) && $id != '') echo $return[0]->RG; ?>" maxlength="13" />
        </div>

        <div class="box-3">
            <label>Cep:</label>
            <input type="text" name="cep" onkeypress="formata_mascara(this, '#####-###')" onblur="getDadosEnderecoPorCEP(this.value)" value="<?php if (isset($id) && $id != '') echo $return[0]->CEP; ?>" maxlength="9" />
        </div>

        <div class="box-6">
            <label>Cidade</label>
            <input type="text" name="cidade" id="cidade" value="<?php if (isset($id) && $id != '') echo $return[0]->CIDADE; ?>" />
        </div>

        <div class="box-6">
            <label>Bairro</label>
            <input type="text" name="bairro" id="bairro" value="<?php if (isset($id) && $id != '') echo $return[0]->BAIRRO; ?>" />
        </div>

        <div class="box-6">
            <label>Endereço</label>
            <input type="text" name="logradouro" id="endereco" value="<?php if (isset($id) && $id != '') echo $return[0]->LOGRADOURO; ?>" />
        </div>

        <div class="box-2">
            <label>Número</label>
            <input type="text" name="numero" value="<?php if (isset($id) && $id != '') echo $return[0]->NUMERO; ?>" />
        </div>

        <div class="box-2">
            <label>Uf</label>
            <input type="text" name="uf" id="uf" value="<?php if (isset($id) && $id != '') echo $return[0]->UF; ?>" />
        </div>

        <div class="box-3">
            <label>Telefone:</label>
            <input type="text" name="telefone" onkeypress="formata_mascara(this, '## ####-####')" value="<?php if (isset($id) && $id != '') echo $return[0]->TELEFONE; ?>" maxlength="12" />
        </div>

        <div class="box-3">
            <label>Celular:</label>
            <input type="text" name="celular" onkeypress="formata_mascara(this, '## #####-####')" value="<?php if (isset($id) && $id != '') echo $return[0]->CELULAR; ?>" maxlength="13" />
        </div>


        <div class="sexo box-12 mg-t-2 mg-b-2 bg-p5-sky pd-20">
            <label>Sexo: </label>
            <div class="flex">
                <?php if (isset($id) && $id != "") { ?>
                    <span class="fonte-poppin fonte16 fnc-preto espaco-letra"> Masculino: </span> <input type="radio" name="sexo" value="M" class="fnc-cinza" />
                    <span class="fonte-poppin fonte16 fnc-preto espaco-letra"> Feminino: </span> <input type="radio" name="sexo" value="F" class="fnc-cinza" />
                <?php } else { ?>
                    <span class="fonte-poppin fonte16 fnc-preto espaco-letra"> Masculino: </span> <input type="radio" name="sexo" value="M" class="fnc-cinza" />
                    <span class="fonte-poppin fonte16 fnc-preto espaco-letra"> Feminino: </span> <input type="radio" name="sexo" value="F" class="fnc-cinza" />
                <?php } ?>
            </div>
        </div>

        <div class="box-4">
            <label class="capitalize">Emprego atual:</label>
            <input type="text" name="empregoatual" value="<?php if (isset($id) && $id != '') echo $return[0]->EMPREGOATUAL; ?>" />
        </div>

        <div class="box-4">
            <label class="capitalize">Renda:</label>
            <input type="text" name="renda" value="<?php if (isset($id) && $id != '') echo 'R$ ' . $Formater->converterMoeda($return[0]->RENDA); ?>" />
        </div>

        <div class="box-4">
            <label class="capitalize">limite:</label>
            <input type="text" name="limite" value="<?php if (isset($id) && $id != '') echo 'R$ ' . $Formater->converterMoeda($return[0]->LIMITE); ?>" />
        </div>


        <div class="box-6">
            <label>Nome da Mãe:</label>
            <input type="text" name="nomemae" value="<?php if (isset($id) && $id != '') echo $return[0]->NOMEMAE; ?>" />
        </div>

        <div class="box-12">
            <input type="hidden" name="ativo" value="S" />
        </div>


        <div class="box-12 mg-b-2 mg-t-2    ">
            <input type="submit" value=" Salvar" class="btn btn-borda-azul" />
        </div>

    </form>
</div>