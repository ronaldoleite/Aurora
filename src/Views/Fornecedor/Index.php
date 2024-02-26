<div class="form-cad bg-branco pd-10 box-12">
<div class="box-12 flex justify-start limpar">
        <div class="box-8">
            <?php if (isset($id) && $id != '') {
                echo "<h1 class='fonte32 fonte-roboto fw-300 mg-b-2'><i class='fa-solid fa-user-tie fonte30 fnc-azul mg-r-1'></i> Editar Fornecedor</h1>";
            } else {
                echo "<h1 class='fonte32 fonte-roboto fw-300 mg-b-2'><i class='fa-solid fa-user-tie fonte30 fnc-azul mg-r-1'></i> Cadastrar Fornecedor</h1>";
            }
            ?>
        </div>
    </div>
    <div class="divider limpar"></div>

    <form action="" method="post" class="">

        <div class="box-12">
            <input type="hidden" name="id" value="<?php if (isset($id) && $id != '') echo $return[0]->ID;  ?>" />
        </div>

        <div class="box-6">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php if (isset($id) && $id != '') echo $return[0]->NOME; ?>">
        </div>

        <div class="box-6">
            <label>Razão Social:</label>
            <input type="text" name="razaosocial" value="<?php if (isset($id) && $id != '') echo $return[0]->RAZAOSOCIAL; ?>">
        </div>

        <div class="box-3">
            <label>Contato:</label>
            <input type="text" name="contato" maxlength="14" onkeypress="formata_mascara(this, '## # ####-####')" value="<?php if (isset($id) && $id != '') echo $return[0]->CONTATO; ?>">
        </div>

        <div class="box-3">
            <label>E-mail:</label>
            <input type="text" name="email" value="<?php if (isset($id) && $id != '') echo $return[0]->EMAIL; ?>">
        </div>

        <div class="box-3">
            <label>CEP:</label>
            <input type="text" name="cep" onkeypress="formata_mascara(this, '#####-###')" onblur="getDadosEnderecoPorCEP(this.value)" value="<?php if (isset($id) && $id != '') echo $return[0]->CEP; ?>">
        </div>

        <div class="box-2">
            <label>UF:</label>
            <input type="text" name="uf" id="uf" value="<?php if (isset($id) && $id != '') echo $return[0]->UF; ?>">
        </div>

        <div class="box-6">
            <label>Cidade:</label>
            <input type="text" name="cidade" id="cidade" value="<?php if (isset($id) && $id != '') echo $return[0]->CIDADE; ?>">
        </div>

        <div class="box-6">
            <label>Bairro:</label>
            <input type="text" name="bairro" id="bairro" value="<?php if (isset($id) && $id != '') echo $return[0]->BAIRRO; ?>">
        </div>

        <div class="box-6">
            <label>Logradouro:</label>
            <input type="text" name="logradouro" id="endereco" value="<?php if (isset($id) && $id != '') echo $return[0]->LOGRADOURO; ?>">
        </div>


        <div class="box-12 mg-b-2 mg-t-2    ">
            <input type="submit" value=" Salvar" class="btn btn-borda-azul" />
        </div>

    </form>
</div>