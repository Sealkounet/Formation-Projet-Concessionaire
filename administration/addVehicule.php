<?php 
require_once ('class/Auth.class.php');
require_once ('../connexion_BDD.php');
require_once ('autoLoad.php');
$erreur = "";

$driver = new Driver($bdd);
$search = "";
$data = $driver->listeCategories($search);

ob_start();

if(isset($_POST['add']) && isset($_POST['marque']) && !empty($_POST['modele'])){
    $marque = trim(htmlspecialchars(addslashes($_POST['marque'])));
    $modele = trim(htmlspecialchars(addslashes($_POST['modele'])));
    $pays = trim(htmlspecialchars(addslashes($_POST['pays'])));
    $prix = intval(trim(htmlspecialchars(addslashes($_POST['prix']))));
    $annee = (int)trim(htmlspecialchars(addslashes($_POST['annee'])));
    $categorie = (int)trim(htmlspecialchars(addslashes($_POST['categorie'])));
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$image);
    
    $vehicule = new Vehicule();
    $driver = new Driver($bdd);
    
    $vehicule->setMarque($marque);
    $vehicule->setModele($modele);
    $vehicule->setPays($pays);
    $vehicule->setPrix($prix);
    $vehicule->setAnnee($annee);
    $vehicule->setIdCat($categorie);
    $vehicule->setImage($image);
    
    $resultat = $driver->addVehicule($vehicule);
    
    if($resultat != 0){
      header('location:listVehicules.php');
  }else{
      $erreur =  '<div class="alert alert-danger text-center">
                  <strong>Erreur lors de l\'insertion du véhicule.</strong>
                  </div>';
  }
}

?>
<h2 class="text-center">Formulaire d'ajout d'un véhicule</h2>
<br>
<form method="POST" enctype="multipart/form-data">
<div class='text-center row mb-5'>
  <div class="form-group col-6  ">
    <label for="marque">Veuillez entrer la marque du véhicule :</label>
    <input type="text" class="form-control text-center" id="marque" name='marque' placeholder="Marque" >   
  </div>
  <div class="form-group col-6  ">
    <label for="modele">Veuillez entrer le modèle du véhicule :</label>
    <input type="text" class="form-control text-center" id="model" name='modele' placeholder="Modèle" >   
  </div>
</div>
<div class='text-center row mb-5'>
  <div class="form-group col-6  ">
    <label for="pays">Veuillez entrer le pays d'origine du véhicule :</label>
    <input type="text" class="form-control text-center" id="pays" name='pays' placeholder="Pays d'origine" >   
  </div>
  <div class="form-group col-6  ">
    <label for="prix">Veuillez entrer le prix du véhicule :</label>
    <input type="number" class="form-control text-center" id="prix" name='prix' placeholder="Prix" >   
  </div>
</div>
<div class='text-center row mb-5'>
  <div class="form-group col-6  ">
    <label for="annee">Veuillez entrer l'année de sortie du véhicule :</label>
    <input type="text" class="form-control text-center" id="annee" name='annee' placeholder="Année de sortie" >   
  </div>
  <div class="form-group col-6">
    <label for="categorie">Veuillez choisir la catégorie du véhicule</label>
    <select class="form-control text-center" id="categorie" name='categorie'>
      <option value='' hidden>Choix de la catégorie</option>
      <?php foreach($data as $value){ ?>
        <option value="<?= $value->getIdCat(); ?>"><?= $value->getNomCat(); ?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="form-group col-6 offset-3 text-center mb-5 ">
    <label for="image">Veuillez séléctionner l'image du véhicule :</label>
    <input type="file" class="form-control-file border text-center" id="image" name='image'>   
  </div>
  <div class='text-center'>
  <button type="submit" class="btn btn-primary" name="add"><i class='fas fa-plus'></i> Ajouter un véhicule</button>
  </div>
</form>
<div><?= $erreur; ?></div>

<?php
$contenu = ob_get_clean();
require_once('template.php');
?>