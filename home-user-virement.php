<?php include 'controllers/virementArgent.php';
    if(empty($_SESSION['UserID'])) {
        header('location: login.php');
    }else {
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Faire un nouveau virement</title>
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
            <li class="active"><a href="home-user-virement.php"><span class="glyphicon glyphicon-share"></span> Faire un nouveau virement</a></li>
            <li><a href="home-user-beneficiaire.php"><span class="glyphicon glyphicon-user"></span> Vos bénéficiaires</a></li>
            <li><a href="home-user-chequier.php"><span class="glyphicon glyphicon-folder-close"></span> Demander mon chéquier </a></li>

        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
    
    </div>

     <div class="container-fluid">
        <div class="side-body">
             <div class="horizontal-header">
                <button type="button" class="btn btn-primary1 pull-right" data-toggle="modal" data-target="#exampleModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Faire un virement</button>
                <div class="container-content">
                    <h1>Faire un virement</h1>
                </div>
            </div>

<div class = "container-content">

    <?php 
    $total=mysqli_num_rows($result2); // va retourner le nombre de ligne
    if (($total) == NULL){ 
        echo "<p style='font-size: 2.5rem; font-weight:bold; color:#169c81'>Aucune opération de réalisée.</p>";
    } else { // si il y a des opérations alors on affiche =
echo <<<MYTAG
            <h1>Historique des virements effectués</h1>
            <table class="table table-striped">
                <thead>
                    <tr class="tableactivite">
                        <th scope="col">
                        Compte Débiteur
                        </th>
                        <th scope="col">
                        Montant de l'opération
                        </th>
                        <th scope="col">
                        Libellé
                        </th>
                        <th scope="col">
                        Date de l'opération
                        </th>
                    </tr>
                </thead>
            <tbody>
MYTAG;


    while($row = mysqli_fetch_array($result2))
    {
    echo "<tr>";
    echo "<td>" . $row['typeCompteLibelle'] . "</td>";
    echo "<td style='color:red; font-weight:bold;''>" . "- ".$row['montant'] .' €'. "</td>";
    echo "<td>" . $row['libelleOperation'] . "</td>";
    echo "<td>" . $row['dateOperation'] .'</td>';
    echo "<td>" . $row['username'] . ' '. $row['userprenom'] .'</td>';
    echo "</tr>";
    }

    echo "</table>";
    mysqli_close($conn);
        };
     ?>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Faire un nouveau virement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="home-user-virement.php" method="POST">
             <div class="form-group">

            <div class="form-group col-md-10">
                <label for="inputState">Compte emetteur</label>
                    <select name="selectCompte" id="inputState" class="form-control">
                    <?php while ($row = mysqli_fetch_array($result3)):;?>
                    <?php echo '<option value='.$row['compteID'].'>' .$row['typeCompteLibelle']. ' - Solde : ' .$row['compteSolde']. ' € ' .'</option>';?>
                    <?php endwhile; ?>
                    </select>
            </div>

                <div class="form-group col-md-5">
                  <label for="inputEmail4">Montant</label>
                  <input type="text" name="montant" class="form-control" id="inputEmail4" placeholder="Renseignez un montant">
                </div>

                <div class="form-group col-md-5">
                  <label for="inputPassword4">Libellé</label>
                  <input type="text" name="libelle" class="form-control" id="inputPassword4" placeholder="Renseingez un libellé">
                </div>

            <div class="form-group col-md-10">
                <label for="inputState">Compte beneficiaire</label>
                    <select name="selectBenef" id="inputState" class="form-control">
                    

                    <?php while ($row = mysqli_fetch_array($result)):;?>
                    <?php echo '<option value='.$row['compteID'].'>'.$row['username']. ' ' .$row['userprenom']. ' - ' .$row['Rib'].'</option>';?>

                   
                    <?php endwhile; ?>


                    </select>
            </div>
        </div>
          </div>
        <div class="clearfix"></div>

      <div class="modal-footer">
        <div class="col-auto">
            <div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary" name="insertMontant-btn">Ajouter</button>
            </div> 
           </form>
        </div>

    </div>

    </div>        
  </div>
</div>




           </div>

        </div>
    </div>

</body>
</html>
<?php } ?>
