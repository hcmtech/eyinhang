<?php
session_start();
$AdminID = "";
$login = "";
$errors = [];


$conn = new mysqli('localhost', 'root','root', 'ebankingavecm'); //La case code est vide, en mettre un si dans phpmyadmin vous en avez configuré un



// LOGIN
if (isset($_POST['login-admin-btn'])) {
    if (empty($_POST['login'])) {
        $errors['login'] = "Le login est requis";
    }
    if (empty($_POST['adminPassword'])) {
        $errors['adminPassword'] = 'Le mot de passe est requis';
    }
    $login = $_POST['login'];
    $adminPassword = $_POST['adminPassword'];

    if (count($errors) === 0) {
        $query = "SELECT * FROM admin WHERE login=? OR adminPassword=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $login, $adminPassword);

        if ($stmt->execute()) {
            $result = $stmt->get_result(); // Récupère les résultats
            $user = $result->fetch_assoc(); // Associe les résulatats de la requête variable $user
                $stmt->close();

                $_SESSION['AdminID'] = $user['AdminID'];
                $_SESSION['login'] = $user['login'];
                    header('location: index-admin.php');

                exit(0);
            } else { // Si les deux mots de passes ne correspondent pas
                $errors['login_fail'] = "Mauvaise adresse login / Mot de passe";
            }
        } else {
            $_SESSION['message'] = "Database error. Erreur de login!";
            $_SESSION['type'] = "alert-danger";
        }
    }
?>