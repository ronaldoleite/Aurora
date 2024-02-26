<section class='canva shadow-down mg-t-2 bg-branco radius pd-20'>
    <div class="box-12 flex justify-center limpar">
        <div class="box-8">
            <h1 class="fonte32 fonte-roboto fw-300 mg-b-2"><i class="fas fa-file-signature fonte28 fnc-cinza mg-r-1"></i>Produtos</h1>
        </div>
        <div class="box-4 new-add">
            <div class="w-100 flex justify-end">
                <div class="w-30 bg-p2-azul-escuro pd-10 radius-start"><i class="fa-solid fa-plus fonte22 fnc-branco fonte-open fw-bold"></i></div>
                <div class="w-70 bg-p2-azul pd-10 radius-end"><a href="index.php?controller=ProdutoController&metodo=Index" class="fnc-branco ">Novo Cadastro</a></div>
            </div>
        </div>
    </div>

    <div class="divider limpar"></div>
    <table id="table" class="">

        <thead class="head">
            <tr>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Código</th>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Nome</th>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Data Cadastro</th>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Quantidade</th>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Preço</th>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Ativo</th>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e"></th>
            </tr>
        </thead>

        <tbody>
            <form action="#" class="bg-p3-paper">
                <?php
                if (isset($ret) && count($ret) > 0) {
                    foreach ($ret as $dados) { ?>
                        <tr class="zebra">
                            <td class="pd-l-1 fonte12 espaco-letra ttx-e"><?php echo $dados->CODIGO; ?></td>
                            <td class="pd-l-1 fonte12 espaco-letra ttx-e"><?php echo $dados->NOME; ?></td>
                            <td class="pd-l-1 fonte12 espaco-letra ttx-e"><?php echo $Formater->formatarData($dados->DATACADASTRO); ?></td>
                            <td class="pd-l-1 fonte12 espaco-letra ttx-e"><?php echo $dados->QUANTIDADE; ?></td>
                            <td class="pd-l-1 fonte12 espaco-letra ttx-e">R$ <?php echo $Formater->converterMoeda($dados->PRECO); ?></td>
                            <td class="pd-l-1 fonte12 espaco-letra ttx-e estatus">
                                <?php if ($dados->ESTATUS == 'A') { ?>
                                    <input type="checkbox" name="estatus" rel="I" value="<?php echo $dados->ID; ?>" class="estatus" checked>
                                <?php  } else { ?>
                                    <input type="checkbox" name="estatus" rel="A" value="<?php echo $dados->ID; ?>" class="estatus">
                                <?php  }
                                ?>

                            </td>
                            <td class="pd-l-1 fonte12 espaco-letra txt-e flex justify-center item-centro">
                                <a href="index.php?controller=ProdutoController&metodo=DeleteConfirm&id=<?php echo $dados->ID ?>"> <i class="fa-solid fa-trash-can fonte14 fnc-tomato mg-r-2"></i> </a>
                                <a href="index.php?controller=ProdutoController&metodo=Index&id=<?php echo $dados->ID ?>"> <i class="fa-regular fa-pen-to-square fonte14 fnc-laranja"></i> </a>
                            </td>
                        </tr>
                <?php     }
                }
                ?>
            </form>
        </tbody>
        <tfoot>
        <tr>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Código</th>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Nome</th>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Data Cadastro</th>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Quantidade</th>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Preço</th>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Ativo</th>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e"></th>
            </tr>
        </tfoot>
    </table>
</section>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        new DataTable('#table', {
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json'
            }
        });
    });

    $(function() {
        $('.estatus').change(function() {
            let acao = $(this).attr('rel');
            //Pegar a quantidade digitada no input
            let id = $(this).val();
            $.ajax({
                //Tipo do envio POST ou GET
                type: "GET",
                //camiho para a mudança
                url: "index.php?controller=ProdutoController&metodo=AtivarProduto&id=" + id + "&acao=" + acao,
                //dados passados via POST
                data: "id=" + id + "&acao=" + acao,
                //se tiver tudo OK carrega a mesma página
                success: function() {
                    location.reload();
                }
            });
        });
    });
    /*
      $(document).ready(function() {
          // extend the default setting to always include the zebra widget. 
          $.tablesorter.defaults.widgets = ['zebra'];
          // extend the default setting to always sort on the first column 
          $.tablesorter.defaults.sortList = [
              [0, 0]
          ];
          // call the tablesorter plugin 
          $("table").tablesorter();
          $("#tabprod tbody tr").quicksearch({
              labelText: '',
              attached: '#tabprod',
              position: 'before',
              delay: 100,
              loaderText: '',
              onAfter: function() {
                  if ($("#tabprod tbody tr:visible").length != 0) {
                      $("#tabprod").trigger("update");
                      $("#tabprod").trigger("appendCache");
                      $("#tabprod tfoot tr").hide();
                  }

              }
          });
      });
      */
</script>