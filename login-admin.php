<?php include 'controllers/authController-admin.php' ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Admin's Home</title>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
         <link rel="stylesheet" href="stylesheet-admin.css">

  </head>


<body>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-4">
    </div>

    <div class="col-sm-4" bg-light>
      <div class="formulaire">
      	<img src="img/logo1.png" width = "80px" alt="">
			<h1>Back-Office</h1></br>

            <?php if (count($errors) > 0): ?>
              <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                <li>
                <?php echo $error; ?>
                </li>
              <?php endforeach;?>
            </div>
          <?php endif;?>

				<form action="login-admin.php" method="post">
				  <div class="form-group">
				    <label>Login :</label>
				    <input type="text" name="login" class="form-control form-control-lg" value="<?php echo $login; ?>">
				  </div>

				  <div class="form-group">
            <label>Mot de passe :</label>
            <input type="password" name="adminPassword" class="form-control form-control-lg">
				  </div>
          
				  <button type="submit" class="btn btn-primary btn-block" name="login-admin-btn">Se connecter</button>
				</form>

	</div>
    </div>

    <div class="col-sm-4">
    </div>
  </div>
</div>


</body>
