<?php

namespace App\Models;

class Fornecedor
{

    private $id;
    private $nome;
    private $cnpj;
    private $endereco;

    function __construct($nome, $id = null, $cnpj, $endereco)
    {
        $this->nome = $nome;
        $this->id = $id;
        $this->cnpj = $cnpj;
        $this->endereco = $endereco;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function __toString()
    {
        return json_encode([
            'id' => $this->id,
            'nome' => $this->nome,
            'cnpj' => $this->cnpj,
            'endereco' => $this->endereco
        ]);
    }
}
