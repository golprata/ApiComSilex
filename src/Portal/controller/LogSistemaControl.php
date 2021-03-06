<?php

namespace Portal\controller;

class LogSistemaController{
	protected $con;
	protected $objLogSistema;
	protected $objLogSistemaDAO;
	
	function __construct(LogSistema $objLogSistema=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objLogSistemaDAO = new LogSistemaDAO($this->con);
		$this->objLogSistema = $objLogSistema;
	}
	
	function cadastrar(){
		return $this->objLogSistemaDAO->cadastrar($this->objLogSistema);
	}
	
	function atualizar(){
		return $this->objLogSistemaDAO->atualizar($this->objLogSistema);
	}
	function deletar(){
		return $this->objLogSistemaDAO->deletar($this->objLogSistema);
	}
	function buscarPorId(){
		return $this->objLogSistemaDAO->buscarPorId($this->objLogSistema);
	}
	function listarPorNivel(){
		return $this->objLogSistemaDAO->listarPorNivel($this->objLogSistema);
	}
	function listarPorUsuario(){
		return $this->objLogSistemaDAO->listarPorUsuario($this->objLogSistema);
	}
	function listarTodos(){
		return $this->objLogSistemaDAO->listarTodos($this->objLogSistema);
	}
	function listarPaginado($start, $limit){
		return $this->objLogSistemaDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objLogSistemaDAO->qtdTotal();
	}
}

?>