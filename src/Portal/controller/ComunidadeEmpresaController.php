<?php

namespace Portal\controller;

class ComunidadeEmpresaController{
	protected $con;
	protected $objComunidadeEmpresa;
	protected $objComunidadeEmpresaDAO;
	
	function __construct(ComunidadeEmpresa $objComunidadeEmpresa=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objComunidadeEmpresaDAO = new ComunidadeEmpresaDAO($this->con);
		$this->objComunidadeEmpresa = $objComunidadeEmpresa;
	}
	
	function cadastrar(){
		return $this->objComunidadeEmpresaDAO->cadastrar($this->objComunidadeEmpresa);
	}
	
	function atualizar(){
		return $this->objComunidadeEmpresaDAO->atualizar($this->objComunidadeEmpresa);
	}
	function deletar(){
		return $this->objComunidadeEmpresaDAO->deletar($this->objComunidadeEmpresa);
	}
	function buscarPorId(){
		return $this->objComunidadeEmpresaDAO->buscarPorId($this->objComunidadeEmpresa);
	}
	function listarTodos(){
		return $this->objComunidadeEmpresaDAO->listarTodos($this->objComunidadeEmpresa);
	}
	function listarPaginado($start, $limit){
		return $this->objComunidadeEmpresaDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objComunidadeEmpresaDAO->qtdTotal();
	}
}

?>