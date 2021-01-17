<?php
class Driver {
    private $bdd;

    public function __construct($bdd){
        $this->bdd = $bdd;
    }

    //Catégories
    public function listeCategories($search){
        if($search != ""){
            $sql = "SELECT * FROM categories WHERE nomCat LIKE :nomCat";
            $resultat = $this->bdd->prepare($sql);
            $resultat->execute(array('nomCat'=>"$search%"));
        }else{
            $sql = "SELECT * FROM categories";
            $resultat = $this->bdd->prepare($sql);
            $resultat->execute();
        }
        $rows = $resultat->fetchAll(PDO::FETCH_OBJ);
        $resultat->closeCursor();
        $donnees = [];
        $compteur = 0;
        foreach($rows as $value){
            $categorie = new Categories();
            $categorie->setIdCat($value->idCat);
            $categorie->setNomCat($value->nomCat);
            $donnees[$compteur++] = $categorie;
            
        } 
        return $donnees;
    }

    public function addCategorie(Categories $categories){
        $sql = "INSERT INTO categories(nomCat) VALUES (:nomCat)";
        $resultat = $this->bdd->prepare($sql);
        $resultat->execute(array('nomCat'=>$categories->getNomCat()));
        return $this->bdd->lastInsertId();   
    }

    public function recupNomCat($id){
        $sql = "SELECT nomCat FROM categories WHERE idCat = :idCat";
        $resultat = $this->bdd->prepare($sql);
        $resultat->execute(array('idCat'=>$id));
        $row = $resultat->fetch(PDO::FETCH_OBJ);
        return $row->nomCat;
    }


    //Véhicules
    public function listeVehicules($search){
        if($search != ""){
            $sql = "SELECT * FROM vehicules WHERE marque LIKE :marque";
            $resultat = $this->bdd->prepare($sql);
            $resultat->execute(array('marque'=>"$search%"));
        }else{
            $sql = "SELECT * FROM vehicules";
            $resultat = $this->bdd->prepare($sql);
            $resultat->execute();

        }
        $rows = $resultat->fetchAll(PDO::FETCH_OBJ);
        $data = [];
        $compteur = 0;
        foreach($rows as $value){
            $vehicule = new Vehicule();
            
            $vehicule->setIdVehicule($value->idVehicule);
            $vehicule->setMarque($value->marque);
            $vehicule->setModele($value->modele);
            $vehicule->setPays($value->pays);
            $vehicule->setPrix($value->prix);
            $vehicule->setAnnee($value->annee);
            $vehicule->setImage($value->image);
            $vehicule->setIdCat($this->recupNomCat($value->idCat));
            $vehicule->setStatus($value->status);
            $data[$compteur++] = $vehicule;
        }
        $resultat->closeCursor();
        return $data;
    }

    public function addVehicule(Vehicule $vehicule){
        $sql = "INSERT INTO vehicules(marque ,modele ,pays ,prix ,annee, image, idCat) VALUES (:marque, :modele, :pays, :prix, :annee, :image, :idCat)";
        $resultat = $this->bdd->prepare($sql);
        $tabVehicule = ['marque'=>$vehicule->getMarque(),'modele'=>$vehicule->getModele(),'pays'=>$vehicule->getPays(),'prix'=>$vehicule->getPrix(),'annee'=>$vehicule->getAnnee(), 'image'=>$vehicule->getImage(),'idCat'=>$vehicule->getIdCat()];
        $resultat->execute($tabVehicule);
        $resultat->closeCursor();
        return $this->bdd->lastInsertId();
    }

    public function deleteVehicule(Vehicule $vehicule){
        $sql = "DELETE FROM vehicules WHERE idVehicule = :idVehicule";
        $resultat = $this->bdd->prepare($sql);
        $resultat->execute(array('idVehicule'=>$vehicule->getIdVehicule()));
        $resultat->closeCursor();
        if($resultat){
            unlink('images/'.$vehicule->getImage());
            header('location:listVehicules.php');
        }else{
            echo 'Echec de suppréssion du véhicule.';
        }
    }

    public function displayUpdateVehicule($id){
        $sql = "SELECT * FROM vehicules WHERE idVehicule = :idVehicule";
        $resultat = $this->bdd->prepare($sql);
        $resultat->execute(array('idVehicule'=>$id));
        
        $row = $resultat->fetch(PDO::FETCH_OBJ);
        $vehicule = new Vehicule();
        $vehicule->setIdVehicule($row->idVehicule);
        $vehicule->setMarque($row->marque);
        $vehicule->setModele($row->modele);
        $vehicule->setPays($row->pays);
        $vehicule->setPrix($row->prix);
        $vehicule->setAnnee($row->annee);
        $vehicule->setImage($row->image);
        $vehicule->setIdCat($row->idCat);
        $vehicule->nomCat = $this->recupNomCat($row->idCat);
        $resultat->closeCursor();
        return $vehicule;

    }

    public function updateVehicule(Vehicule $vehicule){
        if($vehicule->getImage() == ""){
            $sql = "UPDATE vehicules SET marque = :marque, modele = :modele, pays = :pays, prix = :prix, annee = :annee, idCat = :idCat WHERE idVehicule = ".$vehicule->getIdVehicule();
            $tabVehicule = ['marque'=>$vehicule->getMarque(),'modele'=>$vehicule->getModele(),'pays'=>$vehicule->getPays(),'prix'=>$vehicule->getPrix(),'annee'=>$vehicule->getAnnee(),'idCat'=>$vehicule->getIdCat()];
        }else{ 
            $sql = "UPDATE vehicules SET marque = :marque, modele = :modele, pays = :pays, prix = :prix, annee = :annee, image = :image, idCat = :idCat WHERE idVehicule = ".$vehicule->getIdVehicule();
            $tabVehicule = ['marque'=>$vehicule->getMarque(),'modele'=>$vehicule->getModele(),'pays'=>$vehicule->getPays(),'prix'=>$vehicule->getPrix(),'annee'=>$vehicule->getAnnee(), 'image'=>$vehicule->getImage(),'idCat'=>$vehicule->getIdCat()];
        }
        $resultat = $this->bdd->prepare($sql);
        $resultat->execute($tabVehicule);
        if($resultat){
            header('location:listVehicules.php');  
        }else{
            echo 'Echec de suppréssion du véhicule.';
        }
    
    }

    public function switchStatus(Vehicule $vehicule){
            $sql = "UPDATE vehicules SET status = :status WHERE idVehicule =".$vehicule->getIdVehicule();
            $resultat = $this->bdd->prepare($sql);
            $resultat->execute(array('status'=>$vehicule->getStatus()));     
            
    }

   
}
