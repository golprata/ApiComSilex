<?php

namespace Portal\controller;

class ExtratoGeralController{
	protected $con;
	protected $objExtratoGeral;
	protected $objExtratoGeralDAO;
	
	function __construct(ExtratoGeral $objExtratoGeral=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objExtratoGeralDAO = new ExtratoGeralDAO($this->con);
		$this->objExtratoGeral = $objExtratoGeral;
	}
	
	function cadastrar(){
		return $this->objExtratoGeralDAO->cadastrar($this->objExtratoGeral);
	}
	
	function atualizar(){
		return $this->objExtratoGeralDAO->atualizar($this->objExtratoGeral);
	}
	function deletar(){
		return $this->objExtratoGeralDAO->deletar($this->objExtratoGeral);
	}
	function buscarPorId(){
		return $this->objExtratoGeralDAO->buscarPorId($this->objExtratoGeral);
	}
	function listarTodos(){
		return $this->objExtratoGeralDAO->listarTodos($this->objExtratoGeral);
	}
	function listarPaginado($start, $limit){
		return $this->objExtratoGeralDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objExtratoGeralDAO->qtdTotal();
	}
}

?>