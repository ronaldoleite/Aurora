<div class="form-cad bg-branco pd-10 box-12">
<div class="box-12 flex justify-start limpar">
        <div class="box-8">
            <?php if (isset($id) && $id != '') {
                echo "<h1 class='fonte32 fonte-roboto fw-300 mg-b-2'><i class='fas fa-tags fonte30 fnc-azul mg-r-1'></i> Editar Categoria</h1>";
            } else {
                echo "<h1 class='fonte32 fonte-roboto fw-300 mg-b-2'><i class='fas fa-tags fonte30 fnc-azul mg-r-1'></i> Cadastrar Categoria</h1>";
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
            <label>Descrição:</label>
            <input type="text" name="descricao" value="<?php if (isset($id) && $id != '') echo $return[0]->DESCRICAO; ?>">
        </div>


        <div class="box-12 mg-b-2 mg-t-2    ">
            <input type="submit" value=" Salvar" class="btn btn-borda-azul" />
        </div>

    </form>
</div>