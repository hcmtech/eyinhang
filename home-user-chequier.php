<?php include 'controllers/affichageDonnees.php' ?>

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
    <title>Ma demande de chéquier</title>
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

            <li><a href="home-user-account.php"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
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
            <li class='active'><a href="home-user-chequier.php"><span class="glyphicon glyphicon-folder-close"></span> Demander mon chéquier </a></li>

        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
    
    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">
                         <div class="horizontal-header">
                <div class="container-content">
                    <h1>Ma demande de chéquier</h1>

  <div class="col-md-6">
    <!-- Card 2 : Display solde compte epargne-->
                <div class="card" >
                    <div class="card-body">
                         <h3 class="card-title">Chéquier </h3>
                                <?php
                                $row = mysqli_fetch_array($result2);

                                    if($row['demandeChequier'] == '0') 
                                    {
                                        echo "<p style='font-size: 2rem;'> Vous n'avez pas encore de chéquier </p>";
                                        echo "<br>";
                                        echo <<<MYTAG
                    <form action="home-user-chequier.php" method="post">
                    <div class="form-group">
          
                    <button type="submit" name='demandeChequier-btn' class="btn btn-primary">Soumettre demande de chéquier</button>         
                    </form>
MYTAG;
                               

                                        

                                    
                                    }
                                    else {
                                        if($row['envoiChequier'] == '1') 
                                        {
                                        echo "<p style='font-size: 2rem;'> Statut : Chéquier envoyé ! </p>";
                                        echo "<p style='font-size: 2rem;'> Date d'envoi : ". $row['dateEnvoiChequier'] ." </p>";

                                        }else{
 
                                          echo "<br>";
                                          echo "<p style='font-size: 2rem;'> Vous avez déjà fait votre demande de chéquier </p>";
                                          echo "<p style='font-size: 2rem;'> Demande réalisée le " . $row['dateDemandeChequier'] . "</p>";
                                          echo "<p style='font-size: 1.5rem;'>Statut : En attente de validation</p>";
                                        }
                                    }
                                    //echo "<p>" . $row['username'] . "</p>";
                                   // if ($row['typeCompteID'] === '1') {
                                   // echo "<p>" . $row['typeCompteID'] . "</p>";
                                   // }
                                    //else {
                                     //   echo "Pas de compte épargne"
                                   // }
                                    //echo "<p>" . $row['autorisationDecouvert'] . "</p>";
                                
                                mysqli_close($conn);
                                ?>  
                        <br>
                    </div>
                </div>
  </div>
           

         </div>

         
        </div>
    </div>

</body>
</html>
<?php } ?>
