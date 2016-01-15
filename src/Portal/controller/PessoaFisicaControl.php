<?php

namespace Portal\controller;

class PessoaFisicaController{
	protected $con;
	protected $objPessoaFisica;
	protected $objPessoaFisicaDAO;
	
	function __construct(PessoaFisica $objPessoaFisica=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objPessoaFisicaDAO = new PessoaFisicaDAO($this->con);
		$this->objPessoaFisica = $objPessoaFisica;
	}
	
	function cadastrar(){
		return $this->objPessoaFisicaDAO->cadastrar($this->objPessoaFisica);
	}
	
	function atualizar(){
		return $this->objPessoaFisicaDAO->atualizar($this->objPessoaFisica);
	}
	function atualizarImportado(){
		return $this->objPessoaFisicaDAO->atualizarImportado($this->objPessoaFisica);
	}
	function deletar(){
		return $this->objPessoaFisicaDAO->deletar($this->objPessoaFisica);
	}
	function buscarPorId(){
		return $this->objPessoaFisicaDAO->buscarPorId($this->objPessoaFisica);
	}
	function listarTodos(){
		return $this->objPessoaFisicaDAO->listarTodos($this->objPessoaFisica);
	}
	function listarPorNome(){
		return $this->objPessoaFisicaDAO->listarPorNome($this->objPessoaFisica);
	}
	function listarPaginado($start, $limit){
		return $this->objPessoaFisicaDAO->listarPaginado($start, $limit);
	}
	function listarNaoImportadosPaginado($start, $limit){
		return $this->objPessoaFisicaDAO->listarNaoImportadosPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objPessoaFisicaDAO->qtdTotal();
	}
	function qtdTotalNaoImportados(){
		return $this->objPessoaFisicaDAO->qtdTotalNaoImportados();
	}
}

?>