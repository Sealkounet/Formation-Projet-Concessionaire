<?php
session_start();
require_once ('../connexion_BDD.php');
require_once ('autoLoad.php');

$driver = new Driver($bdd);
$search = "";
if(isset($_POST['search'])){
    $search = trim(htmlspecialchars(addslashes($_POST['search'])));
}
$data = $driver->listeCategories($search);



ob_start();
?>
<h2 class="text-center">Listes des Catégories</h2>
<form action="" method='POST'>
<div class="input-group mb-2 justify-content-end">
        <input class="form-control col-4 text-center" type="search" id="search" placeholder="Rechercher une Catégorie par nom" name='search'>
        <div class="input-group-append">
            <button class="input-group-text bg-success border-success" type='submit'><i class="fas fa-search text-white"></i></button>  
        </div>
    </div>
</form>
<table class="table table-bordered table-striped  text-center">
<thead class="thead-dark">
    <tr>
    <th>N°</th>
    <th>Catégorie</th>
    </tr>
</thead>
<tbody>
    <?php
        foreach($data as $value){
    ?>
    <tr>
        <td><?= $value->getIdCat(); ?></td>
        <td><?= $value->getNomCat(); ?></td>
    </tr>
    <?php
        }
    ?>
</tbody>
</table>

<?php 
$contenu = ob_get_clean();
require_once ('template.php');
?>