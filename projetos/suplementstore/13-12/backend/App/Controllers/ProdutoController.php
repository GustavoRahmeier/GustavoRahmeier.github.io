<?php

namespace App\Controllers;

use App\Models\Produto;
use App\Models\DAO\ProdutoDAO;

class ProdutoController
{
    private $produtoDAO;

    public function __construct()
    {
        $this->produtoDAO = new ProdutoDAO();
    }

    public function listarTodos()
    {
        try {
            $produto = $this->produtoDAO->listarTodos();
            http_response_code(200);
            return $produto;
        } catch (\Exception $e) {
            http_response_code(400);
            return "Erro ao recuperar Produtos: " . $e->getMessage();
        }
    }

    public function recuperarUm($id)
    {
        try {
            $produto = $this->produtoDAO->recuperarProdutoPorId($id);
            if ($produto) {
                http_response_code(200);
                return $produto;
            } else {
                http_response_code(404);
                return "produto não encontrado";
            }
        } catch (\Exception $e) {
            http_response_code(400);
            return "Erro ao recuperar Produto: " . $e->getMessage();
        }
    }

    public function salvar($request)
    {
        try {
            $produto = new Produto($request['nome'], null, $request['preco'], $request['codbarras'], $request['quantidade']);
            $produtoCriado = $this->produtoDAO->salvar($produto);
            http_response_code(200);
            return $produtoCriado;
        } catch (\Exception $e) {
            http_response_code(400);
            return "Erro ao inserir Produto: " . $e->getMessage();
        }
    }

    public function atualizar($request, $id)
    {
        try {
            $produto = new Produto($request['nome'], $id, $request['preco'], $request['codbarras'], $request['quantidade']);
            $produtoAtualizado = $this->produtoDAO->atualizar($produto);
            if ($produtoAtualizado) {
                http_response_code(200);
                return $produtoAtualizado;
            } else {
                http_response_code(404);
                return "Produto não encontrado";
            }
        } catch (\Exception $e) {
            http_response_code(400);
            return "Erro ao atualizar Produto: " . $e->getMessage();
        }
    }

    public function apagar($id)
    {
        try {
            $produtoApagado = $this->produtoDAO->apagar($id);
            if ($produtoApagado) {
                http_response_code(200);
                return "Produto " . $id . " apagado";
            } else {
                http_response_code(404);
                return "Produto não encontrado";
            }
        } catch (\Exception $e) {
            http_response_code(400);
            return "Erro ao atualizar Produto: " . $e->getMessage();
        }
    }
}
