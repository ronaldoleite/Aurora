// CARREGAR FOTO PRODUTO
function mostrar(imagem)
{
    if (imagem.files && imagem.files[0])
    {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#foto')//id <img>
                    .attr('src', e.target.result)
                    .width(170)
        };
        reader.readAsDataURL(imagem.files[0]);
    }
}
// CONSUMIR API CEP
function getDadosEnderecoPorCEP(cep) {
    let url = 'https://viacep.com.br/ws/' + cep + '/json/'

    let xmlHttp = new XMLHttpRequest()
    xmlHttp.open('GET', url)

    xmlHttp.onreadystatechange = () => {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            let dadosJSONText = xmlHttp.responseText
            let dadosJSONObj = JSON.parse(dadosJSONText)

            document.getElementById('endereco').value = dadosJSONObj.logradouro
            document.getElementById('bairro').value = dadosJSONObj.bairro
            document.getElementById('cidade').value = dadosJSONObj.localidade
            document.getElementById('uf').value = dadosJSONObj.uf
        }
    }

    xmlHttp.send()
}
// FORMATAR DOC E CONTATOS
function formata_mascara(campo_passado, mascara) {
    let campo = campo_passado.value.length;
    let saida = mascara.substring(0, 1);
    let texto = mascara.substring(campo);

    if (texto.substring(0, 1) != saida) {
        campo_passado.value += texto.substring(0, 1);
    }
}