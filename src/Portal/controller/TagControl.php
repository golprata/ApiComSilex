<?php

namespace Portal\controller;

class TagController
{
    protected $con;
    protected $tag;
    protected $tagDAO;

    /**
     * TagControl constructor.
     * @param $con
     * @param $tag
     * @param $tagDAO
     */
    public function __construct(Tag $tag)
    {
        $this->con = Conexao::getInstance()->getConexao();
        $this->tag = $tag;
        $this->tagDAO = new TagDAO($this->con);
    }

    function cadastrar(){
        $id = $this->tagDAO->cadastrar($this->tag);
        return $id;  // para desfazer o id de retorno
    }

    function atualizar(){
        $this->tagDAO->atualizar($this->tag);
    }

    function deletar(){
        $this->tagDAO->deletar($this->tag);
    }

    function listarTodos(){
        return $this->tagDAO->buscarTodos();
    }

    function buscarPorId(){
        return $this->tagDAO->buscarPorId($this->tag);
    }


}