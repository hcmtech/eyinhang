<?php include 'controllers/authController.php' ?>

<?php 

$result = mysqli_query($conn, "SELECT U.username, CO.compteSolde, CO.autorisationDecouvert, CO.typeCompteID
        FROM user U, Compte CO
        Where U.UserID='".$_SESSION['UserID']."'
        and CO.UserID='".$_SESSION['UserID']."'
        ");


$result1 = mysqli_query($conn, "SELECT O.montant, O.dateOperation, O.libelleOperation, O.user_debiteur, O.user_crediteur, O.operationID
FROM operation O, compte CO
WHERE O.user_debiteur = '".$_SESSION['UserID']."'
OR O.user_crediteur = '".$_SESSION['UserID']."'
ORDER BY O.dateOperation DESC
");

$result2 = mysqli_query($conn, "SELECT CO.typeCompteID
        from user U, compte CO
        Where CO.UserID='".$_SESSION['UserID']."'
        and U.UserID='".$_SESSION['UserID']."'
        ");


$compteID = mysqli_query($conn, "SELECT CO.compteID
        from user U, compte CO
        Where CO.UserID='".$_SESSION['UserID']."'
        and U.UserID='".$_SESSION['UserID']."'
        and CO.typeCompteID = '2'
        ");

//stocker la session de l'user
$userID = $_SESSION['UserID'];

$compteID1 = mysqli_fetch_array($compteID); // on va chercher le résultat de la query $compteID
$compteID2 = $compteID1['compteID']; // on stocke l'affichage du résultat dans une variable

$result8 = mysqli_query($conn, "SELECT montant, dateOperation, libelleOperation, user_debiteur, user_crediteur, compteID
FROM operation
WHERE compteID = $compteID2
AND (user_debiteur = '".$_SESSION['UserID']."'
OR user_crediteur = '".$_SESSION['UserID']."')
ORDER BY dateOperation DESC
");

$result3 = mysqli_query($conn, "SELECT CO.compteSolde, CO.autorisationDecouvert, CO.typeCompteID, CO.compteID, O.user_crediteur, O.user_debiteur, O.montant, O.dateOperation, O.libelleOperation
        FROM Compte CO, operation O
        Where CO.UserID='".$_SESSION['UserID']."'
        and CO.typeCompteID = '2'
		or O.user_crediteur = '".$_SESSION['UserID']."'
		and CO.compteID = O.compteID
		ORDER BY O.dateOperation DESC
        ");

?>