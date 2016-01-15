<?php

namespace Portal\controller;

class AdminEmpresaController{
	protected $con;
	protected $objAdminEmpresa;
	protected $objAdminEmpresaDAO;
	
	function __construct(AdminEmpresa $objAdminEmpresa=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objAdminEmpresaDAO = new AdminEmpresaDAO($this->con);
		$this->objAdminEmpresa = $objAdminEmpresa;
	}
	
	function cadastrar(){
		return $this->objAdminEmpresaDAO->cadastrar($this->objAdminEmpresa);
	}
	
	function atualizar(){
		return $this->objAdminEmpresaDAO->atualizar($this->objAdminEmpresa);
	}
	function deletar(){
		return $this->objAdminEmpresaDAO->deletar($this->objAdminEmpresa);
	}
	function buscarPorId(){
		return $this->objAdminEmpresaDAO->buscarPorId($this->objAdminEmpresa);
	}
	function listarTodos(){
		return $this->objAdminEmpresaDAO->listarTodos($this->objAdminEmpresa);
	}
	function listarPaginado($start, $limit){
		return $this->objAdminEmpresaDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objAdminEmpresaDAO->qtdTotal();
	}
	function listarPorEmpresa($idempresa){
		return $this->objAdminEmpresaDAO->listarPorEmpresa($idempresa);
	}
}

?>