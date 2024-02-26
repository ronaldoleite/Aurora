<section class='canva shadow-down mg-t-2 bg-branco radius pd-20'>
    <div class="box-12 flex justify-center limpar">
        <div class="box-8">
            <h1 class="fonte32 fonte-roboto fw-300 mg-b-2"><i class="fa-solid fa-cash-register fonte28 fnc-cinza mg-r-1"></i>Conferência Fechamento</h1>
        </div>
        <div class="box-4 new-add">
            <div class="w-100 flex justify-end">

                <!--  <div class="w-30 bg-p2-azul-escuro pd-10 radius-start"><i class="fa-solid fa-plus fonte22 fnc-branco fonte-open fw-bold"></i></div>
                <div class="w-70 bg-p2-azul pd-10 radius-end">
                    <a href="index.php?controller=EstabelecimentoController&metodo=Index" class="fnc-branco ">Novo Cadastro</a>
                </div> -->
            </div>
        </div>
    </div>

    <div class="divider limpar"></div>
    <table id="table" class="">
        <h3 class="fonte14 fonte-roboto mg-t-1 mg-b-1 espaco-letra">Caixa Aberto por: <?php echo $Formater->FormataTextoLow($cxr[0]->NOME); ?></h3>
        <thead class="head">
            <tr>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Valor Inicial</th>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Data Abertura</th>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Total Vendas</th>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Tipo Pagamento</th>
            </tr>
        </thead>

        <tbody>
            <form action="" method="POST" class="bg-p3-paper">
                <?php #echo '<pre>'; var_dump($cxr); echo '</pre>'; 
                ?>
                <?php
                if (isset($cxr) && count($cxr) > 0) {
                    foreach ($cxr as $dados) { ?>
                        <tr class="zebra">
                            <td class="pd-l-1 fonte12 espaco-letra txt-e"><?php echo $cxr[0]->VALORINICIAL; ?></td>
                            <td class="pd-l-1 fonte12 espaco-letra txt-e"><?php echo $dados->DATAABERTURA; ?></td>
                            <td class="pd-l-1 fonte12 espaco-letra txt-e"><?php echo $Formater->converterMoeda($dados->VALOR); ?></td>
                            <td class="pd-l-1 fonte12 espaco-letra txt-e"><?php echo $Formater->formataTextoCap($dados->PAGAMENTOS); ?></td>
                        </tr>
                <?php     }
                }
                ?>
            </form>
        </tbody>
        <tfoot>
            <tr>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Valor Inicial</th>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Data Abertura</th>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Total Vendas</th>
                <th class="pd-10 fonte16 fw-400 espaco-letra fnc-preto fonte-poppin txt-e">Tipo Pagamento</th>
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
</script>