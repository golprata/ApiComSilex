<?php

namespace Portal\model;

class EmpresaDAO {
	private $con;
	private $sql;
	private $o_empresa;
	private $lista = array ();
	
	function __construct($con) {
		$this->con = $con;
	}
	
	function cadastrar(Empresa $o_empresa) {
		$this->sql = sprintf ( "INSERT INTO empresa (nomeFantasia, razaoSocial, nomeReduzido, CNPJ, inscricaoEstadual, inscricaoMunicipal, endereco, numero, complemento, bairro, cep, cidade, tel_fixo, tel_celular, email, site, imagemLogotipo, idlocalidade) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s','%s', '%s', '%s', '%s', %d)",
				mysqli_real_escape_string ( $this->con, $o_empresa->getNomeFantasia () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getRazaoSocial () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getNomeReduzido () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getCNPJ () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getInscricaoEstadual () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getInscricaoMunicipal () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getEndereco () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getNumero () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getComplemento()), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getBairro () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getCep () ),
				mysqli_real_escape_string ( $this->con, $o_empresa->getCidade() ),
				mysqli_real_escape_string ( $this->con, $o_empresa->getTelFixo() ),
				mysqli_real_escape_string ( $this->con, $o_empresa->getTelCelular() ),
				mysqli_real_escape_string ( $this->con, $o_empresa->getEmail() ),
				mysqli_real_escape_string ( $this->con, $o_empresa->getSite() ),
				mysqli_real_escape_string ( $this->con, $o_empresa->getImagemLogotipo () ),
				mysqli_real_escape_string ( $this->con, $o_empresa->getObjLocalidade()->getId ()));
		
		if (! mysqli_query ( $this->con, $this->sql )) {
			die ( 'Error: ' . mysqli_error ( $this->con ) );
		}
		return mysqli_insert_id ( $this->con );
	}
	function atualizar(Empresa $o_empresa) {
		$this->sql = sprintf ( "UPDATE empresa SET nomeFantasia= '%s', razaoSocial= '%s', nomeReduzido= '%s', CNPJ= '%s', inscricaoEstadual='%s', inscricaoMunicipal='%s', endereco='%s', numero='%s', complemento='%s', bairro='%s', cep='%s', cidade='%s', tel_fixo='%s', tel_celular='%s', email='%s', site='%s',  imagemLogotipo='%s', dataedicao='%s', idlocalidade=%d WHERE id= %d",
				mysqli_real_escape_string ( $this->con, $o_empresa->getNomeFantasia () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getRazaoSocial () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getNomeReduzido () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getCNPJ () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getInscricaoEstadual () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getInscricaoMunicipal () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getEndereco () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getNumero () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getComplemento () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getBairro () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getCep () ),
				mysqli_real_escape_string ( $this->con, $o_empresa->getCidade() ),
				mysqli_real_escape_string ( $this->con, $o_empresa->getTelFixo() ),
				mysqli_real_escape_string ( $this->con, $o_empresa->getTelCelular() ),
				mysqli_real_escape_string ( $this->con, $o_empresa->getEmail() ),
				mysqli_real_escape_string ( $this->con, $o_empresa->getSite() ),
				mysqli_real_escape_string ( $this->con, $o_empresa->getImagemLogotipo () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getDataedicao () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getObjLocalidade ()->getId () ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getId () ) );
		
		if (! mysqli_query ( $this->con, $this->sql )) {
			die ( 'Error: ' . mysqli_error ( $this->con ) );
		}
	}
	function deletar(Empresa $o_empresa) {
		$this->sql = sprintf ( "DELETE FROM empresa WHERE id = %d", mysqli_real_escape_string ( $this->con, $o_empresa->getId () ) );
		if (! mysqli_query ( $this->con, $this->sql )) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		return $o_empresa;
	}
	
	/* -- Buscar por ID -- */
	function buscarPorID(Empresa $o_empresa) {
		$this->sql = sprintf ( "SELECT * FROM empresa WHERE id = %d", mysqli_real_escape_string ( $this->con, $o_empresa->getId () ) );
		
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		while ( $row = mysqli_fetch_object ( $result ) ) {
			// busca o localidade desse empresa
			$localidade = new Localidade ( $row->idlocalidade );
			$localidadeControl = new LocalidadeControl ( $localidade );
			$a_localidade = $localidadeControl->buscarPorId ();
			
			$this->o_empresa = new Empresa ( $row->id, $row->nomeFantasia, $row->razaoSocial, $row->nomeReduzido, $row->CNPJ, $row->inscricaoEstadual, $row->inscricaoMunicipal, $row->endereco, $row->numero, $row->complemento, $row->bairro, $row->cep, $row->cidade, $row->tel_fixo, $row->tel_celular, $row->email, $row->site,  $row->imagemLogotipo, $row->datacadastro, $row->dataedicao, $a_localidade );
		}
		
		return $this->o_empresa;
	}
	
	/* -- Listar Todos -- */
	function listarTodos() {
		$this->sql = "SELECT * FROM empresa";
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		while ( $row = mysqli_fetch_object ( $result ) ) {
			// busca o localidade desse empresa
			$localidade = new Localidade ( $row->idlocalidade );
			$localidadeControl = new LocalidadeControl ( $localidade );
			$a_localidade = $localidadeControl->buscarPorId ();
			
			$this->o_empresa = new Empresa ( $row->id, $row->nomeFantasia, $row->razaoSocial, $row->nomeReduzido, $row->CNPJ, $row->inscricaoEstadual, $row->inscricaoMunicipal, $row->endereco, $row->numero, $row->complemento, $row->bairro, $row->cep, $row->cidade, $row->tel_fixo, $row->tel_celular, $row->email, $row->site, $row->imagemLogotipo, $row->datacadastro, $row->dataedicao, $a_localidade );
			$this->lista [] = $this->o_empresa;
		}
		
		return $this->lista;
	}
	
	function listarPaginado($start, $limit) {
			$this->sql = "SELECT * FROM empresa LIMIT " . $start . ", " . $limit;
			$result = mysqli_query ( $this->con, $this->sql );
			if (! $result) {
				die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
			}
			while ( $row = mysqli_fetch_assoc( $result ) ) {
				
				$lista [] = $row;
			}
			
			return $lista;
		}
		
		function qtdTotal() {
			$this->sql = "SELECT count(*) as quantidade FROM empresa";
			$result = mysqli_query ( $this->con, $this->sql );
			if (! $result) {
				die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
			}
			$total = 0;
			while ( $row = mysqli_fetch_object ( $result ) ) {
				$total = $row->quantidade;
			}
		
			return $total;
		}
	
	/* -- Listar Por Nome -- */
	function listarPorNome(Empresa $o_empresa) {
		/* -- SQL PASSANDO COM %s(String do sprtintf) o percente % do LIKE -- */
		$this->sql = sprintf ( "SELECT * FROM empresa WHERE nomeFantasia LIKE '%s%s%s' OR nomeReduzido LIKE '%s%s%s' OR razaoSocial LIKE '%s%s%s' ", 
				mysqli_real_escape_string ( $this->con, '%' ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getNomeFantasia() ), 
				mysqli_real_escape_string ( $this->con, '%' ),
				mysqli_real_escape_string ( $this->con, '%' ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getNomeReduzido() ), 
				mysqli_real_escape_string ( $this->con, '%' ),
				mysqli_real_escape_string ( $this->con, '%' ), 
				mysqli_real_escape_string ( $this->con, $o_empresa->getRazaoSocial() ), 
				mysqli_real_escape_string ( $this->con, '%' ) );
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		while ( $row = mysqli_fetch_object ( $result ) ) {
			// busca o localidade desse empresa
			$localidade = new Localidade ( $row->idlocalidade );
			$localidadeControl = new LocalidadeControl ( $localidade );
			$a_localidade = $localidadeControl->buscarPorId ();
			
			$this->o_empresa = new Empresa ( $row->id, $row->nomeFantasia, $row->razaoSocial, $row->nomeReduzido, $row->CNPJ, $row->inscricaoEstadual, $row->inscricaoMunicipal, $row->endereco, $row->numero, $row->complemento, $row->bairro, $row->cep, $row->cidade, $row->tel_fixo, $row->tel_celular, $row->email, $row->site, $row->imagemLogotipo, $row->datacadastro, $row->dataedicao, $a_localidade );
			$this->lista [] = $this->o_empresa;
		}
		
		return $this->lista;
	}
}