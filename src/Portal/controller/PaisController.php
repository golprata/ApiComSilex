<?php

namespace Portal\controller;

//use Portal\model\Pais;
//use Portal\model\PaisDAO;
//use Portal\utils\Conexao;

class PaisController{
	protected $con;
	protected $o_pais;
	protected $o_paisDAO;

	function __construct($con){
//		$this->con = $con;
		$this->o_paisDAO = new PaisDAO($con);
//		$this->o_pais = null;
	}

	function cadastrar(){
		$id = $this->o_paisDAO->cadastrar($this->o_pais);
		return $id;  // para desfazer o id de retorno
	}

	function atualizar(){
		$this->o_paisDAO->atualizar($this->o_pais);
	}

	function deletar(){
		$this->o_paisDAO->deletar($this->o_pais);
	}

	function buscarPorId(){
		return $this->o_paisDAO->buscarPorId($this->o_pais);
	}

	function listarPorPessoa(){
		return $this->o_paisDAO->listarPorNome($this->o_pais);
	}
	
	function listarTodos(){
		return $this->o_paisDAO->listarTodos();
	}
	
	function listarPaginado($start, $limit){
		return $this->o_paisDAO->listarPaginado($start, $limit);
	}
	
	function qtdTotal(){
		return $this->o_paisDAO->qtdTotal();
	}

}
?>