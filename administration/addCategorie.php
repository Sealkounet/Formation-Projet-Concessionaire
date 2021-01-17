<?php 
require_once ('class/Auth.class.php');
require_once ('../connexion_BDD.php');
require_once ('autoLoad.php');

$erreur = "";
ob_start();
if(isset($_POST['add']) && isset($_POST['categorie']) && strlen($_POST['categorie']) >=4){
    $recup_categorie = trim(htmlspecialchars(addslashes($_POST['categorie'])));

    $categorie = new Categories();
    $driver = new Driver($bdd);
    $categorie->setNomCat($recup_categorie);
    $result = $driver->addCategorie($categorie);

    if($result != 0){
        header('location:listCategories.php');
    }else{
        $erreur =  '<div class="alert alert-danger">
                    <strong>Erreur lors de la création de la catégorie.</strong>
                    </div>';
    }

}
?>
<h2 class="text-center">Formulaire de création d'une catégorie</h2>
<br>
<form method="POST">
  <div class="form-group text-center col-6 offset-3">
    <label for="categorie">Veuillez entrer le nom de la catégorie à créer :</label>
    <input type="text" class="form-control text-center" id="categorie" name='categorie' placeholder="Nom de la catégorie" >
    
  </div>
  <div class='text-center'>
  <button type="submit" class="btn btn-primary" name="add"><i class='fas fa-plus'></i>Créer</button>
  </div>
</form>
<div><?= $erreur; ?></div>
<?php
$contenu = ob_get_clean();
require_once('template.php');
?>