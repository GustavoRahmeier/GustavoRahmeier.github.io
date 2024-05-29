<?php

namespace App\Models\DAO;

use App\Models\Produto;
use App\Core\Database;

class produtoDAO
{

    private $table = 'produto';
    private $db;
    private $connection;

    public function __construct()

    {
        $this->db = new Database();
        $this->connection = $this->db->getConnection();
    }

    public function listarTodos()
    {
        try {
            $sql = "SELECT * FROM $this->table ORDER BY id";
            $stmt = $this->connection->query($sql);
            $produtos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $this->db->closeConnection();

            return $produtos;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function recuperarProdutoPorId($produtoId)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$produtoId]);
            $produto = $stmt->fetch(\PDO::FETCH_ASSOC);

            $this->db->closeConnection();

            if ($produto) {
                $produtoData = new Produto(
                    $produto["nome"],
                    $produto["id"],
                    $produto["preco"],
                    $produto["codigo_de_barras"],
                    $produto["quantidade"]
                );
                return $produtoData;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function salvar(Produto $produto)
    {
        try {
            $sql = "INSERT INTO $this->table (nome, preco, codigo_de_barras,quantidade) VALUES (?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);

            $stmt->execute([$produto->getNome(), $produto->getPreco(), $produto->getCodbarras(), $produto->getQuantidade()]);

            $this->db->closeConnection();

            if ($stmt->rowCount() > 0) {
                $produtoId = $this->connection->lastInsertId();
                $produtoData = $this->recuperarProdutoPorId($produtoId);
                return $produtoData;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function atualizar($produto)
    {
        try {
            $sql = "UPDATE $this->table SET nome = ?, preco = ?, codigo_de_barras = ?, quantidade = ?  WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$produto->getNome(), $produto->getPreco(), 
            $produto->getCodBarras(), $produto->getQuantidade(), $produto->getId()]);
            
            $this->db->closeConnection();

            if ($stmt->rowCount() > 0) {
                $produtoAtualizar = $this->recuperarProdutoPorId($produto->getId());
                return $produtoAtualizar;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function apagar($id)
    {
        try {
            $produtoApagar = $this->recuperarProdutoPorId($id);
            
            if ($produtoApagar) {
                $sql = "DELETE FROM $this->table WHERE id = ?";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([$id]);
                $this->db->closeConnection();
            } 
            return $produtoApagar;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
