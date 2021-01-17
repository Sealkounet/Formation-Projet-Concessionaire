<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Accueil</title>
  </head>
  <body>
<header>
  <div class="jumbotron jumbotron-fluid bg-dark text-white">
  <div class="container">
    <h1 class="display-4 text-center">Vente de véhicule</h1>
    <p class="lead text-center">Nous ferons de votre rêve, une réalité !</p>
  </div>
  <ul class="nav justify-content-end bg-dark fixed-top">
    <li class="nav-item">
      <a class="nav-link active text-white" href="#">Accueil</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#">Link</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#">Link</a>
    </li>
  </ul>
</div>
</header>

<div class='container'>
    <?= $contenu; ?></div>
</div>

<div style='margin-top:150px'></div>
<footer class='text-white fixed-bottom mt-5'>
<nav class="navbar-expand-sm bg-dark navbar-dark ">
<div class="row align-items-center">
    <div class="col-2 offset-1">
        <h3>Liens utiles</h3>
        <ul>
            <li class="nav-item"><a class="text-white" href='../public/accueil.php'>Accueil</a></li>
            <li class="nav-item"><a class="text-white" href='../public/contact.php'>Contacts</a></li>
            <li class="nav-item">Mentions légales</li>
        </ul>
    </div>
    <div class="col-4 offset-1">
        <form action="" method="post">
            <input type="text" class="form-control" name="newsletters" placeholder="Inscrivez-vous aux newsletters">
            <div class='text-center'>
                <button class='btn bg-light' type="submit">Inscription</button>
            </div>
        </form>
    </div>
    <div class="col-2 offset-2">
        <p>Copyright &copy2020</p>
    </div>  
</div>
</nav>
</footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>