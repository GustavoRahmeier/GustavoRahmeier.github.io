document.title = "Dia chuvoso";

const meuBotao = document.getElementById('botao');
const meuParagrafo = document.getElementById('paragrafo');
const meuTitulo = document.getElementById('titulo');
const maisButton = document.getElementById('mais');  
const menosButton = document.getElementById('menos');
const valorElement = document.getElementById('Valor');


meuParagrafo.innerHTML = "Olá Mundo";
meuTitulo.innerHTML = "Olá, sou um titulo";

botao.innerHTML = "botao";


botao.addEventListener("click", function () {
    window.alert("botao");
    document.body.style.background = "lightblue";

});


let valor = 0;
    valorElement.textContent = valor;

    maisButton.addEventListener('click', function() {
      valor++;
      valorElement.textContent = valor;
    });


  menosButton.addEventListener('click', function() {
    valor--;
    valorElement.textContent = valor;
  });


