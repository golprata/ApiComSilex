<?php

namespace Portal\controller;

class CupomControl{
	protected $con;
	protected $objCupom;
	protected $objCupomDAO;
	
	function __construct(Cupom $objCupom=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objCupomDAO = new CupomDAO($this->con);
		$this->objCupom = $objCupom;
	}
	
	function cadastrar(){
		return $this->objCupomDAO->cadastrar($this->objCupom);
	}
	
	function atualizar(){
		return $this->objCupomDAO->atualizar($this->objCupom);
	}
	function deletar(){
		return $this->objCupomDAO->deletar($this->objCupom);
	}
	function buscarPorId(){
		return $this->objCupomDAO->buscarPorId($this->objCupom);
	}
	function listarTodos(){
		return $this->objCupomDAO->listarTodos($this->objCupom);
	}
	function listarPaginado($start, $limit){
		return $this->objCupomDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objCupomDAO->qtdTotal();
	}
	function listarPorAdmin($idadm){
		return $this->objCupomDAO->listarPorAdmin($idadm);
	}
}

?>