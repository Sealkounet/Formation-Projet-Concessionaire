<?php

class Categories {
    private $idCat;
    private $nomCat;
 
    public function getIdCat(){
        return $this->idCat;
    }
    public function getNomCat(){
        return $this->nomCat;
    }

    public function setIdCat($idCat){
        $this->idCat = $idCat;
    }
    public function setNomCat($nomCat){
        $this->nomCat = $nomCat;
    }
}