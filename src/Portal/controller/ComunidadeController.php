<?php

namespace Portal\controller;

class ComunidadeController
{
    protected $con;
    protected $objComunidade;
    protected $objComunidadeDAO;

    /**
     * ComunidadeControl constructor.
     * @param $con
     */
    public function __construct(Comunidade $objComunidade=null)
    {
        $this->con = Conexao::getInstance()->getConexao();
        $this->objComunidadeDAO = new ComunidadeDAO($this->con);
        $this->objComunidade = $objComunidade;
    }

    function cadastrar(){
        $id = $this->objComunidadeDAO->cadastrar($this->objComunidade);
        return $id;  // para desfazer o id de retorno
    }

    function atualizar(){
        $this->objComunidadeDAO->atualizar($this->objComunidade);
    }

    function deletar(){
        $this->objComunidadeDAO->deletar($this->objComunidade);
    }

    function listarTodos(){
        return $this->objComunidadeDAO->buscarTodos();
    }

    function buscarPorId(){
        return $this->objComunidadeDAO->buscarPorId($this->objComunidade);
    }


}