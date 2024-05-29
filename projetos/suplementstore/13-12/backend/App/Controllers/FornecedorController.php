<?php

namespace App\Controllers;

use App\Models\Fornecedor;
use App\Models\DAO\FornecedorDAO;

class FornecedorController
{
    private $fornecedorDAO;

    public function __construct()
    {
        $this->fornecedorDAO = new FornecedorDAO();
    }

    public function listarTodos()
    {
        try {
            $fornecedor = $this->fornecedorDAO->listarTodos();
            http_response_code(200);
            return $fornecedor;
        } catch (\Exception $e) {
            http_response_code(400);
            return "Erro ao recuperar Usuarios: " . $e->getMessage();
        }
    }

    public function recuperarUm($id)
    {
        try {
            $fornecedor = $this->fornecedorDAO->recuperarFornecedorPorId($id);
            if ($fornecedor) {
                http_response_code(200);
                return $fornecedor;
            } else {
                http_response_code(404);
                return "Fornecedor não encontrado";
            }
        } catch (\Exception $e) {
            http_response_code(400);
            return "Erro ao recuperar Fornecedor: " . $e->getMessage();
        }
    }

    public function salvar($request)
    {
        try {
            $fornecedor = new Fornecedor($request['nome'], null, $request['cnpj'], $request['endereco']);
            $fornecedorCriado = $this->fornecedorDAO->salvar($fornecedor);
            http_response_code(200);
            return $fornecedorCriado;
        } catch (\Exception $e) {
            http_response_code(400);
            return "Erro ao inserir Fornecedor: " . $e->getMessage();
        }
    }

    public function atualizar($request, $id)
    {
        try {
            $fornecedor = new Fornecedor($request['nome'], $id, $request['cnpj'], $request['endereco']);
            $fornecedorAtualizado = $this->fornecedorDAO->atualizar($fornecedor);
            if ($fornecedorAtualizado) {
                http_response_code(200);
                return $fornecedorAtualizado;
            } else {
                http_response_code(404);
                return "Fornecedor não encontrado";
            }
        } catch (\Exception $e) {
            http_response_code(400);
            return "Erro ao atualizar Fornecedor: " . $e->getMessage();
        }
    }

    public function apagar($id)
    {
        try {
            $fornecedorApagado = $this->fornecedorDAO->apagar($id);
            if ($fornecedorApagado) {
                http_response_code(200);
                return "Fornecedor " . $id . " apagado";
            } else {
                http_response_code(404);
                return "Fornecedor não encontrado";
            }
        } catch (\Exception $e) {
            http_response_code(400);
            return "Erro ao atualizar Fornecedor: " . $e->getMessage();
        }
    }
}
