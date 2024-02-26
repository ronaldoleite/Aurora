$("document").ready(function () {
  $.ajax({
    type: "POST",
    url: "index.php?controller=PainelController&metodo=GraficoMaisVendido",
    dataType: "json",
    success: function (data) {
      let nomeArray = [];
      let qtdeArray = [];
      for (i = 0; i < data.length; i++) {
        nomeArray.push(data[i].PRODUTO);
        qtdeArray.push(data[i].QUANTIDADE);
      }
      grafico(nomeArray, qtdeArray); //chamando a fun��o que abra�a todo o grafico
    },
  });
});
function grafico(nome, qtdes) {
const ctx = document.getElementById("myChart");

new Chart(ctx, {
  type: "bar",
  data: {
    labels: nome,
    datasets: [
      {
        label: "Produtos Vendidos",
        data: qtdes,
        backgroundColor:[
           '#6b7a8f'
        ],
        borderWidth: 1,
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});
}
//</script>  
// Grafico de Pizza
$("document").ready(function () {
  $.ajax({
    type: "POST",
    url: "index.php?controller=PainelController&metodo=GraficoTipoPag",
    dataType: "json",
    success: function (data) {
      let nomeArray = [];
      let qtdeArray = [];
      for (i = 0; i < data.length; i++) {
        nomeArray.push(data[i].FORMAPAGAMENTO);
        qtdeArray.push(data[i].TOTAL);
      }
      graficoPizza(nomeArray, qtdeArray); //chamando a fun��o que abra�a todo o grafico
    },
  });
});
function graficoPizza(nome, qtdes) {
const ctx = document.getElementById("myChartPizza");

new Chart(ctx, {
  type: "doughnut",
  data: {
    labels: nome,
    datasets: [
      {
        label: "Meios de pagamento",
        data: qtdes,
        backgroundColor:[
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)',
          'rgb(255, 205, 86)',
          'rgb(124, 239, 136)'
        ],
        hoverOffset: 4,
        borderWidth: 1,
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});
}
