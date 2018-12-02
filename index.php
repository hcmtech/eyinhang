<?php include 'controllers/authController.php'?>
<?php
// redirect user to login page if they're not logged in
if (empty($_SESSION['UserID'])) {
    header('location: login.php');
}
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
     <link rel="stylesheet" href="stylesheet.css">
  </head>

<body>

<?php  if ($_SESSION['verified']===false){ ?> 


          <div class="modal fade" id="overlay">
            <div class="modal-dialog">
              <div class="modal-content" >
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Inscription réussie</h4>
                </div>
                  <div class="modal-body">
                  <h4>Bienvenue, <?php echo $_SESSION['username']." ".$_SESSION['userprenom']; ?></h4>
                </div>
              </div>
            </div>
          </div>

<?php } else  { ?>

          <div class="modal fade" id="overlay">
            <div class="modal-dialog">
              <div class="modal-content" >
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Connexion réussie</h4>
                </div>
                  <div class="modal-body">
                  <h4>Bienvenue, <?php echo $_SESSION['username']." ".$_SESSION['userprenom']; ?></h4>
                </div>
              </div>
            </div>
          </div>
<?php }?>       

    <script type="text/javascript"> 
        $('#overlay').modal('show');
            setTimeout(function() {
          $('#overlay').modal('hide');
      location.replace("home-user.php")
      }, 2000);
    </script>

</body>
</html>

