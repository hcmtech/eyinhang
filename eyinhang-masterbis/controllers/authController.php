<?php
session_start();
$username = "";
$userprenom="";
$adresse="";
$ville="";
$codepostale="";
$numerotel="";
$email = "";
$errors = [];

$conn = new mysqli('localhost', 'root', 'root', 'ebanking'); //La case code est vide, en mettre un si dans phpmyadmin vous en avez configuré un

// Incription utilisateur
//Règle de validation des données
if (isset($_POST['signup-btn'])) {
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
    $sql = "SELECT * FROM user WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $errors['email'] = "L'adresse email est déja utilisée";
    }

    if (count($errors) === 0) {
        $query = "INSERT INTO user SET username=?, userprenom=?, adresse=?, ville=?, codepostale=?, numerotel=?, email=?, password=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssiiss', $username, $userprenom, $adresse, $ville, $codepostale, $numerotel, $email, $password);
        $result = $stmt->execute();

        if ($result) {
            $user_id = $stmt->insert_id;
            $stmt->close();

            // TO DO: send verification email to user
            //sendVerificationEmail($email);

            $_SESSION['UserID'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['userprenom'] = $userprenom;
            $_SESSION['adresse']= $adresse;
            $_SESSION['ville']= $ville;
            $_SESSION['codepostale']= $codepostale;
            $_SESSION['numerotel']= $numerotel;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = false;

            header('location: index.php');
        } else {
            $_SESSION['error_msg'] = "Database error: Impossible d'enregistrer l'utilisateur";
        }
    }
}

// LOGIN
if (isset($_POST['login-btn'])) {
    if (empty($_POST['email'])) {
        $errors['email'] = "L'adresse email est requis";
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Le mot de passe est requis';
    }
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (count($errors) === 0) {
        $query = "SELECT * FROM user WHERE email=? OR password=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $email, $password);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) { // Si les deux mots de passes correspondent
                $stmt->close();

                $_SESSION['UserID'] = $user['UserID'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['userprenom'] = $user['userprenom'];
                $_SESSION['adresse'] = $user['adresse'];
                $_SESSION['ville'] = $user['ville'];
                $_SESSION['codepostale']= $user['codepostale'];
                $_SESSION['numerotel']= $user['numerotel'];
                $_SESSION['verified'] = $user['verified'];
                header('location: index.php');
                exit(0);
            } else { // Si les deux mots de passes ne correspondent pas
                $errors['login_fail'] = "Mauvaise adresse email / Mot de passe";
            }
        } else {
            $_SESSION['message'] = "Database error. Erreur de login!";
            $_SESSION['type'] = "alert-danger";
        }
    }
}
