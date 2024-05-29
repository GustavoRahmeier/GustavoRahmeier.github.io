<?php

namespace App\Models\DAO;

use App\Models\Fornecedor;
use App\Core\Database;

class fornecedorDAO
{

    private $table = 'fornecedores';
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
            $fornecedores = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $this->db->closeConnection();

            return $fornecedores;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function recuperarFornecedorPorId($fornecedorId)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$fornecedorId]);
            $fornecedor = $stmt->fetch(\PDO::FETCH_ASSOC);

            $this->db->closeConnection();

            if ($fornecedor) {
                $fornecedorData = new Fornecedor(
                    $fornecedor["nome"],
                    $fornecedor["id"],
                    $fornecedor["cnpj"],
                    $fornecedor["endereco"]
                );
                return $fornecedorData;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function salvar(Fornecedor $fornecedor)
    {
        try {
            $sql = "INSERT INTO $this->table (nome, cnpj, endereco) VALUES (?, ?, ?)";
            $stmt = $this->connection->prepare($sql);

            $stmt->execute([$fornecedor->getNome(), $fornecedor->getCnpj(), $fornecedor->getEndereco()]);

            $this->db->closeConnection();

            if ($stmt->rowCount() > 0) {
                $fornecedorId = $this->connection->lastInsertId();
                $fornecedorData = $this->recuperarFornecedorPorId($fornecedorId);
                return $fornecedorData;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function atualizar($fornecedor)
    {
        try {
            $sql = "UPDATE $this->table SET nome = ?, cnpj = ?, endereco = ? WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                $fornecedor->getNome(), $fornecedor->getCnpj(),
                $fornecedor->getEndereco(), $fornecedor->getId()
            ]);

            $this->db->closeConnection();

            if ($stmt->rowCount() > 0) {
                $fornecedorAtualizar = $this->recuperarFornecedorPorId($fornecedor->getId());
                return $fornecedorAtualizar;
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
            $fornecedorApagar = $this->recuperarFornecedorPorId($id);

            if ($fornecedorApagar) {
                $sql = "DELETE FROM $this->table WHERE id = ?";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([$id]);
                $this->db->closeConnection();
            }
            return $fornecedorApagar;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
