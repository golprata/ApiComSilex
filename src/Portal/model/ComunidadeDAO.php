<?php

namespace Portal\model;

class ComunidadeDAO
{
    private $con;
    private $query;
    private $objComunidade;
    private $lista;

    /**
     * ComunidadeDAO constructor.
     * @param $con
     */
    public function __construct($con)
    {
        $this->con = $con;
    }

    public function cadastrar(Comunidade $objComunidade)
    {
        $this->query = sprintf("INSERT INTO comunidade (nome, idempresa, idcriador, logo) VALUES ('%s', %d, %d, '%s')",
            mysqli_real_escape_string( $this->con, $objComunidade->getNome() ),
            mysqli_real_escape_string( $this->con, $objComunidade->getObjEmpresa()->getId() ),
            mysqli_real_escape_string( $this->con, $objComunidade->getObjCriador()->getId() ),
            mysqli_real_escape_string( $this->con, $objComunidade->getLogo() ) );

        if(!mysqli_query($this->con, $this->query)){
            die('[ERRO] Cadastro: '.mysqli_error($this->con));
        }

        /*-- Pegando ultimo obj cadastrado --*/
        return mysqli_insert_id ( $this->con );
    }

    function atualizar(Comunidade $objComunidade){
        $this->query = sprintf("UPDATE comunidade SET nome = '%s', logo='%s', dataedicao = '%s' WHERE id = %d",

            mysqli_real_escape_string( $this->con, $objComunidade->getNome() ),
            mysqli_real_escape_string( $this->con, $objComunidade->getLogo() ),
            mysqli_real_escape_string( $this->con, date('Y-m-d H:i:s') ),
            mysqli_real_escape_string( $this->con, $objComunidade->getId() ) );
        if(!mysqli_query($this->con, $this->query)){
            die('[ERRO]: '.mysqli_error($this->con));
        }
        return $this->objComunidade = $objComunidade;
    }

    function deletar(Comunidade $objComunidade){
        $this->query = sprintf("DELETE FROM comunidade WHERE id = %d",
            mysqli_real_escape_string( $this->con, $objComunidade->getId() ) );
        if(!mysqli_query($this->con, $this->query)){
            die('[ERRO]: '.mysqli_error($this->con));
        }
        return $this->objComunidade = $objComunidade;
    }

    function buscarTodos(){
        $this->query = sprintf("SELECT * FROM comunidade");

        $result = mysqli_query($this->con, $this->query);
        if(!$result){
            die('[ERRO]: '.mysqli_error($this->con));
        }
        while($row = mysqli_fetch_object($result)){

            $this->lista[] = $row;
        }

        return $this->lista;
    }

    function buscarPorId(Comunidade $objComunidade){
        $this->query = sprintf("SELECT * FROM comunidade WHERE id = %d",
            mysqli_real_escape_string( $this->con, $objComunidade->getId() ) );

        $result = mysqli_query($this->con, $this->query);
        if(!$result){
            die('[ERRO]: '.mysqli_error($this->con));
        }
        while($row = mysqli_fetch_object($result)){

            $this->objComunidade = $row;
        }

        return $this->objComunidade;
    }


}