    <div class="form-cad bg-branco pd-10 box-12">
    <div class="box-12 flex justify-start limpar">
        <div class="box-8">
            <?php if (isset($id) && $id != '') {
                echo "<h1 class='fonte32 fonte-roboto fw-300 mg-b-2'><i class='fas fa-user fonte30 fnc-azul mg-r-1'></i> Editar Usuário</h1>";
            } else {
                echo "<h1 class='fonte32 fonte-roboto fw-300 mg-b-2'><i class='fas fa-user fonte30 fnc-azul mg-r-1'></i> Cadastrar Usuário</h1>";
            }
            ?>
        </div>
    </div>
    <div class="divider limpar"></div>
        <form action="" method="POST" enctype="multipart/form-data">

            <div class="box-12">
                <input type="hidden" name="id" value="<?php if (isset($id) && $id != '') echo $return[0]->ID ?>" required />
                <input type="hidden" name="ativo" value="<?php if (isset($id) && $id != '') echo $return[0]->ATIVO;
                                                            else echo 'S'; ?>" required>
            </div>

            <div class="box-6">
                <label for="">Nome Completo</label>
                <input type="text" name="nome" value="<?php if (isset($id) && $id != '') echo $return[0]->NOME; ?>" required>
            </div>

            <div class="box-6">
                <label for="">Nome Usuário</label>
                <input type="text" name="usuario" value="<?php if (isset($id) && $id != '') echo $return[0]->USUARIO; ?>" required>
            </div>

            <?php if (!$id || $id == '') { ?>
                <div class="box-6">
                    <label for="">Senha</label>
                    <input type="password" name="senha" required />
                </div>
            <?php } ?>

            <div class="box-6">
                <label for="">E-mail</label>
                <input type="text" name="email" value="<?php if (isset($id) && $id != '') echo $return[0]->EMAIL; ?>" required>
            </div>

            <div class="box-6">
                <label for="">Perfil Usuário</label>
                <select name="perfil" id="" class="">
                    <?php
                    if (isset($perf) && count($perf) > 0) {
                        
                        foreach ($perf as $dados) {
                            if (isset($id) && $id != '' && $return[0]->PERFIL == $dados->ID) {
                                echo "<option value='{$dados->ID}' selected>" . $Formater->formataTextoCap($dados->DESCRICAO) . " </option>";
                            } else {
                                echo "<option value='{$dados->ID}'>" . $Formater->formataTextoCap($dados->DESCRICAO) . " </option>";
                            }
                        }
                    }
                    ?>
                </select>
            </div>
            <!-- Carregamento da imagem -->
            <div class="box-12 mg-b-2">
                <?php if (isset($id) && $id != '') { ?>
                    <label for="img" class="search fnc-preto-1 flex item-centro wd-40  ">
                        <span class="fnc-preto-1 mg-r-2 mg-l-2 pd-20">
                            <i class="fas fa-file-image fonte18"></i>
                        </span>
                        Escolher uma imagem!
                    </label>
                    <input type="file" name="imagem" id="img" onchange="mostrar(this);" value="<?php echo $return[0]->IMAGEM; ?>" class="" />
                    <img id='foto' class='img-visivel mg-b-2 mg-t-2' src='lib/img/users-images/<?php echo $return[0]->IMAGEM; ?>' />
                <?php } else { ?>
                    <label for="img" class="search fnc-preto-1 flex item-centro wd-40">
                        <span class="fnc-preto-1 mg-r-2 mg-l-2 pd-20">
                            <i class="fas fa-file-image fonte18"></i>
                        </span>
                        Escolher uma imagem!
                    </label>
                    <input type="file" name="imagem" id="img" onchange="mostrar(this);" class="" required="" />
                    <img id='foto' class='img-visivel mg-b-2 mg-t-2' src='lib/img/users-images/user-padrao.png' />
                <?php } ?>
            </div>
            <div class="box-12"><input type="submit" value="Cadastrar" class="btn-100 bg-p2-azul bg-p4-powder-hover fnc-branco"> </div>

        </form>
    </div>