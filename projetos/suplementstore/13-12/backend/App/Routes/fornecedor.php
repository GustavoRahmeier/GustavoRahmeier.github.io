<?php

use App\Controllers\FornecedorController;
use App\Models\Fornecedor;

$router->get('/fornecedores', function () {
    $fornecedorController = new FornecedorController();
    $fornecedor = $fornecedorController->listarTodos();
    echo json_encode($fornecedor);
});

$router->get('/fornecedores/{id}', function ($id) {
    $fornecedorController = new FornecedorController();
    $fornecedor = $fornecedorController->recuperarUm($id);
    echo $fornecedor;
});

// criar
$router->post('/fornecedores', function () {
    $request = json_decode(file_get_contents('php://input'), true);
    $fornecedorController = new FornecedorController();
    $fornecedor = $fornecedorController->salvar($request);
    echo $fornecedor;
});

// editar
$router->put('/fornecedores/{id}', function ($id) {
    $request = json_decode(file_get_contents('php://input'), true);
    $fornecedorController = new fornecedorController();
    $fornecedor = $fornecedorController->atualizar($request, $id);
    echo $fornecedor;
});

// excluir
$router->delete('/fornecedores/{id}', function ($id) {
    $fornecedorController = new fornecedorController();
    $fornecedor = $fornecedorController->apagar($id);
    echo $fornecedor;
});