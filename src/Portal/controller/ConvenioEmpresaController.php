<?php

namespace Portal\controller;

class ConvenioEmpresaController{
	protected $con;
	protected $objConvenioEmpresa;
	protected $objConvenioEmpresaDAO;
	
	function __construct(ConvenioEmpresa $objConvenioEmpresa=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objConvenioEmpresaDAO = new ConvenioEmpresaDAO($this->con);
		$this->objConvenioEmpresa = $objConvenioEmpresa;
	}
	
	function cadastrar(){
		return $this->objConvenioEmpresaDAO->cadastrar($this->objConvenioEmpresa);
	}
	
	function atualizar(){
		return $this->objConvenioEmpresaDAO->atualizar($this->objConvenioEmpresa);
	}
	function deletar(){
		return $this->objConvenioEmpresaDAO->deletar($this->objConvenioEmpresa);
	}
	function buscarPorId(){
		return $this->objConvenioEmpresaDAO->buscarPorId($this->objConvenioEmpresa);
	}
	function listarTodos(){
		return $this->objConvenioEmpresaDAO->listarTodos($this->objConvenioEmpresa);
	}
	function listarPaginado($start, $limit){
		return $this->objConvenioEmpresaDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objConvenioEmpresaDAO->qtdTotal();
	}
	function listarPorEmpresa($idempresa){
		return $this->objConvenioEmpresaDAO->listarPorEmpresa($idempresa);
	}
	function listarPorConvenio($idconvenio){
		return $this->objConvenioEmpresaDAO->listarPorConvenio($idconvenio);
	}
}

?>