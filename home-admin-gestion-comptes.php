<?php include 'controllers/affichageDonnees-admin.php'?>

<!DOCTYPE html>
<html lang="fr">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Gérer les comptes</title>
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
                <h3> Bonjour <?php echo $_SESSION['login']?> ! </h3>
                <img src="img/icon-person.png" alt=""> 
                <a href="logout-admin.php"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</a>
            </div>


    <!-- Main Menu -->
    <div class="side-menu-container">
        <ul class="nav navbar-nav">

            <li><a href="home-admin-list-users.php"><span class="glyphicon glyphicon-user"></span> Gérer les utilisateurs</a></li>
            <li class="active"><a href="home-admin-gestion-comptes.php"><span class="glyphicon glyphicon-list-alt"></span> Gérer les comptes</a></li>
            <li><a href="home-admin-gestion-découvert.php"><span class="glyphicon glyphicon-euro"></span> Autorisation découvert</a></li>
            <li><a href="home-admin-gestion-beneficiaire.php"><span class="glyphicon glyphicon-check"></span> Valider les bénéficiaires</a></li>
            <li><a href="home-admin-gestion-chéquier.php"><span class="glyphicon glyphicon-folder-close"></span>Envoi de chéquier</a></li>

        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
    
    </div>

    <!-- Main Content -->

        <div class="container-fluid">
            <div class="side-body">
                <div class="horizontal-header">
                    <button type="button" class="btn btn-primary1 pull-right" data-toggle="modal" data-target="#faireTransfertCtC"><span class="
glyphicon glyphicon-transfer" aria-hidden="true"></span> Faire un transfert d'un compte à l'autre</button>
                     <button type="button" class="btn btn-primary1 pull-right" data-toggle="modal" data-target="#faireTransfert"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Faire un transfert</button>
                <div class="container-content">
                    <h1>Gérer les comptes des clients</h1>
                </div>

                <br>
  
            <div class="container-content">

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
                        Numéro de l'opération
                        </th>
                        <th scope="col">
                        Numéro du compte émetteur
                        </th>
                        <th scope="col">
                        Numéro du compte bénéficiaire
                        </th>
                        <th scope="col">
                       Montant
                        </th>
                        <th scope="col">
                       Libellé
                        </th>
                        <th scope="col">
                        Date du virement
                        </th>
                    </tr>
                </thead>
            <tbody  id="fbody">

<?php while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo '<td>'. $row['operationID'] . '</td>';
echo '<td>'. $row['compteID_debiteur'] . ' ' .$row['userprenom'] . '</td>';
echo "<td>" . $row['compteID_crediteur'] . "</td>";
echo "<td>" . $row['montant'] . "</td>";
echo "<td>" . $row['libelleOperation'] . "</td>";
echo "<td>" . $row['dateOperation'] . "</td>";

echo "</tr>";
}

echo "</table>";

$result_4 = mysqli_query($conn,"SELECT COUNT(operationID) FROM operation");
$row_db = mysqli_fetch_row($result_4);
$total_records = $row_db[0];
$total_pages = ceil($total_records / $limit);
/* echo  $total_pages; */
$pagLink = "<ul class='pagination justify-content-end'>";
for ($i=1; $i<=$total_pages; $i++) {
              $pagLink .= "<li class='page-item'>
              <a class='page-link' href='home-admin-gestion-comptes.php?page=".$i."'>".$i."</a></li>";
}
echo $pagLink . "</ul>";

mysqli_close($conn);
?>

           </div>
        </div>
    </div>



<!-- Modal Transfert d'un compte à l'autre -->
<div class="modal fade" id="faireTransfertCtC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Faire un transfert </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <form action="home-admin-gestion-comptes.php" method="POST">
             <div class="form-group">
                <div class="form-group col-md-6">
                <label for="inputState">Choisir l'émetteur</label>
                    <select name="selectEmetteur" id="inputState" class="form-control">
                    <?php while ($row = mysqli_fetch_array($result41)):;?>
                    <?php echo '<option value='.$row['compteID'].'>'.$row['typeCompteLibelle']. ' - ' .$row['username'].' '.$row['userprenom'].'</option>';?>
                    </option>
                    <?php endwhile; ?>
                    </select>
                </div> 

                <div class="form-group col-md-6">
                <label for="inputState">Choisir le bénéficiaire</label>
                    <select name="selectBenef" id="inputState" class="form-control">
                    <?php while ($row = mysqli_fetch_array($result4)):;?>
                    <?php echo '<option value='.$row['compteID'].'>'.$row['typeCompteLibelle']. ' - ' .$row['username'].' '.$row['userprenom'].'</option>';?>
                    <?php endwhile; ?>
                    </select>
                </div> 

                <div class="form-group col-md-6">
                  <label for="inputEmail4">Montant</label>
                  <input type="text" name="montant" class="form-control" id="montant" placeholder="Renseignez un montant">
                </div>

                <div class="form-group col-md-6">
                  <label for="inputPassword4">Libellé</label>
                  <input type="text" name="libelle" class="form-control" id="Libelle" >
                </div>
          </div>
        </div>
                <div class="clearfix"></div>

                <div class="modal-footer">
                    <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary" name="insertTransfertCtC-btn">Valider</button>
                   </form>
                </div>

    </div>

    </div>        
  </div>
</div>
    

<!-- Modal Transfert d'un compte à l'autre -->
<div class="modal fade" id="faireTransfert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Faire un transfert </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <form action="home-admin-gestion-comptes.php" method="POST">
             <div class="form-group">

                <div class="form-group col-md-6">
                <label for="inputState">Choisir le bénéficiaire</label>
                    <select name="selectBenef" id="inputState" class="form-control">
                    <?php while ($row = mysqli_fetch_array($result42)):;?>
                    <?php echo '<option value='.$row['compteID'].'>'.$row['typeCompteLibelle']. ' - ' .$row['username'].' '.$row['userprenom'].'</option>';?>
                    <?php endwhile; ?>
                    </select>
                </div> 

                <div class="form-group col-md-6">
                <label for="inputState">Type d'opération</label>
                    <select name="selectTypeOperation" id="inputState" class="form-control">
                    <option value='debit'>Débiter</option>
                    <option value='credit'>Créditer</option>
                    </select>
                </div> 

                <div class="form-group col-md-6">
                  <label for="inputEmail4">Montant</label>
                  <input type="text" name="montant" class="form-control" id="montant" placeholder="Renseignez un montant">
                </div>

                <div class="form-group col-md-6">
                  <label for="inputPassword4">Libellé</label>
                  <input type="text" name="libelle" class="form-control" id="Libelle" >
                </div>
          </div>
        </div>
                <div class="clearfix"></div>

                <div class="modal-footer">
                    <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary" name="insertTransfert-btn">Valider</button>
                   </form>
                </div>

    </div>

    </div>        
  </div>
</div>


</body>
</html>


