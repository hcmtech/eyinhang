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
         <link rel="stylesheet" href="css/home-user-account.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Mon compte courant</title>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
            <li class="panel panel-default" id="dropdown">
                <a data-toggle="collapse" href="#dropdown-lvl1">
                    <span class="glyphicon glyphicon-piggy-bank"></span> Gérer mes comptes <span class="caret"></span>
                </a>

                <!-- Dropdown level 1 -->
                <div id="dropdown-lvl1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="home-user-comptes.php">Mon compte courant</a></li>
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

    <!-- Controler -->


    <!-- Main Content -->

        <div class="container-fluid">
            <div class="side-body">
                <div class="horizontal-header">
                <div class="container-content">
                    <h1>Détails des opérations du compte courant</h1>
                </div>


                <br>
  
            <div class="container-content">
<div class="row">
  <div class="col-md-6">
    <!-- Card 1 : Display solde -->
                <div class="card" >
                    <div class="card-body">
                         <h3 class="card-title">Solde du compte courant </h3>
                           
                                <?php
                                 while ($row = mysqli_fetch_array($result1)) {
                                    if($row['typeCompteID'] == 1) 
                                    {
                                    echo "<p>" . $row['compteSolde'] . ' €'. "</p>"; 
                                }
                                }
                               
                                ?>
                            
                        
                    </div>
                </div> 
                <br>
  </div>

    <div class="col-md-6">
    <!-- Card 2 : Display solde compte epargne-->
                <div class="card" >
                    <div class="card-body">
                         <h3 class="card-title">Votre découvert </h3>
                                <?php
                                    while ($row = mysqli_fetch_array($result12)) {
                                        if($row['autorisationDecouvert'] == 'Autorisé') 
                                        {
                                        echo '<h1><span class="badge badge-success" style="font-size: 1.5rem; background:green;">'. $row['autorisationDecouvert'] .'</span></h1>';
                                        echo '<p style="font-size: 2rem; font-weight:bold; color:green">'. $row['limiteDecouvert'] .'€'.'</p>';
                                        } else {
                                         echo '<h1><span class="badge badge-success" style="font-size: 1.5rem; background:red;">'. $row['autorisationDecouvert'] .'</span></h1>';   
                                        }
                                    
                                }

                                mysqli_close($conn);
                                ?> <br>
                    </div>
                </div>
  </div> <br> <br>


            <form class="form-inline">
              <div class="form-group">
                <span class="glyphicon glyphicon-search" style="color:#169c81;"></span>
                <label for="exampleInputName" style="color:#169c81;">Recherche rapide</label> 
                <input type="text" class="form-control" id="searchInput">
              </div>
            </form>

            <table class="table table-striped table2">
                <thead>
                    <tr class="tableactivite">
                        <th scope="col">
                        Date de l'opération
                        </th>
                        <th scope="col">
                        Libellé
                        </th>
                        <th scope="col">
                        Montant
                        </th>

                    </tr>
                </thead>
            <tbody id="fbody">

<?php while($row = mysqli_fetch_array($result8))
{

echo "<tr>";
echo "<td>" . $row['dateOperation'] . "</td>";
echo "<td>" . $row['libelleOperation'] . "</td>";
if($row['compteID_debiteur']== $compteID2) {
        echo "<td style='color:red; font-weight:bold;''>" . "- ".$row['montant'] . "</td>";
    } 

if($row['compteID_crediteur']== $compteID2) {
        echo "<td style='color:#465e77;font-weight:bold;''>" . "+ ".$row['montant'] . "</td>";
    }
echo "</tr>";
}

echo "</table>";

?>

           </div>
        </div>
    </div>

</body>
</html>
<?php } ?>
