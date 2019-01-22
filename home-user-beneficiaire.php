<?php include 'controllers/affichageDonnees.php' ?>
<?php 
    if(empty($_SESSION['UserID'])) {
        header('location: login.php');
    } else {
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Mes bénéficiaires</title>
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

$("#searchInput").keyup(function () {
    //split the current value of searchInput
    var data = this.value.split(" ");
    //create a jquery object of the rows
    var jo = $("#fbody").find("tr");
    if (this.value == "") {
        jo.show();
        return;
    }
    //hide all the rows
    jo.hide();

    //Recusively filter the jquery object to get results.
    jo.filter(function (i, v) {
        var $t = $(this);
        for (var d = 0; d < data.length; ++d) {
            if ($t.is(":contains('" + data[d] + "')")) {
                return true;
            }
        }
        return false;
    })
    //show the rows that match.
    .show();
}).focus(function () {
    this.value = "";
    $(this).css({
        "color": "black"
    });
    $(this).unbind('focus');
}).css({
    "color": "#C0C0C0"
});


    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
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
            <li><a href="home-user-account.php"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
                        <!-- Dropdown-->
            <li class="panel panel-default" id="dropdown"><a data-toggle="collapse" href="#dropdown-lvl1">
            <span class="glyphicon glyphicon-piggy-bank"></span> Gérer mes comptes <span class="caret"></span></a>
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
            <li class="active"><a href="home-user-beneficiaire.php"><span class="glyphicon glyphicon-user"></span> Vos bénéficiaires</a></li>
            <li><a href="home-user-chequier.php"><span class="glyphicon glyphicon-folder-close"></span> Demander mon chéquier </a></li>

        </ul>
    </div><!-- /.navbar-collapse -->
    </nav>
</div>
</div>


    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">
             <div class="horizontal-header">
                  <button type="button" class="btn btn-primary1 pull-right" data-toggle="modal" data-target="#exampleModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ajouter des bénéficiaires
                  </button>
                <div class="container-content">
                    <h1>Vos bénéficiaires </h1>
                </div>
            </div>
            </div>

            <div class="container-fluid">
            <div class="side-body">
            <div class="container-content">
            <br>
  
            <!-- Liste des bénéficiaires validés -->
              <?php 
                $total=mysqli_num_rows($result4); // va retourner le nombre de ligne
                if (($total) == NULL){ 
                    echo "<p style='font-size: 2.5rem; font-weight:bold; color:#169c81'>Vous n'avez encore aucun bénéficiaires d'ajoutés.</p>";
                } else { // si il y a des opérations alors on affiche =
            echo <<<MYTAG
            <h1>Liste de vos bénéficiaires actifs</h1>
            
            <form class="form-inline">
              <div class="form-group">
                <span class="glyphicon glyphicon-search" style="color:#169c81;"></span>
                <label for="exampleInputName2" style="color:#169c81;">Recherche rapide</label> 
                <input type="text" class="form-control" id="searchInput">
              </div>
            </form>

            <table class="table table-striped">
                <thead>
                    <tr class="tableactivite">
                        <th scope="col">
                        Identité du bénéficiaire
                        </th>
                        <th scope="col">
                        IBAN
                        </th> 
                        <th scope="col">
                        Date de l'ajout
                        </th>       
                    </tr>
                </thead>
            <tbody id="fbody">
MYTAG;


            while($row = mysqli_fetch_array($result4))
            {
            echo "<tr>";
            echo '<td>'. $row['username'] . ' '.$row['userprenom'] . '</td>'; 
            echo "<td>" . $row['Rib'] . "</td>";
            echo "<td>" . $row['dateAjoutBeneficiaire'] .'</td>';
            echo "</tr>";
            }

            echo "</table>";
            mysqli_close($conn);
                };
             ?>

<br>
<!-- Liste des bénéficiaires en attente de validation -->
  <?php 
    $total=mysqli_num_rows($result5); // va retourner le nombre de ligne
    if (($total) == NULL){ 
    } else { // si il y a des opérations alors on affiche =
echo <<<MYTAG
            <h1>Liste de vos bénéficiaires en attente de validation</h1>
            <table class="table table-striped">
                <thead>
                    <tr class="tableactivite">
                        <th scope="col">
                        Identité du bénéficiaire
                        </th>
                        <th scope="col">
                        IBAN
                        </th> 
                        <th scope="col">
                        Date de l'ajout
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
        <h3 class="modal-title" id="exampleModalLabel">Ajouter des bénéficiaires</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
          <form action="home-user-beneficiaire.php" method="post">
              <div class="form-group">
                  <label for="IBAN"> IBAN du bénéficiaire :</label>
                  <input type="text" name="insertIBAN" class="form-control mb-2 mr-sm-2 mb-sm-0" class="form-control">
            </div>

      </div>  

      <div class="modal-footer">
        <div class="col-auto">
            <button type="submit" name="insertIBAN-btn" class="btn btn-primary mb-2">Ajouter</button>
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
