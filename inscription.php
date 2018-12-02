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
     <link rel="stylesheet" href="inscription.css">
  </head>

<body>
  <header class ="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">KL BANK</a>  
      </div>
      <ul class="nav navbar-nav">
                    <li><a href="offre.html">Notre offre</a></li>
                    <li><a href="tarif.html">Nos tarifs</a></li>
                    <li><a href="support.html">Support</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
                    <li><a href="inscription.php">Ouvrir un compte courant</a></li>
                    <li><a href="login.php">Déjà client ? </a></li>
      </ul>
      
      
      </ul>
      
    </div>   
  </header>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3"> 
    </div>

    <div class="col-sm-6" bg-light>
      <div class="formulaire">
      <h1>BIENVENUE</h1>
      <h2>Devenez client Ebanking ! </h2>
      <hr>
      <p>Chez Ebanking, nos services 100% connectés vous permettent d'ouvrir votre compte en ligne et en quelques clics.</p>
      <br>

      <form action="inscription.php" method="post">
      <?php if (count($errors) > 0): ?>
        <div class="alert alert-danger">
          <?php foreach ($errors as $error): ?>
          <li>
            <?php echo $error; ?>
          </li>
          <?php endforeach;?>
        </div>
      <?php endif;?>
          <div class="form-group col-md-6">
            <label for="nom"> Nom:</label>
            <input type="text" name="username" class="form-control mb-2 mr-sm-2" class="form-control">
          </div>
          <div class="form-group col-md-6">
            <label for="prenom"> Prénom:</label>
            <input type="text" name="userprenom" class="form-control mb-2 mr-sm-2" class="form-control">
          </div>
          <div class="form-group col-md-6">
            <label for="adresse"> Adresse:</label>
            <input type="text" name="adresse" class="form-control mb-2 mr-sm-2" class="form-control">
          </div>
                    <div class="form-group col-md-3">
            <label for="ville"> Ville:</label>
            <input type="text" name="ville" class="form-control mb-2 mr-sm-2" class="form-control">
          </div>
                    <div class="form-group col-md-3">
            <label for="codePostale"> Code Postale:</label>
            <input type="integer" = name="codepostale" class="form-control mb-2 mr-sm-2" class="form-control">
          </div>
          <div class="form-group">
            <label for="numeroTel"> Numéro de téléphone:</label>
            <input type="integer" name="numerotel"class="form-control mb-2 mr-sm-2" class="form-control">
          </div>
          <div class="form-group">
            <label for="email"> Adresse mail:</label>
            <input type="email" name="email" class="form-control mb-2 mr-sm-2" class="form-control">
          </div>
          <div class="form-group">
            <label for="pwd">Mot de passe:</label>
            <input type="password" name="password" class="form-control">
          </div>
          <div class="form-group">
            <label for="pwd">Confirmer le mot de passe:</label>
            <input type="password" name="passwordConf" class="form-control">
          </div>
          <div class="form-group form-check">
            <label class="form-check-label">
              <input class="form-check-input" type="checkbox"> Remember me
            </label>
          </div>
          <button type="submit" name="signup-btn" class="btn btn-primary col-md-4 pull-right">Ouvrir un compte courant</button>
        </form>
        </div>

  </div>
</div>
</div>
   

    <div class="col-sm-4">
    </div>
  </div>

  <div class="container">
<p>
Les données recueillies dans le cadre de votre demande d'ouverture de compte ont un caractère obligatoire et sont indispensables pour gérer votre demande. Elles font l'objet d'un traitement automatique, par Boursorama et ses sous-traitants, uniquement à des fins de finalisation de votre demande. Vos données pourront être conservées pendant une durée maximale d'un an à des fins probatoires. A l'issue de cette période, elles seront anonymisées et conservées à des fins statistiques et d'étude.

Dans le cadre de vos échanges avec Boursorama, vos conservations téléphoniques et les Tchats sont enregistrés à des fins probatoire et de contrôle de qualité. Conformément à la réglementation applicable, vous disposez d'un droit d'accès, de rectification, d'effacement, d'opposition pour motifs légitimes, de limitation du traitement, sous réserve de justifier de votre identité. Les modalités d'exercice de ces droits sont décrites dans le courrier électronique que vous recevrez dans le cadre de votre demande d'ouverture de compte. Vous avez également le droit d'introduire une réclamation auprès de la CNIL.
</p>
</div>

</body>
</html>
