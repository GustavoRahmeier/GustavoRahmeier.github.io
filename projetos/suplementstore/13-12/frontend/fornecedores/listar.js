let corpoTabela = document.getElementById('corpo-tabela');

async function buscarFornecedores() {
    let resposta = await fetch('http://localhost:8000/fornecedores');
    let fornecedores = await resposta.json();

    for (let fornecedor of fornecedores) {
        let tr = document.createElement('tr');
        let tdNome = document.createElement('td');
        let tdCnpj = document.createElement('td');
        let tdEndereco = document.createElement('td');
        let tdAcoes = document.createElement('td');

        tdNome.innerText = fornecedor.nome;
        tdCnpj.innerText = fornecedor.cnpj;
        tdEndereco.innerText = fornecedor.endereco;
        tdAcoes.innerHTML = `
      <a class = "btn-edit" href="formulario.html?id=${fornecedor.id}">Editar</a>
      <button class = "btn-delete" onclick="excluir(${fornecedor.id})">Excluir</button>
    `;

        tr.appendChild(tdNome);
        tr.appendChild(tdCnpj);
        tr.appendChild(tdEndereco);
        tr.appendChild(tdAcoes);

        corpoTabela.appendChild(tr);
    }
}

async function excluir(id) {
    await fetch('http://localhost:8000/fornecedores/' + id, { method: 'DELETE' });
    window.location.reload();
}

buscarFornecedores();