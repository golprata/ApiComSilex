<?php

namespace Portal\controller;

class ComplementoPFControlller{
	protected $con;
	protected $objComplementoPF;
	protected $objComplementoPFDAO;
	
	function __construct(ComplementoPF $objComplementoPF=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objComplementoPFDAO = new ComplementoPFDAO($this->con);
		$this->objComplementoPF = $objComplementoPF;
	}
	
	function cadastrar(){
		return $this->objComplementoPFDAO->cadastrar($this->objComplementoPF);
	}
	
	function atualizar(){
		return $this->objComplementoPFDAO->atualizar($this->objComplementoPF);
	}
	function deletar(){
		return $this->objComplementoPFDAO->deletar($this->objComplementoPF);
	}
	function buscarPorId(){
		return $this->objComplementoPFDAO->buscarPorId($this->objComplementoPF);
	}
	function listarTodos(){
		return $this->objComplementoPFDAO->listarTodos($this->objComplementoPF);
	}
	function listarPaginado($start, $limit){
		return $this->objComplementoPFDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objComplementoPFDAO->qtdTotal();
	}
	function listarPorPessoaFisica($idpessoafisica){
		return $this->objComplementoPFDAO->listarPorPessoaFisica($idpessoafisica);
	}
}

?>