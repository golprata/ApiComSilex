<?php

namespace Portal\controller;

class UsuarioController{
	protected $con;
	protected $o_usuario;
	protected $o_usuarioDAO;

	function __construct(Usuario $o_usuario= null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->o_usuarioDAO = new UsuarioDAO($this->con);
		$this->o_usuario = $o_usuario;
	}

	function cadastrar(){
		$id = $this->o_usuarioDAO->cadastrar($this->o_usuario);
		return $id;  // para desfazer o id de retorno
	}

	function atualizar(){
		$this->o_usuarioDAO->atualizar($this->o_usuario);
	}

	function deletar(){
		$this->o_usuarioDAO->deletar($this->o_usuario);
	}

	function buscarPorId(){
		return $this->o_usuarioDAO->buscarPorId($this->o_usuario);
	}

	function buscarPorPessoaFisica(){
		return $this->o_usuarioDAO->buscarPorPessoaFisica($this->o_usuario);
	}

	function listarPorPessoa(){
		return $this->o_usuarioDAO->listarPorNome($this->o_usuario);
	}
	
	function listarTodos(){
		return $this->o_usuarioDAO->listarTodos();
	}
	
	function listarPaginado($start, $limit){
		return $this->o_usuarioDAO->listarPaginado($start, $limit);
	}
	
	function qtdTotal(){
		return $this->o_usuarioDAO->qtdTotal();
	}

	function buscarPorUsuario(){
		return $this->o_usuarioDAO->buscarPorUsuario($this->o_usuario);
	}


}
?>