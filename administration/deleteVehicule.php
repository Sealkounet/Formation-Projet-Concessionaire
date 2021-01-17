<?php
require_once ('class/Auth.class.php');
require_once('../connexion_BDD.php');
require_once('autoLoad.php');
if(isset($_GET['id']) && isset($_GET['img'])){

    $id = intval(trim(htmlspecialchars(addslashes($_GET['id']))));
    $img = trim(htmlspecialchars(addslashes($_GET['img'])));

    $vehicule = new Vehicule();
    $driver = new Driver($bdd);

    $vehicule->setIdVehicule($id);
    $vehicule->setImage($img);

    $driver->deleteVehicule($vehicule);

    
}