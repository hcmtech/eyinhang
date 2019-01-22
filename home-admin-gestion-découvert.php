<?php include 'controllers/gestionDecouvert.php'?>

<!DOCTYPE html>
<html lang="fr">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Gérer les découverts</title>
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
            <li class="active"><a href="home-admin-gestion-découvert.php"><span class="glyphicon glyphicon-euro"></span> Autorisation découvert</a></li>
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
                    <button type="button" class="btn btn-primary1 pull-right" data-toggle="modal" data-target="#ModalValiderAutorisation"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Gérer les autorisations
                    </button>

                     <button type="button" class="btn btn-primary1 pull-right" data-toggle="modal" data-target="#ModalGererMontant"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Gérer les montants des découverts
                    </button>
                <div class="container-content">
                    <h1>Gérer le découvert des clients</h1>
                </div>

                <br>
  
            <div class="container-content">
            <h2>Liste des clients autorisés au découvert </h2>
            <table class="table">
                <thead>
                    <tr class="tableactivite">
                        <th scope="col">
                        ID du compte client
                        </th>
                        <th scope="col">
                        Nom
                        </th>
                        <th scope="col">
                        Prénom
                        </th>
                        <th scope="col">
                        Découvert
                        </th>
                        <th scope="col">
                        Montant du découvert
                        </th>
                         <th scope="col">
                        </th>
                    </tr>
                </thead>
            <tbody>

        <?php while($row = mysqli_fetch_array($result2))
        {
            echo "<tr>";
            echo '<td>'. $row['compteID'] . '</td>';
            echo '<td>'. $row['username'] . '</td>';
            echo "<td>" . $row['userprenom'] . "</td>";
            echo "<td style='color:green;font-weight:bold;''>".$row['autorisationDecouvert'] . "</td>";
            echo '<td>'. $row['limiteDecouvert'] .' € '.'</td>';
            echo "</tr>";
            }
            echo "</table>";
        ?>

             <h2>Liste des clients non autorisés au découvert </h2>
            <table class="table">
                <thead>
                    <tr class="tableactivite">
                        <th scope="col">
                        ID du compte client
                        </th>
                        <th scope="col">
                        Nom
                        </th>
                        <th scope="col">
                        Prénom
                        </th>
                        <th scope="col">
                        Découvert
                        </th>
                         <th scope="col">
                        </th>
                    </tr>
                </thead>
            <tbody>

        <?php while($row = mysqli_fetch_array($result1))
        {
            echo "<tr>";
            echo '<td>'. $row['compteID'] . '</td>';
            echo '<td>'. $row['username'] . '</td>';
            echo "<td>" . $row['userprenom'] . "</td>";
            echo "<td style='color:#465e77;font-weight:bold;''>".$row['autorisationDecouvert'] . "</td>";
            echo "</tr>";
            }
            echo "</table>";
        ?>

           </div>


<!-- Modal Valider autorisation -->
<div class="modal fade" id="ModalValiderAutorisation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Autoriser un client au découvert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="home-admin-gestion-découvert.php" method="POST">
             <div class="form-group">

            <div class="form-group col-md-8">
                <label for="inputState">Compte à valider</label>
                    <select name="selectAutorisationDecouvert" id="inputState" class="form-control">
                    <?php while ($row = mysqli_fetch_array($result3)):;?>
                    <?php echo '<option value='.$row['compteID'].'>'  .$row['compteID']. ' - '.$row['username']. ' ' .$row['userprenom']. '</option>';?>
                    <?php endwhile; ?>
                    </select>
            </div>

                <div class="form-group col-md-8">
                  <label for="inputEmail4">Définir le montant du découvert</label>
                  <input type="text" name="montantDecouvert" class="form-control" id="inputEmail4" placeholder="Renseignez un montant">
                </div>

                    </select>
            </div>
    
          </div>
        <div class="clearfix"></div>

      <div class="modal-footer">
        <div class="col-auto">
            <div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary" name="insertValidationDecouvert-btn">Valider</button>
            </div> 
           </form>
        </div>

    </div>

    </div>        
  </div>
</div>

<!-- Modal Gérer les montants des découverts -->
<div class="modal fade" id="ModalGererMontant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Autoriser un client au découvert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="home-admin-gestion-découvert.php" method="POST">
             <div class="form-group">

            <div class="form-group col-md-8">
                <label for="inputState">Compte à modifier</label>
                    <select name="selectAutorisationDecouvert" id="inputState" class="form-control">
                    <?php while ($row = mysqli_fetch_array($result4)):;?>
                    <?php echo '<option value='.$row['compteID'].'>'  .$row['compteID']. ' - '.$row['username']. ' ' .$row['userprenom']. '</option>';?>
                    <?php endwhile; ?>
                    </select>
            </div>

                <div class="form-group col-md-8">
                  <label for="inputEmail4">Définir le nouveau montant du découvert</label>
                  <input type="text" name="montantDecouvert" class="form-control" id="inputEmail4" placeholder="Renseignez un montant">
                </div>

                    </select>
            </div>
    
          </div>
        <div class="clearfix"></div>

      <div class="modal-footer">
        <div class="col-auto">
            <div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary" name="insertMontantDecouvert-btn">Valider</button>
            </div> 
           </form>
        </div>

    </div>

    </div>        
  </div>
</div>

         
        </div>
    </div>

</body>
</html>

