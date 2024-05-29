<?php

namespace App\Models;

class Produto
{

    private $id;
    private $nome;
    private $preco;
    private $codbarras;
    private $quantidade;

    public function __construct($nome, $id = null, $preco, $codbarras, $quantidade)
    {
        $this->nome = $nome;
        $this->id = $id;
        $this->preco = $preco;
        $this->codbarras = $codbarras;
        $this->quantidade = $quantidade;
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

    public function getPreco()
    {
        return $this->preco;
    }

    public function setPreco($preco)
    {
        $this->preco = $preco;
    }

    public function getCodbarras()
    {
        return $this->codbarras;
    }

    public function setCodBarras($codbarras)
    {
        $this->codbarras = $codbarras;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    public function __toString()
    {
        return json_encode([
            'id' => $this->id,
            'nome' => $this->nome,
            'preco' => $this->preco,
            'codbarras' => $this->codbarras,
            'quantidade' => $this->quantidade
        ]);
    }
}
