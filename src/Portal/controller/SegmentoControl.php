<?php

namespace Portal\controller;

class SegmentoController{
	protected $con;
	protected $objSegmento;
	protected $objSegmentoDAO;
	
	function __construct(Segmento $objSegmento=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objSegmentoDAO = new SegmentoDAO($this->con);
		$this->objSegmento = $objSegmento;
	}
	
	function cadastrar(){
		return $this->objSegmentoDAO->cadastrar($this->objSegmento);
	}
	
	function atualizar(){
		return $this->objSegmentoDAO->atualizar($this->objSegmento);
	}
	function deletar(){
		return $this->objSegmentoDAO->deletar($this->objSegmento);
	}
	function buscarPorId(){
		return $this->objSegmentoDAO->buscarPorId($this->objSegmento);
	}
	function listarTodos(){
		return $this->objSegmentoDAO->listarTodos($this->objSegmento);
	}
	function listarPaginado($start, $limit){
		return $this->objSegmentoDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objSegmentoDAO->qtdTotal();
	}

}

?>