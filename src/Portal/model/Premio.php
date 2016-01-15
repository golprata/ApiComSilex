<?php

namespace Portal\model;

class Premio implements JsonSerializable
{
    private $id;
    private $nome;
    private $descricao;
    private $imagem1;
    private $imagem2;
    private $imagem3;
    private $pontos;
    private $quantidade;
    private $validade;
    private $datacadastro;
    private $dataedicao;

    /**
     * Premio constructor.
     * @param $id
     * @param $nome
     * @param $descricao
     * @param $imagem1
     * @param $imagem2
     * @param $imagem3
     * @param $pontos
     * @param $quantidade
     * @param $validade
     * @param $datacadastro
     * @param $dataedicao
     */
    public function __construct(
        $id=null,
        $nome=null,
        $descricao=null,
        $imagem1=null,
        $imagem2=null,
        $imagem3=null,
        $pontos=null,
        $quantidade=null,
        $validade=null,
        $datacadastro=null,
        $dataedicao=null
    )
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->imagem1 = $imagem1;
        $this->imagem2 = $imagem2;
        $this->imagem3 = $imagem3;
        $this->pontos = $pontos;
        $this->quantidade = $quantidade;
        $this->validade = $validade;
        $this->datacadastro = $datacadastro;
        $this->dataedicao = $dataedicao;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param null $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return null
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param null $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return null
     */
    public function getImagem1()
    {
        return $this->imagem1;
    }

    /**
     * @param null $imagem1
     */
    public function setImagem1($imagem1)
    {
        $this->imagem1 = $imagem1;
    }

    /**
     * @return null
     */
    public function getImagem2()
    {
        return $this->imagem2;
    }

    /**
     * @param null $imagem2
     */
    public function setImagem2($imagem2)
    {
        $this->imagem2 = $imagem2;
    }

    /**
     * @return null
     */
    public function getImagem3()
    {
        return $this->imagem3;
    }

    /**
     * @param null $imagem3
     */
    public function setImagem3($imagem3)
    {
        $this->imagem3 = $imagem3;
    }

    /**
     * @return null
     */
    public function getPontos()
    {
        return $this->pontos;
    }

    /**
     * @param null $pontos
     */
    public function setPontos($pontos)
    {
        $this->pontos = $pontos;
    }

    /**
     * @return null
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * @param null $quantidade
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    /**
     * @return null
     */
    public function getValidade()
    {
        return $this->validade;
    }

    /**
     * @param null $validade
     */
    public function setValidade($validade)
    {
        $this->validade = $validade;
    }

    /**
     * @return null
     */
    public function getDatacadastro()
    {
        return $this->datacadastro;
    }

    /**
     * @param null $datacadastro
     */
    public function setDatacadastro($datacadastro)
    {
        $this->datacadastro = $datacadastro;
    }

    /**
     * @return null
     */
    public function getDataedicao()
    {
        return $this->dataedicao;
    }

    /**
     * @param null $dataedicao
     */
    public function setDataedicao($dataedicao)
    {
        $this->dataedicao = $dataedicao;
    }

    function jsonSerialize()
    {
        return [
            'id'            => $this->id,
            'nome'          => $this->nome,
            'descricao'     => $this->descricao,
            'imagem1'       => $this->imagem1,
            'imagem2'       => $this->imagem2,
            'imagem3'       => $this->imagem3,
            'pontos'        => $this->pontos,
            'quantidade'    => $this->quantidade,
            'validade'      => $this->validade,
            'datacadastro'  => $this->datacadastro,
            'dataedicao'    => $this->dataedicao
        ];
    }

    public static function factory($array)
    {
        return new Premio( null, $array['nome'], $array['descricao'], $array['imagem1'], $array['imagem2'], $array['imagem3'], $array['pontos'], $array['quantidade'], $array['validade'] );
    }


}