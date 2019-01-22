<?php include 'controllers/affichageDonnees-admin.php' ?>

<!DOCTYPE html>
<html lang="fr">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Gérer les bénéficiaires</title>
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
                <h3> Bonjour <?php echo $_SESSION['login']?> ! </h3>
                <img src="img/icon-person.png" alt=""> 
                <a href="logout-admin.php"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</a>
            </div>


    <!-- Main Menu -->
    <div class="side-menu-container">
        <ul class="nav navbar-nav">

            <li><a href="home-admin-list-users.php"><span class="glyphicon glyphicon-user"></span> Gérer les utilisateurs</a></li>
            <li><a href="home-admin-gestion-comptes.php"><span class="glyphicon glyphicon-list-alt"></span> Gérer les comptes</a></li>
            <li><a href="home-admin-gestion-découvert.php"><span class="glyphicon glyphicon-euro"></span> Autorisation découvert</a></li>
            <li class="active"><a href="home-admin-gestion-beneficiaire.php"><span class="glyphicon glyphicon-check"></span> Valider les bénéficiaires</a></li>
            <li><a href="home-admin-gestion-chéquier.php"><span class="glyphicon glyphicon-folder-close"></span>Envoi de chéquier</a></li>

        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
    
    </div>

  <div class="container-fluid">
            <div class="side-body">
                <div class="horizontal-header">
                    <div class="container-content">
                    <h1>Valider les demandes de bénéficiaires</h1>
                    </div>

                <br>
  
            <div class="container-content">


       <!-- Liste des bénéficiaires en attente de validation -->
  <?php 
    $total=mysqli_num_rows($result5); // va retourner le nombre de ligne
    if (($total) == NULL){ 
        echo "<p style='font-size: 2.5rem; font-weight:bold; color:#169c81'>Vous n'avez aucune demande de bénéficiaires à valider.</p>";
    } else { // si il y a des opérations alors on affiche =
    printf("<p style='font-size: 2rem; font-weight:bold; color:#169c81'>Vous avez ".$total." demande(s) à valider</p>"); 
    echo <<<MYTAG
            <h1>Liste de vos bénéficiaires en attente de validation</h1>
            <table class="table table-striped">
                <thead>
                    <tr class="tableactivite">
                        <th scope="col">
                        Identité du bénéficiaire
                        </th>
                        <th scope="col">
                        IBAN ajouté
                        </th> 
                        <th scope="col">
                        Date de la demande
                        </th>    
                        <th scope="col">
                        
                        </th>    
                    </tr>
                </thead>
            <tbody>
MYTAG;

    while($row = mysqli_fetch_array($result5))
    {
    echo "<tr>";
    echo '<td>'. $row['username'] . ' '.$row['userprenom'] . '</td>'; 
    echo "<td>" . $row['Rib'] . "</td>";
    echo "<td>" . $row['dateAjoutBeneficiaire'] .'</td>';
    echo '<td> <form action="home-admin-gestion-beneficiaire.php" method="post">
 <input type="checkbox" name="identityUser[]" value='.$row['estBeneficiaireID'].' >
</td>';
    echo "</tr>";
    }

    echo "</table>";
    mysqli_close($conn);
        };
     ?>

           </div>
<?php 

    $total=mysqli_num_rows($result5);
    if (($total) > 0){ 
        echo <<<MYTAG
            <div class="form-group">
                <button type="submit" name="validerBeneficiaire-btn" class="btn btn-primary col-md-4 pull-right"> Valider</button>
            </div>
        </form>
MYTAG;

    };
    // Connection close  
    mysqli_close($conn); 

 ?>

         
        </div>
    </div>

</body>
</html>


