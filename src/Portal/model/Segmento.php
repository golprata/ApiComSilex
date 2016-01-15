<?php

namespace Portal\model;

class Segmento implements JsonSerializable
{
	/*-- atributos --*/
	private $id;
	private $descricao;
	private $datacadastro;
	private $dataedicao;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id 									= NULL,
		$descricao								= NULL,
		$datacadastro							= NULL,
		$dataedicao 							= NULL
	)
	{
		$this->id 					= $id;
		$this->descricao 			= $descricao;
		$this->datacadastro 		= $datacadastro;
		$this->dataedicao 			= $dataedicao;
	}
	
	/*-- Getters and Setters --*/
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
		return $this;
	}
	public function getDatacadastro() {
		return $this->datacadastro;
	}
	public function setDatacadastro($datacadastro) {
		$this->datacadastro = $datacadastro;
		return $this;
	}
	public function getDataedicao() {
		return $this->dataedicao;
	}
	public function setDataedicao($dataedicao) {
		$this->dataedicao = $dataedicao;
		return $this;
	}
	
	
	/*-- to string --*/
	public function __toString(){
		return sprintf("Segmento [ ID: %d, Descri��o: %s, Data Cadastro: %s, Data Edição: %s ]",
				$this->id, $this->descricao, $this->datacadastro, $this->dataedicao );
	}
	
	/*-- Json Serializable --*/
	public function jsonSerialize(){
		return[
			'id'					=> $this->id,
			'descricao'				=> $this->descricao,
			'datacadastro'			=> $this->datacadastro,
			'dataedicao'			=> $this->dataedicao
		];
	}
	
	
}

?>