<?php

namespace Portal\controller;

class PremioController
{
    protected $con;
    protected $objPremio;
    protected $objPremioDAO;

    /**
     * PremioControl constructor.
     * @param $objPremio
     */
    public function __construct(Premio $objPremio)
    {
        $this->con = Conexao::getInstance()->getConexao();
        $this->objPremioDAO = new PremioDAO($this->con);
        $this->objPremio = $objPremio;
    }

    function cadastrar(){
        $id = $this->objPremioDAO->cadastrar($this->objPremio);
        return $id;  // para desfazer o id de retorno
    }

    function atualizar(){
        $this->objPremioDAO->atualizar($this->objPremio);
    }

    function deletar(){
        $this->objPremioDAO->deletar($this->objPremio);
    }

    function listarTodos(){
        return $this->objPremioDAO->buscarTodos();
    }

    function buscarPorId(){
        return $this->objPremioDAO->buscarPorId($this->objPremio);
    }


}