<?php

namespace Portal\model;

class Categoria implements JsonSerializable
{
    private $id;
    private $nome;
    private $datacadastro;
    private $dataedicao;

    /**
     * Categoria constructor.
     * @param $id
     * @param $nome
     * @param $datacadastro
     * @param $dataedicao
     */
    public function __construct($id=null, $nome=null, $datacadastro=null, $dataedicao=null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->datacadastro = $datacadastro;
        $this->dataedicao = $dataedicao;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getDatacadastro()
    {
        return $this->datacadastro;
    }

    /**
     * @param mixed $datacadastro
     */
    public function setDatacadastro($datacadastro)
    {
        $this->datacadastro = $datacadastro;
    }

    /**
     * @return mixed
     */
    public function getDataedicao()
    {
        return $this->dataedicao;
    }

    /**
     * @param mixed $dataedicao
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
            'datacadastro'  => $this->datacadastro,
            'dataedicao'    => $this->dataedicao
        ];
    }

    public static function factory($array)
    {
        return new Categoria( null, $array['nome']);
    }


}