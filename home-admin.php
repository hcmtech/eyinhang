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
         <link rel="stylesheet" href="stylesheet.css">

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

				<form action="/action_page.php">
				  <div class="form-group">
				    <label for="email" > Adresse mail:</label>
				    <input type="email" class="form-control mb-2 mr-sm-2" class="form-control" id="email">
				  </div>
				  <div class="form-group">
				    <label for="pwd">Mot de passe:</label>
				    <input type="password" class="form-control" id="pwd">
				  </div>
				  <div class="form-group form-check">
				    <label class="form-check-label">
				      <input class="form-check-input" type="checkbox"> Remember me
				    </label>
				  </div>
				  <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
				</form>

	</div>
    </div>

    <div class="col-sm-4">
    </div>
  </div>
</div>


</body>
