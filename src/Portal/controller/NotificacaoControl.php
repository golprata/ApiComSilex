<?php

namespace Portal\controller;

class NotificacaoController{
	protected $con;
	protected $objNotificacao;
	protected $objNotificacaoDAO;
	
	function __construct(Notificacao $objNotificacao=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objNotificacaoDAO = new NotificacaoDAO($this->con);
		$this->objNotificacao = $objNotificacao;
	}
	
	function cadastrar(){
		return $this->objNotificacaoDAO->cadastrar($this->objNotificacao);
	}
	
	function atualizar(){
		return $this->objNotificacaoDAO->atualizar($this->objNotificacao);
	}
	function atualizarStatus(){
		return $this->objNotificacaoDAO->atualizarStatus($this->objNotificacao);
	}
	function deletar(){
		return $this->objNotificacaoDAO->deletar($this->objNotificacao);
	}
	function buscarPorId(){
		return $this->objNotificacaoDAO->buscarPorId($this->objNotificacao);
	}
	function listarTodos(){
		return $this->objNotificacaoDAO->listarTodos($this->objNotificacao);
	}
	function listarTodosPendentesPorUsuario(){
		return $this->objNotificacaoDAO->listarTodosPendentesPorUsuario($this->objNotificacao);
	}
	function listarPaginado($start, $limit){
		return $this->objNotificacaoDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objNotificacaoDAO->qtdTotal();
	}
	function qtdTotalPendente(){
		return $this->objNotificacaoDAO->qtdTotalPendente($this->objNotificacao);
	}
	function listarPorPessoaFisica($idpessoafisica){
	}
}

?>