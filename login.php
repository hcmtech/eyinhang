<?php include 'controllers/authController.php' ?>
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
     <link rel="stylesheet" href="stylesheet-admin.css">

  </head>


<body>


  <div class="container-fluid">
    <div class="row">
    	<div class="col-sm-4"> 
    	</div>

      <div class="col-sm-4">
      		<div class="formulaire">
      			<a href="accueil.php"><img src="img/logo1.png" width = "80px" alt=""></a>
        		<h3>Accéder à votre compte</h3> <br>

		        <?php if (count($errors) > 0): ?>
		          <div class="alert alert-danger">
		            <?php foreach ($errors as $error): ?>
		            <li>
		            <?php echo $error; ?>
		            </li>
		          <?php endforeach;?>
		        </div>
		      <?php endif;?>

        <form action="login.php" method="post">
          <div class="form-group">
            <label>Email :</label>
            <input type="text" name="email" class="form-control form-control-lg" value="<?php echo $email; ?>">
          </div>

          <div class="form-group">
            <label>Mot de passe :</label>
            <input type="password" name="password" class="form-control form-control-lg">
          </div>

          <div class="form-group form-check">
			<label class="form-check-label">
			<input class="form-check-input" type="checkbox"> Se rappeler de moi</label>
		  </div>
          
            <button type="submit" name="login-btn" class="btn btn-primary btn-block">Login</button>
         
        </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>


</body>





