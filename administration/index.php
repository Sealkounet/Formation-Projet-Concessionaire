<?php 
session_start();

require_once('../connexion_BDD.php');
ob_start();

$erreur='';

if(isset($_POST['connexion'])){
  $pseudo = trim(htmlentities(addslashes($_POST['pseudo'])));
  $pass = md5(trim(htmlentities(addslashes($_POST['pass']))));
    if(!empty($pseudo && !empty($pass))){

//Requête de vérification si l'utilisateur existe déjà
$sql = "SELECT * FROM users WHERE (pseudo = :login AND pass = :pass) OR (email = :login AND pass = :pass)";
$resultat = $bdd->prepare($sql);
$resultat->execute(array('login'=>$pseudo,'pass'=>$pass));
if($resultat){ //Si l'utilisateur existe déjà
      $res = $resultat->fetch();
        $_SESSION['user'] = array('pseudo'=>$res['pseudo'], 'email'=>$res['email'], 'pass'=>$res['pass'], 'role'=>$res['role']);      
        header('location:securite.php');                        
    }else{
        $erreur =  '<div class="alert alert-danger">
                    <strong>L\'identifiant ou le mot de passe ne sont pas valides.</strong>
                    </div>';
                    
    }
  }else{
    $erreur =  '<div class="alert alert-danger">
                  <strong>Veuillez remplir tous les champs.</strong>
                  </div>';
  }
}
?>
<!--------------------------FORMULAIRE------------------------>
<div class="col-6 offset-3">
<div class="card ">
  <ul class="list-group list-group-flush">
    <li class="list-group-item text-center"><h1 class='h2'>Connexion</h1></li>
    <form class='' action="" method="POST">
    <li class="list-group-item">
      
          <div class="form-group text-center">
              <label for="pseudo">Entrez votre pseudo ou votre adresse mail</label>
              <input type="text" class="form-control text-center" id="pseudo" name='pseudo'>
          </div>
        <div class="form-group text-center">
          <label for="pass">Entrez votre mot de passe</label>
          <input type="password" class="form-control text-center" id="pass" name='pass'>
        </div>
    </li>
    <li class="list-group-item">
      <div class='text-center mb-2'>
        <button type="submit" class="btn btn-primary" name='connexion'>Connectez vous <i class="fas fa-check"></i></button>
      </div>
      <?php if(isset($_SESSION['user'])){ ?>
      <!-- <div class='text-center'>
       <a href='inscription.php' class="btn btn-primary" >Pas encore inscrit ? Inscrivez-vous ! <i class="fas fa-arrow-right"></i></a>
      </div> -->
      <?php } ?>
    </li>
  </ul>
</div>
</div>
</form>


<?php
$contenu = ob_get_clean();
require_once('template.php');

?>