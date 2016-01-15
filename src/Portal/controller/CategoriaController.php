<?php

namespace Portal\controller;

class CategoriaController
{
    protected $con;
    protected $o_categoria;
    protected $o_categoriaDAO;

    /**
     * CategoriaControl constructor.
     * @param $con
     * @param $o_categoria
     * @param $o_categoriaDAO
     */

    public function __construct(Categoria $o_categoria=null)
    {
        $this->con = Conexao::getInstance()->getConexao();
        $this->o_categoriaDAO = new CategoriaDAO($this->con);
        $this->o_categoria = $o_categoria;
    }

    function cadastrar(){
        $id = $this->o_categoriaDAO->cadastrar($this->o_categoria);
        return $id;  // para desfazer o id de retorno
    }

    function atualizar(){
        $this->o_categoriaDAO->atualizar($this->o_categoria);
    }

    function deletar(){
        $this->o_categoriaDAO->deletar($this->o_categoria);
    }

    function listarTodos(){
        return $this->o_categoriaDAO->buscarCategorias();
    }

    function buscarPorId(){
        return $this->o_categoriaDAO->buscarPorId($this->o_categoria);
    }

}

?>