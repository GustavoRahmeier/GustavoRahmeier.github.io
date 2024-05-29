const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id');

let inputNome = document.getElementById('nome');
let inputPreco = document.getElementById('preco');
let inputCodbarras = document.getElementById('codbarras');
let inputQuantidade = document.getElementById('quantidade');
let form = document.getElementById('formulario');

async function buscarDados() {
    let resposta = await fetch('http://localhost:8000/produtos/' + id);
    if (resposta.ok) {
        let produto = await resposta.json();
        inputNome.value = produto.nome;
        inputPreco.value = produto.preco;
        inputCodbarras.value = produto.codbarras;
        inputQuantidade.value = produto.quantidade;
    } else {
        alert('Ops! Algo deu errado!');
    }
}

// Está editando
if (id) {
    buscarDados();
}

form.addEventListener('submit', async (event) => {
    event.stopPropagation();
    event.preventDefault();

    let nome = inputNome.value;
    let preco = inputPreco.value;
    let codbarras = inputCodbarras.value;
    let quantidade = inputQuantidade.value;

    let payload = {
        nome,
        preco,
        codbarras,
        quantidade,
    }

    let url = 'http://localhost:8000/produtos';
    let method = 'POST';
    if (id) {
        url += '/' + id;
        method = 'PUT';
    }

    let resposta = await fetch(url, {
        method: method,
        headers: {
            'Content-type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify(payload)
    });

    if (resposta.ok) {
        window.location.href = 'index.html'
    } else {
        alert('Ops! Algo deu errado!');
    }
});