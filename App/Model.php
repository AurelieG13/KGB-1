<?php

abstract class Model
{
    //info BDD
    private $host = "localhost";
    private $db_name = "kgb-1";
    private $username = "root";
    private $password = "";

    //info connexion
    protected $_connexion;

    // prop contenant les infos de requetes
    public $table;
    public $id;

    //fonction pour se connecter
    public function getConnection(){
        $this->_connexion = null;
        try {
            $this->_connexion = new PDO('mysql:host='.$this->host . ';dbname='.$this->db_name, $this->username, $this->password);
            $this->_connexion->exec('set names utf8');
        } catch (PDOException $e) {
            echo 'Erreur : '.$e->getMessage();
        }
    }

    public function getAll()
    {
        $sql = " SELECT * FROM ".$this->table;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getOne()
    {
        $sql = " SELECT * FROM ".$this->table." WHERE id=" .$this->id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
}