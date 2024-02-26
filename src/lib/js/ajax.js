// metodo responsavel por alterar a quantidade de produto no carrinho
$(function () {
    $('.qtde').change(function () {
        //Pega a linha da sessão
        var linha = $(this).attr('rel');
        //Pegar a quantidade digitada no input
        var quantidade = $(this).val();
        //Função ajax
        $.ajax({
            //Tipo do envio POST ou GET
            type: "POST",
            //camiho para a mudança
            url: "index.php?controller=CarrinhoController&metodo=AtualizarCarrinho",
            //dados passados via POST
            data: "quantidade=" + quantidade + "&linha=" + linha,
            //se tiver tudo OK carrega a mesma página
            success: function () {
                location.reload();
            }
        });
    });
});
// metodo responsavel por inserir produto no carrinho.
$(function () {
    $('.enviaProd').change(function () {
         var codigo = $(this).val();      
        $.ajax({
            //Tipo do envio POST ou GET
            type: "POST",
            //camiho para a mudança
            url: "index.php?controller=CarrinhoController&metodo=InserirCarrinho",
            //dados passados via POST
            data: "codigo=" + codigo,
            //se tiver tudo OK carrega a mesma página
            success: function () {
                location.reload();
            }
        });
    });
});