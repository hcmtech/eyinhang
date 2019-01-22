<?php include 'controllers/authController.php' ?>

<?php 
 // Affichage des données 

$result1 = mysqli_query($conn,"SELECT CO.compteSolde, CO.autorisationDecouvert, U.userID, U.username, U.userprenom, CO.Rib
                FROM user U, Compte CO
                Where CO.UserID=u.userID");

//Fonctionnalité pagination
 $limit = 15 ;
if (isset($_GET["page"])) {
    $page  = $_GET["page"];
    }
    else{
    $page=1;
    };
$start_from = ($page-1) * $limit;

$result = mysqli_query($conn,"SELECT DISTINCT O.montant, O.dateOperation, O.libelleOperation, O.compteID_debiteur, O.compteID_crediteur, O.operationID
        from operation O, user U, compte CO
        WHERE O.userID = U.UserID
        and (O.compteID_crediteur = CO.compteID or O.CompteID_debiteur = CO.compteID )
        and CO.UserID = U.UserID
        ORDER BY O.operationID ASC LIMIT $start_from, $limit
        ");

// Fonctionnalité : Envoi du chéquier
// J'affiche les données des users ayant fait une demande de chéquier
$resultChequier = mysqli_query($conn, "SELECT U.UserID, U.username, U.userprenom, C.dateDemandeChequier, C.demandeChequier, C.envoiChequier, C.chequierID
        FROM user U, chequier C
        Where U.UserID = C.UserID
        and C.demandeChequier ='1'
        and C.envoiChequier='0'");

// J'envoie la validation des envois de chéquier

 if(isset($_POST['validerEnvoiChequier-btn']) ){
    if(!empty($_POST['identityUser1'])) {
        foreach($_POST['identityUser1'] as $checked) {
        $query8 = "UPDATE chequier SET envoiChequier='1', dateEnvoiChequier=now() 
         WHERE chequierID = $checked";
        $stmt = mysqli_query($conn, $query8);
    }
}
        echo "<meta http-equiv='refresh' content='0'>";
        mysqli_close($conn);
 };




// Dans cette requête, j'affiche tous les comptes (courant et épargne) de tous les users

$result4 = mysqli_query($conn,"SELECT CO.compteID, CO.typeCompteID, CO.compteSolde, TC.typeCompteLibelle, CO.Rib, U.UserID, U.username, U.userprenom
        from user U, compte CO, typeCompte TC
        Where U.UserID = CO.UserID
        and CO.typeCompteID = TC.typeCompteID
        ");

$result41 = mysqli_query($conn,"SELECT CO.compteID, CO.typeCompteID, CO.compteSolde, TC.typeCompteLibelle, CO.Rib, U.UserID, U.username, U.userprenom
        from user U, compte CO, typeCompte TC
        Where U.UserID = CO.UserID
        and CO.typeCompteID = TC.typeCompteID
        ");

$result42 = mysqli_query($conn,"SELECT CO.compteID, CO.typeCompteID, CO.compteSolde, TC.typeCompteLibelle, CO.Rib, U.UserID, U.username, U.userprenom
        from user U, compte CO, typeCompte TC
        Where U.UserID = CO.UserID
        and CO.typeCompteID = TC.typeCompteID
        ");

//$result = mysqli_query($conn, "INSERT INTO operation (montant, compte,libelleOperation) VALUES ('$insertMontant', '$compteID', '$insertLibelle');");



// Fonctionnalité transfert d'argent d'un compte vers l'autre
 if(isset($_POST['insertTransfertCtC-btn'])){

    
// Fonctionnalité : faire des virements d'un compte à l'autre

//récupérer l'userID du compte emetteur
$userIDEmetteur = mysqli_query($conn, "SELECT UserID
        from compte
        Where compteID ='".$_POST['selectEmetteur']."' ");
$userID5 = mysqli_fetch_array($userIDEmetteur); // on va chercher le résultat de la query $compteID
$userID6 = $userID5['UserID'];

// récupérer l'USERID du compte bénéficiaire
$UserIDBenef = mysqli_query($conn, "SELECT UserID
        from compte
        Where compteID ='".$_POST['selectBenef']."' ");

$userID1 = mysqli_fetch_array($UserIDBenef); // on va chercher le résultat de la query $compteID
$userID2 = $userID1['UserID'];

$insertMontant = $_POST['montant']; // on récupère ce que l'user a mis dans le input montant et on le stocke dans une variable pour l'utiliser plus tard
$insertLibelle = $_POST['libelle'];
$insertBenef = $_POST['selectBenef']; //compte du benef
$insertEmetteur = $_POST['selectEmetteur'];
         $query = "INSERT INTO operation (montant, UserID,libelleOperation,compteID_debiteur,compteID_crediteur ) VALUES ('$insertMontant', '$userID6', '$insertLibelle','$insertEmetteur', '$insertBenef' )";
        $stmt = mysqli_query($conn, $query);

        $query1 = "UPDATE compte SET compteSolde = (compteSolde - $insertMontant)
                WHERE compteID = $insertEmetteur";
        $stmt = mysqli_query($conn, $query1);

        $query3 = "UPDATE compte SET compteSolde = (compteSolde + $insertMontant)
                WHERE compteID = $insertBenef";
        $stmt = mysqli_query($conn, $query3);

        echo "<meta http-equiv='refresh' content='0'>";

        mysqli_close($conn);
 };

// Fonctionnalité faire un débit/crédit sur un seul compte



  if(isset($_POST['insertTransfert-btn'])){

     $typeOperation = $_POST['selectTypeOperation'];

   
        if($typeOperation == debit) {

        $query = "INSERT INTO operation (montant, UserID,libelleOperation,compteID_debiteur,compteID_crediteur ) VALUES ('$insertMontant', '$userID2', '$insertLibelle','$insertBenef', '0' )";
        $stmt = mysqli_query($conn, $query);

        $query4 = "UPDATE compte SET compteSolde = (compteSolde - $insertMontant)
        WHERE compteID = $insertBenef";
        $stmt = mysqli_query($conn, $query4);

        } 

        if($typeOperation == credit ){

        $query = "INSERT INTO operation (montant, UserID, libelleOperation, compteID_debiteur, compteID_crediteur ) VALUES ('$insertMontant', '$userID2', '$insertLibelle', '0', '$insertBenef' )";
        $stmt = mysqli_query($conn, $query);

         $query5 = "UPDATE compte SET compteSolde = (compteSolde + $insertMontant)
                WHERE compteID = $insertBenef";
        $stmt = mysqli_query($conn, $query5);

    }

        echo "<meta http-equiv='refresh' content='0'>";


        mysqli_close($conn);
 };

 // Fonctionnalité : valider les bénéficiaires dont le statut est à zero

$result5 = mysqli_query($conn, "SELECT U.UserID, U.username, U.userprenom, B.Rib, B.dateAjoutBeneficiaire, B.beneficiaireStatus, B.estBeneficiaireID
        FROM user U, estBeneficiaire B
        Where U.UserID = B.UserID 
        and beneficiaireStatus ='0'
        ");


 if(isset($_POST['validerBeneficiaire-btn']) ){
    if(!empty($_POST['identityUser'])) {
        foreach($_POST['identityUser'] as $check) {
        $query7 = "UPDATE estBeneficiaire SET beneficiaireStatus = '1'
        WHERE estBeneficiaireID = $check";
        $stmt = mysqli_query($conn, $query7);
    }
}

        echo "<meta http-equiv='refresh' content='0'>";


        mysqli_close($conn);
 };



?>



