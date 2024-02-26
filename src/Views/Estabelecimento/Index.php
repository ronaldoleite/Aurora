<div class="form-cad bg-branco pd-10 box-12">
<div class="box-12 flex justify-start limpar">
        <div class="box-8">
            <?php if (isset($id) && $id != '') {
                echo "<h1 class='fonte32 fonte-roboto fw-300 mg-b-2'><i class='fa-solid fa-store fonte30 fnc-azul mg-r-1'></i> Editar Estabelecimento</h1>";
            } else {
                echo "<h1 class='fonte32 fonte-roboto fw-300 mg-b-2'><i class='fa-solid fa-store fonte30 fnc-azul mg-r-1'></i> Cadastrar Estabelecimento</h1>";
            }
            ?>
        </div>
    </div>
    <div class="divider limpar"></div>
            <form action="" method="post" class="">

                <div class="box-12">
                    <input type="hidden" name="id" value="<?php if(isset($id) && $id != '') echo $return[0]->ID;  ?>" />
                </div>

                <div class="box-6">
                    <label>Nome:</label>
                    <input type="text" name="nome" value="<?php if (isset($id) && $id != '') echo $return[0]->NOME; ?>">
                </div>

                <div class="box-2">
                    <label>Cep:</label>   
                    <input type="text" name="cep"  onkeypress="formata_mascara(this, '#####-###')" onblur="getDadosEnderecoPorCEP(this.value)"  maxlength="9" value="<?php if (isset($id) && $id != '') echo $return[0]->CEP; ?>">                 
                </div>

                <div class="box-4">
                    <label>Cidade:</label>   
                    <input type="text" name="cidade" id="cidade" value="<?php if (isset($id) && $id != '') echo $return[0]->CIDADE; ?>">                 
                </div>
                
                <div class="box-4">
                    <label>Rua:</label>   
                    <input type="text" name="logradouro" id="endereco" value="<?php if (isset($id) && $id != '') echo $return[0]->LOGRADOURO; ?>">                 
                </div>

                <div class="box-2">
                    <label>Número:</label>   
                    <input type="text" name="numero" id="numero" value="<?php if (isset($id) && $id != '') echo $return[0]->NUMERO; ?>">                 
                </div>

                <div class="box-2">
                    <label>Uf</label>   
                    <input type="text" name="uf" id="uf" value="<?php if (isset($id) && $id != '') echo $return[0]->UF; ?>">                 
                </div>

                <div class="box-4">
                    <label>Bairro:</label>   
                    <input type="text" name="bairro" id="bairro" value="<?php if (isset($id) && $id != '') echo $return[0]->BAIRRO; ?>">                 
                </div>

                <div class="box-4">
                    <label>Contato:</label>   
                    <input type="text" name="telefone" onkeypress="formata_mascara(this, '## # ####-####')" maxlength="14" value="<?php if (isset($id) && $id != '') echo $return[0]->TELEFONE; ?>">                 
                </div>

                <div class="box-4">
                    <label>CNPJ:</label>   
                    <input type="text" name="cnpj" onkeypress="formata_mascara(this, '##.###.###/####-##')" maxlength="18" value="<?php if (isset($id) && $id != '') echo $return[0]->CNPJ; ?>">                 
                </div>

                <div class="box-4">
                    <label>Inscrição estadual:</label>   
                    <input type="text" name="ie" onkeypress="formata_mascara(this, '##.###.###/####-##')" maxlength="18" value="<?php if (isset($id) && $id != '') echo $return[0]->IE; ?>">                 
                </div>

                <div class="box-4">                     
                    <input type="hidden" name="logo"  value="img-jpg">                 
                </div>
                

                <div class="box-12 mg-b-2 mg-t-2    ">
                    <input type="submit" value=" Salvar" class="btn btn-borda-azul" />
                </div>

            </form>
        </div>