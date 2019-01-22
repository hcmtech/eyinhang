<?php include 'controllers/authController.php' ?>

<?php 

// Je recherche les users qui n'ont pas l'autorisation d'avoir un découvert
$result = mysqli_query($conn, "SELECT U.UserID, U.username, U.userprenom, CO.autorisationDecouvert, CO.limiteDecouvert, CO.compteID
        FROM user U, Compte CO
        Where U.UserID=CO.UserID"
        );

$result1 = mysqli_query($conn, "SELECT U.UserID, CO.compteID, U.username, U.userprenom, CO.autorisationDecouvert, CO.limiteDecouvert, CO.compteID
        FROM user U, Compte CO
        Where U.UserID=CO.UserID
        and CO.autorisationDecouvert = 'Pas autorisé'
        and CO.typeCompteID ='1'
        "
        );

$result2 = mysqli_query($conn, "SELECT U.UserID, CO.compteID, U.username, U.userprenom, CO.autorisationDecouvert, CO.limiteDecouvert, CO.compteID
        FROM user U, Compte CO
        Where U.UserID=CO.UserID
        and CO.autorisationDecouvert = 'Autorisé'
        and CO.typeCompteID ='1'
        "
        );


$result3 = mysqli_query($conn, "SELECT U.UserID, CO.compteID, U.username, U.userprenom, CO.autorisationDecouvert, CO.limiteDecouvert, CO.compteID
        FROM user U, Compte CO
        Where U.UserID=CO.UserID
        and CO.autorisationDecouvert = 'Pas autorisé'
        and CO.typeCompteID ='1'
        "
        );

$result4 = mysqli_query($conn, "SELECT U.UserID, CO.compteID, U.username, U.userprenom, CO.autorisationDecouvert, CO.limiteDecouvert, CO.compteID
        FROM user U, Compte CO
        Where U.UserID=CO.UserID
        and CO.autorisationDecouvert = 'Autorisé'
        and CO.typeCompteID ='1'
        "
        );



 if(isset($_POST['insertValidationDecouvert-btn'])){

    $insertCompteAValider = $_POST['selectAutorisationDecouvert'];
    $insertMontantDecouvert = $_POST['montantDecouvert'];

        $query = "UPDATE compte SET autorisationDecouvert = 'Autorisé'
                WHERE compteID = $insertCompteAValider";
        $stmt = mysqli_query($conn, $query);

        $query1 = "UPDATE compte SET limiteDecouvert = $insertMontantDecouvert
                WHERE compteID = $insertCompteAValider";
        $stmt = mysqli_query($conn, $query1);

        echo "<meta http-equiv='refresh' content='0'>";

        mysqli_close($conn);
 };

  if(isset($_POST['insertMontantDecouvert-btn'])){

        $query1 = "UPDATE compte SET limiteDecouvert = $insertMontantDecouvert
                WHERE compteID = $insertCompteAValider";
        $stmt = mysqli_query($conn, $query1);

        echo "<meta http-equiv='refresh' content='0'>";

        mysqli_close($conn);
 };



?>