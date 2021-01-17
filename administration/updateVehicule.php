<?php 
require_once ('class/Auth.class.php');
ob_start();
require_once ('../connexion_BDD.php');
require_once ('autoLoad.php');

$erreur = "";

$search = "";
if(isset($_GET['id'])){
    $id = intval(trim(htmlspecialchars(addslashes($_GET['id']))));

    $driver = new Driver($bdd);
    $data = $driver->displayUpdateVehicule($id);
    $dataCat = $driver->listeCategories($search);    

}
if(isset($_POST['update']) && isset($_POST['marque']) && !empty($_POST['modele'])){
    $idVehicule = intval(trim(htmlspecialchars(addslashes($_POST['idVehicule']))));
    $marque = trim(htmlspecialchars(addslashes($_POST['marque'])));
    $modele = trim(htmlspecialchars(addslashes($_POST['modele'])));
    $pays = trim(htmlspecialchars(addslashes($_POST['pays'])));
    $prix = intval(trim(htmlspecialchars(addslashes($_POST['prix']))));
    $annee = (int)trim(htmlspecialchars(addslashes($_POST['annee'])));
    $categorie = (int)trim(htmlspecialchars(addslashes($_POST['categorie'])));
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], '../images/'.$image);
    
    $vehicule = new Vehicule();
    
    $vehicule->setIdVehicule($idVehicule);
    $vehicule->setMarque($marque);
    $vehicule->setModele($modele);
    $vehicule->setPays($pays);
    $vehicule->setPrix($prix);
    $vehicule->setAnnee($annee);
    $vehicule->setIdCat($categorie);
    $vehicule->setImage($image);

    $driver->updateVehicule($vehicule);
}

?>
<h2 class="text-center">Formulaire d'edition du véhicule</h2>
<br>
<form method="POST" enctype="multipart/form-data">
<input name='idVehicule' hidden  type='text' class='form-control text-center'  value='<?= $data->getIdVehicule(); ?>'>
<div class='text-center row mb-5'>
  <div class="form-group col-6  ">
    <label for="marque">Marque du véhicule :</label>
    <input type="text" class="form-control text-center" id="marque" name='marque' value='<?= $data->getMarque(); ?>'   >   
  </div>
  <div class="form-group col-6  ">
    <label for="modele">Modèle du véhicule :</label>
    <input type="text" class="form-control text-center" id="model" name='modele' value='<?= $data->getModele(); ?>'  >   
  </div>
</div>
<div class='text-center row mb-5'>
  <div class="form-group col-6  ">
    <label for="pays">Pays d'origine du véhicule :</label>
    <input type="text" class="form-control text-center" id="pays" name='pays' value='<?= $data->getPays(); ?>'  >   
  </div>
  <div class="form-group col-6  ">
    <label for="prix">Prix du véhicule :</label>
    <input type="number" class="form-control text-center" id="prix" name='prix' value='<?= $data->getPrix(); ?>'  >   
  </div>
</div>
<div class='text-center row mb-5'>
  <div class="form-group col-6  ">
    <label for="annee">Année de sortie du véhicule :</label>
    <input type="text" class="form-control text-center" id="annee" name='annee' value='<?= $data->getAnnee(); ?>'  >   
  </div>
  <div class="form-group col-6">
    <label for="categorie">Catégorie du véhicule : </label>
    <select class="form-control text-center" id="categorie" name='categorie'>
      <option  value='<?= $data->getIdCat(); ?>'><?= $data->nomCat; ?></option>
      <?php foreach($dataCat as $value){ ?>
        <option value="<?= $value->getIdCat(); ?>"><?= $value->getNomCat(); ?></option>
      <?php } ?>
    </select>
  </div>
</div>
<div class="row">
<div class="form-group col-6 text-center mb-5 mt-5 ">
    <label for="image">Image du véhicule :</label>
    <input type="file" class="form-control-file border text-center" id="image" name='image'>   
  </div>
<div class="form-group col-6  text-center mb-5 ">
        <img src="../images/<?= $data->getImage(); ?>" width="300px" alt="">
  </div>
  </div>
  <div class='text-center'>
  <button type="submit" class="btn btn-info" name="update"><i class='fas fa-pen'></i> Editer le véhicule</button>
  </div>
</form>
<div><?= $erreur; ?></div>

<?php
$contenu = ob_get_clean();
require_once('template.php');
?>