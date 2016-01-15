<?php

namespace Portal\model;

class Tag
{
    private $id;
    private $nome;
    private $datacadastro;
    private $dataedicao;

    /**
     * Tag constructor.
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
            'datacadastro'  => $this->datacadastro,
            'datedicao'     => $this->dataedicao
        ];
    }

    public static function factory($array)
    {
        return new Tag( null, $array['nome'] );
    }


}