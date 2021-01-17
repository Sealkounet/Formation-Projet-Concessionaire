<?php 
require_once('vendor/autoload.php');
require_once('../connexion_BDD.php');
require_once('../administration/autoLoad.php');

if(isset($_POST["stripeToken"]) && !empty($_POST["stripeToken"])){
    $prix = (int)trim(htmlspecialchars(addslashes($_POST['prix'])));
    $token = $_POST["stripeToken"];
    $id = (int)trim(htmlspecialchars(addslashes($_POST['id'])));
    \Stripe\Stripe::setApiKey("sk_test_tUd8SJ5jN1RoynzJ8DMfazVF00dte0eNO6");
    $charge = \Stripe\Charge::create([
        'amount'=> $prix.'00',
        'currency'=>'eur',
        'description'=> 'Achat et Vente de vehicules.',
        'source'=> $token
    ]);
}



if($charge){
    $driver  = new Driver($bdd);
    $vehicule = new Vehicule();
    
    $vehicule->setIdVehicule($id);
    $vehicule->setStatus(0);

    $driver->switchStatus($vehicule);
    
    header('location:../index.php');
}else{
    echo 'Erreur lors du paiement...';
}