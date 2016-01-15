<?php

namespace Portal\model;

class ExtratoGeral implements JsonSerializable {
	/*-- atributos --*/
	private $id;
	private $objusuario;
	private $objempresa;
	private $idgeral;
	private $tipoid;
	private $pontos;
	private $observacao;
	private $datacadastro;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id 								= NULL,
		Usuario $objusuario					= NULL,
		Empressa $objEmpresa				= NULL,
		$idgeral							= NULL,
		$tipoid								= NULL,
		$pontos								= NULL,
		$observacao							= NULL,
		$datacadastro						= NULL
	)
	{
		$this->id 						= $id;
		$this->objusuario				= $objusuario;
		$this->objempresa				= $objempresa;
		$this->idgeral					= $idgeral;
		$this->tipoid					= $tipoid;
		$this->pontos					= $pontos;
		$this->observacao				= $observacao;
		$this->datacadastro				= $datacadastro;
	}
	
	/*-- Getters and Setters --*/
	public function getObjusuario() {
		return $this->objusuario;
	}
	public function setObjusuario($objusuario) {
		$this->objusuario = $objusuario;
		return $this;
	}
	public function getObjempresa() {
		return $this->objempresa;
	}
	public function setObjempresa($objempresa) {
		$this->objempresa = $objempresa;
		return $this;
	}
	public function getIdgeral() {
		return $this->idgeral;
	}
	public function setIdgeral($idgeral) {
		$this->idgeral = $idgeral;
		return $this;
	}
	public function getTipoid() {
		return $this->tipoid;
	}
	public function setTipoid($tipoid) {
		$this->tipoid = $tipoid;
		return $this;
	}
	public function getPontos() {
		return $this->pontos;
	}
	public function setPontos($pontos) {
		$this->pontos = $pontos;
		return $this;
	}
	public function getObservacao() {
		return $this->observacao;
	}
	public function setObservacao($observacao) {
		$this->observacao = $observacao;
		return $this;
	}
	
	/*-- to string --*/
	public function __toString(){
		return sprintf("ExtratoGeral [ ID: %d, IDGeral: %d, TipoID: %s, Data Cadastro: %s, Data Edição: %s ]",
				$this->id, $this->idgeral, $this->tipoid, $this->datacadastro, $this->dataedicao );
	}
	
	/*-- Json Serializable --*/
	public function jsonSerialize(){
		return[
			'id'					=> $this->id,
			'objusuario'			=> $this->objusuario->jsonSerialize(),
			'objempresa'			=> $this->objempresa->jsonSerialize(),
			'idgeral'				=> $this->idgeral,
			'tipoid'				=> $this->tipoid,
			'pontos'				=> $this->pontos,
			'observacao'			=> $this->observacao,
			'datacadastro'			=> $this->datacadastro,
		];
	}
	
	
}

?>