<?php include 'controllers/authController.php' ?>

<?php 
 // Modification du profil
if (isset($_POST['modify-btn'])){   
    if (empty($_POST['username'])) {
        $errors['username'] = 'Le nom est requis';
    }
    if (empty($_POST['userprenom'])) {
        $errors['userprenom'] = 'Le prenom est requis';
    }
    if (empty($_POST['adresse'])) {
        $errors['adresse'] = 'Une adresse est requise';
    }
    if (empty($_POST['ville'])) {
        $errors['ville'] = 'Une ville est requise';
    }
    if (empty($_POST['codepostale'])) {
        $errors['codepostale'] = 'Un code postale est requis';
    }
    if (empty($_POST['numerotel'])) {
        $errors['numerotel'] = 'Un numero de téléphone est requis';
    }
    if (empty($_POST['email'])) {
        $errors['email'] = 'Une adresse email est requise';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Mot de passe requis';
    }
    if (isset($_POST['password']) && $_POST['password'] !== $_POST['passwordConf']) {
        $errors['passwordConf'] = 'Les deux mots de passes ne correspondent pas';
    }

    $username = $_POST['username'];
    $userprenom=$_POST['userprenom'];
    $adresse=$_POST['adresse'];
    $ville=$_POST['ville'];
    $codepostale=$_POST['codepostale'];
    $numerotel=$_POST['numerotel'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypte le password

    // Check si le mail est déja existant
    

    if (count($errors) === 0) {
        $query = "UPDATE user SET username=?, userprenom=?, adresse=?, ville=?, codepostale=?, numerotel=?, email=?, password=? where UserID='".$_SESSION['UserID']."'";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssiiss', $username, $userprenom, $adresse, $ville, $codepostale, $numerotel, $email, $password);
        $result = $stmt->execute();

        if ($result) {
          
            $stmt->close();

            // TO DO: send verification email to user
            //sendVerificationEmail($email);
            $_SESSION['username'] = $username;
            $_SESSION['userprenom'] = $userprenom;
            $_SESSION['adresse']= $adresse;
            $_SESSION['ville']= $ville;
            $_SESSION['codepostale']= $codepostale;
            $_SESSION['numerotel']= $numerotel;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = false;

            header('location: home-user-profil.php');
        } else {
            $_SESSION['error_msg'] = "Database error: Impossible de modifier l'utilisateur";
        }
    }

    }


 ?>
