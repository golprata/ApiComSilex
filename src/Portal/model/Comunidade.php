<?php

namespace Portal\model;

class Comunidade implements JsonSerializable
{
    private $id;
    private $nome;
    private $objEmpresa;
    private $objCriador;
    private $logo;
    private $datacadastro;
    private $dataedicao;

    /**
     * Comunidade constructor.
     * @param $id
     * @param $nome
     * @param $objEmpresa
     * @param $objCriador
     * @param $logo
     * @param $datacadastro
     * @param $dataedicao
     */
    public function __construct($id = null, $nome = null, Empresa $objEmpresa = null, Usuario $objCriador = null, $logo = null, $datacadastro = null, $dataedicao = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->objEmpresa = $objEmpresa;
        $this->objCriador = $objCriador;
        $this->logo = $logo;
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
    public function getObjEmpresa()
    {
        return $this->objEmpresa;
    }

    /**
     * @param mixed $objEmpresa
     */
    public function setObjEmpresa($objEmpresa)
    {
        $this->objEmpresa = $objEmpresa;
    }

    /**
     * @return mixed
     */
    public function getObjCriador()
    {
        return $this->objCriador;
    }

    /**
     * @param mixed $objCriador
     */
    public function setObjCriador($objCriador)
    {
        $this->objCriador = $objCriador;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
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
            'empresa'       => $this->objEmpresa,
            'criador'       => $this->objCriador,
            'logo'          => $this->logo,
            'datacadastro'  => $this->datacadastro,
            'dataedicao'    => $this->dataedicao
        ];
    }

    public static function factory($array)
    {
        return new Comunidade( null, $array['nome'], new Empresa($array['empresa']), new Usuario($array['usuario']), $array['logo']);
    }

}