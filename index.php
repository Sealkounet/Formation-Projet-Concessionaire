<?php
require_once('connexion_BDD.php');
require_once('administration/autoLoad.php');
$search = "";

$driver = new Driver($bdd);
$dataCat = $driver->listeCategories($search);
$dataV = $driver->listeVehicules($search);
ob_start();
?>

    <?php 
    foreach($dataCat as $valueCat){ 
    ?>
    
    <h1 class='text-center bg-secondary text-white'><b><?= $valueCat->getNomCat(); ?></b></h1>
    
    <div class='row'>
    <?php 
        foreach($dataV as $valueV){
            if($valueCat->getNomCat() === $valueV->getIdCat()){
                ?>
        <div class="card mb-3 col-4 offset-1" >
            <img class="card-img-top" height="250px" src="images/<?= $valueV->getImage(); ?>"  alt="Card image cap">
            <?php if($valueV->getStatus() === '1'){ ?>
                <span class="badge badge-success mt-3"><h5>Disponible !</h5></span>
            <?php }else{ ?>
                <span class="badge badge-danger mt-3"><h5>Indisponible !</h5></span>      
            <?php } ?>
            <div class="card-body text-center">
                <h5 class="card-title"><b><?= $valueV->getMarque(); ?> <?= $valueV->getModele(); ?></b></h5>
                <p class="card-text"><b>Pays</b> : <?= $valueV->getPays(); ?> </p>
                <p class="card-text"><b>Année</b> : <?= $valueV->getAnnee(); ?></p>
                
             
            <a 
            <?php if($valueV->getStatus() == 0){ ?>  style="pointer-events: none;" <?php } ?>
            href="stripe/index.php?id=<?= $valueV->getIdVehicule(); ?>&prix=<?= $valueV->getPrix(); ?>&modele=<?= $valueV->getModele(); ?>" class="btn btn-info col">Acheter à partir de  <div><b><?= $valueV->getPrix(); ?>€</b></div>
            </a>
            
        </div>
        </div>
    <?php }} ?>
    </div>
    <?php } ?>
<?php
$contenu = ob_get_clean();
require_once ('template.php');
?>