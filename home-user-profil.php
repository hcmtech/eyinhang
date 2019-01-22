<?php include 'controllers/ModifierInfosPersonnelles.php' ?>
<?php 
    if(empty($_SESSION['UserID'])) {
        header('location: login.php');
    }else {
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Document</title>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="css/home-user-account.css">
     <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  </head>

<body>

  <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function () {

    $(function () {

    $('.btn-primary1').click(function() {
        $('.form-control').removeAttr("readonly");
        $('#save').removeAttr("disabled");
        $('#cancel').removeAttr("disabled");
        
    });

    $('#cancel').click(function() {
        $('.form-control').attr('readonly', true);
        $('#save').attr('disabled', true);
        $('#cancel').attr('disabled', true);
        
    });
});

});
</script>

<div class="row">
    <div class="side-menu">    
    <nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <div class="brand-wrapper">
            <div class="brand-name-wrapper">
                <h3> Bonjour <?php echo $_SESSION['userprenom']." ".$_SESSION['username']; ?> ! </h3>
                <img src="img/icon-person.png" alt="">  
                <a href="home-user-profil.php">Mon profil</a>
                <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</a>
            </div>


    <!-- Main Menu -->
    <div class="side-menu-container">
        <ul class="nav navbar-nav">

            <li class="active"><a href="home-user-account.php"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
                        <!-- Dropdown-->
            <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl1">
                    <span class="glyphicon glyphicon-piggy-bank"></span> Gérer mes comptes <span class="caret"></span>
                </a>

                <!-- Dropdown level 1 -->
                <div id="dropdown-lvl1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
                            <li><a href="home-user-comptes.php">Mon compte courant</a></li>
                            <li><a href="home-user-comptes-epargne.php">Mon compte épargne</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li><a href="home-user-virement.php"><span class="glyphicon glyphicon-share"></span> Faire un nouveau virement</a></li>
            <li><a href="home-user-beneficiaire.php"><span class="glyphicon glyphicon-user"></span> Vos bénéficiaires</a></li>
            <li><a href="home-user-chequier.php"><span class="glyphicon glyphicon-folder-close"></span> Demander mon chéquier </a></li>

        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
    
    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">
             <div class="horizontal-header">
                  <button type="button" class="btn btn-primary1 pull-right" data-toggle="modal" data-target="#exampleModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Modifier
            </button>
                <div class="container-content">
                    <h1>Mes infos personnelles</h1>
                </div>
       <br>
      <form action="home-user-profil.php" method="post">


          <div class="form-group col-md-6">
            <label for="nom"> Nom:</label>
            <input type="text" name="username" readonly="readonly" class="form-control mb-2 mr-sm-2" class="form-control" value ="<?php echo $_SESSION['username']; ?>">
          </div>
          <div class="form-group col-md-6">
            <label for="prenom"> Prénom:</label>
            <input type="text" name="userprenom" readonly="readonly" class="form-control mb-2 mr-sm-2" class="form-control" value ="<?php echo $_SESSION['userprenom']; ?>">
          </div>
          <div class="form-group col-md-6">
            <label for="adresse"> Adresse:</label>
            <input type="text" name="adresse" readonly="readonly" class="form-control mb-2 mr-sm-2" class="form-control" value ="<?php echo $_SESSION['adresse']; ?>">
          </div>
        <div class="form-group col-md-3">
            <label for="codePostale"> Code Postale:</label>
            <input type="integer" = name="codepostale" readonly="readonly" class="form-control mb-2 mr-sm-2" class="form-control" value ="<?php echo $_SESSION['codepostale']; ?>">
          </div>
                    <div class="form-group col-md-3">
            <label for="ville"> Ville:</label>
            <input type="text" name="ville" readonly="readonly" class="form-control mb-2 mr-sm-2" class="form-control" value ="<?php echo $_SESSION['ville']; ?>">
          </div>
          <div class="form-group col-md-6">
            <label for="numeroTel"> Numéro de téléphone:</label>
            <input type="integer" name="numerotel" readonly="readonly" class="form-control mb-2 mr-sm-2" class="form-control" value ="<?php echo $_SESSION['numerotel']; ?>">
          </div>
          <div class="form-group col-md-6">
            <label for="email"> Adresse mail:</label>
            <input type="email" name="email" readonly="readonly" class="form-control mb-2 mr-sm-2" class="form-control" value ="<?php echo $_SESSION['email']; ?>">
          </div>
          <div class="form-group col-md-6">
            <label for="pwd">Mot de passe:</label>
            <input type="password" name="password" readonly="readonly" class="form-control">
          </div>
          <div class="form-group col-md-6">
            <label for="pwd">Confirmer le mot de passe:</label>
            <input type="password" name="passwordConf" readonly="readonly" class="form-control">
          </div>

          <button type="submit" id="save" name="modify-btn" class="btn btn-primary col-md-4 pull-right" disabled>Sauvegarder</button>

          <button type="submit" id="cancel" class="btn btn-primary pull-right" disabled>Annuler</button>


        </form>
        </div>

           
        </div>
      </div>
    </div>

</body>
</html>
<?php } ?>
