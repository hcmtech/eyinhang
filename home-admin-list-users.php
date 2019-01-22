<?php include 'controllers/affichageDonnees-admin.php'?>

<!DOCTYPE html>
<html lang="fr">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Liste des clients</title>
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

    $(function () {
    $('.navbar-toggle').click(function () {
        $('.navbar-nav').toggleClass('slide-in');
        $('.side-body').toggleClass('body-slide-in');
        $('#search').removeClass('in').addClass('collapse').slideUp(200);

        /// uncomment code for absolute positioning tweek see top comment in css
        //$('.absolute-wrapper').toggleClass('slide-in');
        
    });

    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
    }); 

        $('.btn-primary1').click(function() {
        $('#save').removeAttr("disabled");
        $('#cancel').removeAttr("disabled");
        
    });

        $('#cancel').click(function() {
        $('#save').attr('disabled', true);
        $('#cancel').attr('disabled', true);
        
    });
   
   // Remove menu for searching
   $('#search-trigger').click(function () {
        $('.navbar-nav').removeClass('slide-in');
        $('.side-body').removeClass('body-slide-in');

        /// uncomment code for absolute positioning tweek see top comment in css
        //$('.absolute-wrapper').removeClass('slide-in');

    });
});

</script>


<div class="row">
    <div class="side-menu">
    <nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <div class="brand-wrapper">
            <div class="brand-name-wrapper">
                <h3> Bonjour <?php echo $_SESSION['login'];?> ! </h3>
                <img src="img/icon-person.png" alt=""> 
                <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</a>
            </div>


    <!-- Main Menu -->
    <div class="side-menu-container">
        <ul class="nav navbar-nav">

            <li class="active"><a href="home-admin-list-users.php"><span class="glyphicon glyphicon-user"></span> Gérer les utilisateurs</a></li>
            <li><a href="home-admin-gestion-comptes.php"><span class="glyphicon glyphicon-list-alt"></span> Gérer les comptes</a></li>
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
                    <button type="button" class="btn btn-primary1 pull-right" data-toggle="modal" data-target="#exampleModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Modifier
                    </button>
                <div class="container-content">
                    <h1>Gérer le découvert des clients</h1>
                </div>

                <br>
  
            <div class="container-content">
            
            <form class="form-inline">
              <div class="form-group">
                <span class="glyphicon glyphicon-search" style="color:#169c81;"></span>
                <label for="exampleInputName" style="color:#169c81;">Recherche rapide</label> 
                <input type="text" class="form-control" id="searchInput">
              </div>
            </form>

            <table id="dtOrderExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr class="tableactivite">
                        <th class="th-sm">
                        Nom
                        </th>
                        <th scope="col">
                        Prénom
                        </th>
                        <th scope="col">
                        Rib
                        </th>
                        <th scope="col">
                        Solde
                        </th>
                    </tr>
                </thead>
            <tbody id="fbody">

<?php while($row = mysqli_fetch_array($result1))
{
echo "<tr>";
echo '<td>'. $row['username'] . '</td>';
echo "<td>" . $row['userprenom'] . "</td>";
echo "<td>" . $row['Rib'] . "</td>";
echo "<td>" . $row['compteSolde'] . "</td>";
echo "</tr>";
}

echo "</table>";

mysqli_close($conn);
?>

           </div>


          <button type="submit" id="save" name="modify-btn" class="btn btn-primary col-md-4 pull-right" disabled>Sauvegarder</button>

          <button type="submit" id="cancel" class="btn btn-primary pull-right" disabled>Annuler</button>
         
        </div>
    </div>

</body>
</html>

