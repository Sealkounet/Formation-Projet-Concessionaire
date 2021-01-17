<?php

class Vehicule{
    private $idVehicule;
    private $marque;
    private $modele;
    private $pays;
    private $prix;
    private $annee;
    private $image;
    private $IdCat;
    private $status;

    public function getIdVehicule(){
        return $this->idVehicule;
    }
    public function getMarque()
    {
        return $this->marque;
    }
    public function getModele()
    {
        return $this->modele;
    }
    public function getPays()
    {
        return $this->pays;
    }
    public function getPrix()
    {
        return $this->prix;
    }
    public function getAnnee()
    {
        return $this->annee;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getIdCat()
    {
        return $this->IdCat;
    }


    public function setIdVehicule($idVehicule)
    {
        $this->idVehicule = $idVehicule;

        return $this;
    }
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
    public function setIdCat($IdCat)
    {
        $this->IdCat = $IdCat;

        return $this;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }
}