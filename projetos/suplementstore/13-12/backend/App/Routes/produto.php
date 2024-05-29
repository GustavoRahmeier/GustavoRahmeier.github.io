<?php

use App\Controllers\ProdutoController;

$router->get('/produtos', function () {
    $produtoController = new ProdutoController();
    $produto = $produtoController->listarTodos();
    echo json_encode($produto);
});

$router->get('/produtos/{id}', function ($id) {
    $produtoController = new ProdutoController();
    $produto = $produtoController->recuperarUm($id);
    echo $produto;
});

// criar
$router->post('/produtos', function () {
    $request = json_decode(file_get_contents('php://input'), true);
    $produtoController = new ProdutoController();
    $produto = $produtoController->salvar($request);
    echo $produto;
});

// editar
$router->put('/produtos/{id}', function ($id) {
    $request = json_decode(file_get_contents('php://input'), true);
    $produtoController = new ProdutoController();
    $produto = $produtoController->atualizar($request, $id);
    echo $produto;
});

// excluir
$router->delete('/produtos/{id}', function ($id) {
    $produtoController = new produtoController();
    $produto = $produtoController->apagar($id);
    echo $produto;
});