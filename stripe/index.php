<?php
    require_once('../connexion_BDD.php');
    ob_start();
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = (int)trim(htmlspecialchars(addslashes($_GET['id'])));
        $prix = (int)trim(htmlspecialchars(addslashes($_GET['prix'])));
        $modele = trim(htmlspecialchars(addslashes($_GET['modele'])));
    }
?>
<div class="row">

<div class="card col-6 offset-3 text-center" style="width: 18rem;">
    <ul class="list-group list-group-flush">
      <div class="card-body">
        <h4 class="card-title">Récapitulatif de votre commande </h4>
      </div>
    <li class="list-group-item">Modèle du véhicule : <b><?= $modele ?></b></li>
    <li class="list-group-item">Prix du véhicule : <b><?= $prix ?> €</b></li>
  </ul>
  <div class="card-body">
  <form action="./paiement.php" method="POST">
  <input type="hidden" value="<?= $id ?>" name='id'>
  <input type="hidden" value="<?= $prix ?>" name='prix'>
        <script
            src="https://checkout.stripe.com/checkout.js"
            class="stripe-button"
            data-key="pk_test_FdfrPkiQ3WgprJDsXZb5cXGl00Q9MpzBQY"
            data-name="Concessionnaire"
            data-description="Achat et Ventes de véhicules"
            data-image=""
            data-amount="<?= $prix ?>00"
            data-locale="auto"
            data-currency="eur">
        </script>
    </form>
  </div>
</div>
</div>

</div>
<?php

$contenu = ob_get_clean();
require_once('../template.php')

?>