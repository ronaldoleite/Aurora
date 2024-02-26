<div class="form-cad bg-branco pd-10 box-12">
    <div class="box-12 flex justify-start limpar">
        <div class="box-8">
            <?php if (isset($id) && $id != '') {
                echo "<h1 class='fonte32 fonte-roboto fw-300 mg-b-2'><i class='fas fa-file-signature fonte30 fnc-azul mg-r-1'></i> Editar Produto</h1>";
            } else {
                echo "<h1 class='fonte32 fonte-roboto fw-300 mg-b-2'><i class='fas fa-file-signature fonte30 fnc-azul mg-r-1'></i> Cadastrar Produto</h1>";
            }
            ?>
        </div>
    </div>
    <div class="divider limpar"></div>

    <form action="" method="post" class="" enctype="multipart/form-data">

        <div class="box-12">
            <input type="hidden" name="id" value="<?php if (isset($id) && $id != '') echo $return[0]->ID;  ?>" />
            <input type="hidden" name="codigo" value="" />
            <input type="hidden" name="datacadastro">
        </div>

        <div class="box-6">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php if (isset($id) && $id != '') echo $return[0]->NOME; ?>">
        </div>

        <div class="box-2">
            <label>Quantidade:</label>
            <input type="text" name="quantidade" value="<?php if (isset($id) && $id != '') echo $return[0]->QUANTIDADE; ?>">
        </div>

        <div class="box-2">
            <label>Preço de custo:</label>
            <input type="text" name="precodecusto" value="<?php if (isset($id) && $id != '') echo $return[0]->PRECODECUSTO; ?>">
        </div>

        <div class="box-2">
            <label>Preço de venda:</label>
            <input type="text" name="preco" value="<?php if (isset($id) && $id != '') echo $return[0]->PRECO; ?>">
        </div>

        <div class="box-2">
            <label>Desconto:</label>
            <input type="text" name="desconto" value="<?php if (isset($id) && $id != '') echo $return[0]->DESCONTO; ?>">
        </div>

        <div class="box-4">
            <label>Categoria</label>
            <select name="categoria">
                <option value="">Escolha uma categoria...</option>
                <?php
                if (count($getCat) > 0) {
                    foreach ($getCat as $cont) {
                        if (isset($id) && $id != "" && $return[0]->CATEGORIA == $cont->ID) {
                ?>
                            <option value='<?php echo $return[0]->CATEGORIA; ?>' selected><?php echo $cont->DESCRICAO; ?></option>
                        <?php } else { ?>
                            <option value='<?php echo $cont->ID; ?>'><?php echo $cont->DESCRICAO; ?></option>
                <?php
                        }
                    }
                }
                ?>
            </select>
        </div>

        <div class="box-4">
            <label>Fornecedor</label>
            <select name="fornecedor">
                <option value="">Escolha um fornecedor...</option>
                <?php
                if (count($getFornec) > 0) {
                    foreach ($getFornec as $cont) {
                        if (isset($id) && $id != "" && $return[0]->FORNECEDOR == $cont->ID) {
                ?>
                            <option value='<?php echo $return[0]->FORNECEDOR; ?>' selected><?php echo $cont->NOME; ?></option>
                        <?php } else { ?>
                            <option value='<?php echo $cont->ID; ?>'><?php echo $cont->NOME; ?></option>
                <?php
                        }
                    }
                }
                ?>
            </select>
        </div>

        <div class="box-2 mg-b-2">
            <label class="box-12 fonte-poppin fnc-preto espaco-letra">Cor </label>
            <input type="text" name="cor" class="fonte-poppin fonte16 fnc-cinza espaco-letra pd-l-1" value="<?php if (isset($id) && $id != "") echo $return[0]->COR; ?>" />
        </div>


        <div class="box-12 mg-b-2">
            <label class="box-12 fonte-poppin fnc-preto espaco-letra ">Descrição</label>
            <textarea name="descricao" value="" class="desc  fnc-cinza pd-l-1 pd-t-1"><?php if (isset($id) && $id != "") echo $return[0]->DESCRICAO; ?></textarea>
        </div>

        <div class="box-12 mg-b-2">
            <?php if (isset($id) && $id != "") { ?>
                <label for="img" class="search bg-preto fnc-preto flex item-centro w-40 fonte-poppin ">
                    <span class="fnc-preto mg-r-20 mg-l-2 pd-20">
                        <i class="fas fa-file-image fonte18"></i>
                    </span>
                    Buscar imagem!
                </label>
                <input type="file" name="imagem" id="img" onchange="mostrar(this);" value="<?php echo $return[0]->IMAGEM; ?>" class="inserirProd arial font-12" />
                <img id='foto' class='img-visivel mg-b-2 mg-t-2' src='lib/img/upload/<?php echo $return[0]->IMAGEM; ?>' />
            <?php } else { ?>
                <label for="img" class="search bg-preto fnc-preto flex item-centro w-40 fonte-poppin ">
                    <span class="fnc-preto mg-r-20 mg-l-20 pd-20">
                        <i class="fas fa-file-image fonte18"></i>
                    </span>
                    Buscar imagem!
                </label>
                <input type="file" name="imagem" id="img" onchange="mostrar(this);" class="inserirProd arial font-12" required="" />
                <img id='foto' class='img-visivel mg-b-2 mg-t-2' src='lib/img/padrao.png' />
            <?php } ?>
        </div>


        <div class="box-12">
            <input type="hidden" name="estatus" value="A" />
        </div>


        <div class="box-12 mg-b-2 mg-t-2    ">
            <input type="submit" value=" Salvar" class="btn btn-borda-azul" />
        </div>

    </form>
</div>