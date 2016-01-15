<?php

namespace Portal\controller;

class ListaDesejoController{
	protected $con;
	protected $objListaDesejo;
	protected $objListaDesejoDAO;
	
	function __construct(ListaDesejo $objListaDesejo=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objListaDesejoDAO = new ListaDesejoDAO($this->con);
		$this->objListaDesejo = $objListaDesejo;
	}
	
	function cadastrar(){
		return $this->objListaDesejoDAO->cadastrar($this->objListaDesejo);
	}
	
	function atualizar(){
		return $this->objListaDesejoDAO->atualizar($this->objListaDesejo);
	}
	function deletar(){
		return $this->objListaDesejoDAO->deletar($this->objListaDesejo);
	}
	function buscarPorId(){
		return $this->objListaDesejoDAO->buscarPorId($this->objListaDesejo);
	}
	function listarTodos(){
		return $this->objListaDesejoDAO->listarTodos($this->objListaDesejo);
	}
	function listarPaginado($start, $limit){
		return $this->objListaDesejoDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objListaDesejoDAO->qtdTotal();
	}
	function listarPorAdmin($idadm){
		return $this->objListaDesejoDAO->listarPorAdmin($idadm);
	}
}

?>