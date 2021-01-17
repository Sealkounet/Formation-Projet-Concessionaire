<?php
require_once ('class/Auth.class.php');
require_once('../connexion_BDD.php'); //Connexion à la BDD
ob_start();
$erreur='';
if(isset($_POST['register'])){ //Lorsque l'on soumet le formulaire
  
  //////////////////////////Récupération des différents champs////////////////////////
$pseudo = trim(htmlentities(addslashes($_POST['pseudo'])));
$nom = trim(htmlentities(addslashes($_POST['nom'])));
$prenom = trim(htmlentities(addslashes($_POST['prenom'])));
$email = trim(htmlentities(addslashes($_POST['mail'])));
$pass = md5(trim(htmlentities(addslashes($_POST['pass']))));

//Requête de vérification si le mail existe déjà
$verif_email = "SELECT * FROM users WHERE email = :email OR pseudo = :pseudo";
$res = $bdd->prepare($verif_email);
$res->execute(array('email'=>$email,'pseudo'=>$pseudo));
$email = $res->fetch();
if(!empty($pseudo)  ){//Vérification du remplissage des champs
  if($_POST['pass'] == $_POST['verif_pass']){ //Véfification que les mdp correspondent
    if($email){ //Si l'email existe déjà
      $erreur =  '<div class="alert alert-danger">
      <strong>Un compte avec cette adresse email existe déjà. Si il s\'agit du votre, vous pouvez vous connectez via <a href="connexion.php">la page de connexion.</a> sinon veuillez entrer une autre adresse email.</strong>
      </div>';
    }else{
      if(strlen($pseudo) >=4){ //Condition pour que le pseudo ai 4 caractères minimum
              //Requête d'insertion dans la BDD
              $sql = "INSERT INTO users (pseudo,nom,prenom,email,pass) VALUES (:pseudo,:nom,:prenom,:email,:pass)";
              $resultat = $bdd->prepare($sql);
              $resultat->execute(array('pseudo'=>$pseudo,'nom'=>$nom,'prenom'=>$prenom,'email'=>$email,'pass'=>$pass));
              $erreur =  '<div class="alert alert-success">
              <strong>Votre compte a bien été crée.</strong>
              </div>';           
          }else{//Erreur de longueur du pseudo
            $erreur = '<div class="alert alert-danger">
             <strong>Votre pseudonyme doit contenir au moins 4caractères.</strong>
            </div>';
          }
          
        }
     }else{
        
        //Erreur des mots de passes qui ne correspondent pas
      $erreur = '<div class="alert alert-danger">
             <strong>Les mots de passe ne correspondent pas.</strong>
            </div>';
    } 
  }else{
    //Au moins un champ est vide
    $erreur = '<div class="alert alert-danger">
               <strong>Veuillez remplir tous les champs.</strong>
              </div>';
  }
}

?>
<!----------------------------------------FORMULAIRE-------------------------------------->
<div class='col-6 offset-3'>
<div class="card">
  <ul class="list-group list-group-flush">
    <li class="list-group-item text-center"><h1 class='h2'>Création de compte</h1></li>
    <li class="list-group-item">
        <form class='' action='' method='post'>
        <div class="form-group text-center">
            <label for="nom">Entrez le nom*</label>
            <input type="text" class="form-control text-center" id="nom" name='nom'>
        </div>
        <div class="form-group text-center">
            <label for="prenom">Entrez le prénom*</label>
            <input type="text" class="form-control text-center" id="prenom" name='prenom'>
        </div>
        <div class="form-group text-center">
            <label for="mail">Entrez l'email*</label>
            <input type="email" class="form-control text-center" id="mail" name='mail'>
        </div>
        <div class="form-group text-center">
            <label for="pseudo">Choisissez un pseudo*</label>
            <input type="text" class="form-control text-center" id="pseudo" name='pseudo'>
        </div>
      <div class="form-group text-center">
        <label for="pass">Choisissez un mot de passe*</label>
        <input type="password" class="form-control text-center" id="pass" name='pass'>
      </div>
      <div class="form-group text-center">
        <label for="verif_pass">Confirmez le mot de passe*</label>
        <input type="password" class="form-control text-center" id="verif_pass" name='verif_pass'>
      </div>
    </li>
    <li class="list-group-item">
      <div class='text-center mb-2'>
       <button type="submit" class="btn btn-primary" name='register'>Créez un compte <i class="fas fa-check"></i></button>
      </div>
      <!-- <div class='text-center '>
        <a href='connexion.php' class="btn btn-primary" name=''>Déjà un compte ? Connectez vous ! <i class="fas fa-arrow-right"></i></a>
      </div> -->
    </li>
  </ul>
</div>
</div>

  

</form>
<div class='col-6 offset-3 text-center'><?= $erreur ?></div> 
<?php 
$contenu = ob_get_clean();
require_once('template.php'); 
?>

