const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id');

let inputNome = document.getElementById('nome');
let inputCnpj = document.getElementById('cnpj');
let inputEndereco = document.getElementById('endereco');
let form = document.getElementById('formulario');

async function buscarDados() {
    let resposta = await fetch('http://localhost:8000/fornecedores/' + id);
    if (resposta.ok) {
        let fornecedor = await resposta.json();
        inputNome.value = fornecedor.nome;
        inputCnpj.value = fornecedor.cnpj;
        inputEndereco.value = fornecedor.endereco;
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
    let cnpj = inputCnpj.value;
    let endereco = inputEndereco.value;
    
    let payload = {
        nome,
        cnpj,
        endereco,
        
    }

    let url = 'http://localhost:8000/fornecedores';
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