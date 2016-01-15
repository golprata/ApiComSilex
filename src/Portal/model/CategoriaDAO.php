<?php

namespace Portal\model;

class CategoriaDAO
{
    private $con;
    private $query;
    private $objCategoria;
    private $lista;

    /**
     * CategoriaDAO constructor.
     */
    public function __construct($con)
    {
        $this->con = $con;
    }

    public function cadastrar(Categoria $objCategoria)
    {
        $this->query = sprintf("INSERT INTO categoria (nome) VALUES ('%s')",
            mysqli_real_escape_string( $this->con, $objCategoria->getNome() ) );

        if(!mysqli_query($this->con, $this->query)){
            die('[ERRO] Cadastro: '.mysqli_error($this->con));
        }

        /*-- Pegando ultimo obj cadastrado --*/
        return mysqli_insert_id ( $this->con );
    }

    function atualizar(Categoria $objCategoria){
        $this->query = sprintf("UPDATE categoria SET nome = '%s', dataedicao = '%s' WHERE id = %d",

            mysqli_real_escape_string( $this->con, $objCategoria->getNome() ),
            mysqli_real_escape_string( $this->con, date('Y-m-d H:m:i') ),
            mysqli_real_escape_string( $this->con, $objCategoria->getId() ) );
        if(!mysqli_query($this->con, $this->query)){
            die('[ERRO]: '.mysqli_error($this->con));
        }
        return $this->objCategoria = $objCategoria;
    }

    function deletar(Categoria $objCategoria){
        $this->query = sprintf("DELETE FROM categoria WHERE id = %d",
            mysqli_real_escape_string( $this->con, $objCategoria->getId() ) );
        if(!mysqli_query($this->con, $this->query)){
            die('[ERRO]: '.mysqli_error($this->con));
        }
        return $this->objCategoria = $objCategoria;
    }

    function buscarCategorias(){
        $this->query = sprintf("SELECT * FROM categoria");

        $result = mysqli_query($this->con, $this->query);
        if(!$result){
            die('[ERRO]: '.mysqli_error($this->con));
        }
        while($row = mysqli_fetch_object($result)){

            $this->lista[] = $row;
        }

        return $this->lista;
    }

    function buscarPorId(Categoria $objCategoria){
        $this->query = sprintf("SELECT * FROM categoria WHERE id = %d",
            mysqli_real_escape_string( $this->con, $objCategoria->getId() ) );

        $result = mysqli_query($this->con, $this->query);
        if(!$result){
            die('[ERRO]: '.mysqli_error($this->con));
        }
        while($row = mysqli_fetch_object($result)){

            $this->objCategoria = $row;
        }

        return $this->objCategoria;
    }


}