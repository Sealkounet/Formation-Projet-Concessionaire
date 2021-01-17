<?php 
require_once('../connexion_BDD.php');
require_once('autoLoad.php');

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = (int)trim(htmlspecialchars(addslashes($_GET['id'])));
    $status= (int)trim(htmlspecialchars(addslashes($_GET['status'])));

    $driver = new Driver($bdd);
    $vehicule = new Vehicule();

    $vehicule->setIdVehicule($id);
    
    if($status == 1){
        $status = 0;
    }else{
        $status = 1;
    }
    
    $vehicule->setStatus($status);
    $driver->switchStatus($vehicule);

    
    header('location:listVehicules.php');
    

}

?>