let corpoTabela = document.getElementById('corpo-tabela');

async function buscarProdutos() {
    let resposta = await fetch('http://localhost:8000/produtos');
    let produtos = await resposta.json();

    for (let produto of produtos) {
        let tr = document.createElement('tr');
        let tdNome = document.createElement('td');
        let tdPreco = document.createElement('td');
        let tdcodbarras = document.createElement('td');
        let tdQuantidade = document.createElement('td');
        let tdAcoes = document.createElement('td');

        tdNome.innerText = produto.nome;
        tdPreco.innerText = produto.preco;
        tdcodbarras.innerText = produto.codigo_de_barras;
        tdQuantidade.innerText = produto.quantidade;
        tdAcoes.innerHTML = `
      <a class = "btn-edit" href="formulario.html?id=${produto.id}">Editar</a>
      <button class = "btn-delete" onclick="excluir(${produto.id})">Excluir</button>
    `;

        tr.appendChild(tdNome);
        tr.appendChild(tdPreco);
        tr.appendChild(tdcodbarras);
        tr.appendChild(tdQuantidade);
        tr.appendChild(tdAcoes);

        corpoTabela.appendChild(tr);
    }
}

async function excluir(id) {
    await fetch('http://localhost:8000/produtos/' + id, { method: 'DELETE' });
    window.location.reload();
}

buscarProdutos();