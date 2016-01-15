<?php

namespace Portal\controller;

class LeadController{
	protected $con;
	protected $objLead;
	protected $objLeadDAO;
	
	function __construct(Lead $objLead=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objLeadDAO = new LeadDAO($this->con);
		$this->objLead = $objLead;
	}
	
	function cadastrar(){
		return $this->objLeadDAO->cadastrar($this->objLead);
	}
	
	function atualizar(){
		return $this->objLeadDAO->atualizar($this->objLead);
	}
	function deletar(){
		return $this->objLeadDAO->deletar($this->objLead);
	}
	function buscarPorId(){
		return $this->objLeadDAO->buscarPorId($this->objLead);
	}
	function listarTodos(){
		return $this->objLeadDAO->listarTodos();
	}
	function listarPaginado($start, $limit){
		return $this->objLeadDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objLeadDAO->qtdTotal();
	}
}

?>