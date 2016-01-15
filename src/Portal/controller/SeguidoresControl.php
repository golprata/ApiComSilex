<?php

namespace Portal\controller;

class SeguidoresController{
	protected $con;
	protected $objSeguidores;
	protected $objSeguidoresDAO;
	
	function __construct(Seguidores $objSeguidores=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objSeguidoresDAO = new SeguidoresDAO($this->con);
		$this->objSeguidores = $objSeguidores;
	}
	
	function cadastrar(){
		return $this->objSeguidoresDAO->cadastrar($this->objSeguidores);
	}
	
	function atualizar(){
		return $this->objSeguidoresDAO->atualizar($this->objSeguidores);
	}
	function deletar(){
		return $this->objSeguidoresDAO->deletar($this->objSeguidores);
	}
	function buscarPorId(){
		return $this->objSeguidoresDAO->buscarPorId($this->objSeguidores);
	}
	function listarTodos(){
		return $this->objSeguidoresDAO->listarTodos($this->objSeguidores);
	}
	function listarPaginado($start, $limit){
		return $this->objSeguidoresDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objSeguidoresDAO->qtdTotal();
	}
	function listarPorUsuario($idusuario){
		return $this->objSeguidoresDAO->listarPorUsuario($idusuario);
	}
	function listarSeguidores($idseguido){
		return $this->objSeguidoresDAO->listarSeguidores($idseguido);
	}
	function listarSeguidoresPJ($idseguido){
		return $this->objSeguidoresDAO->listarSeguidoresPJ($idseguido);
	}
}

?>