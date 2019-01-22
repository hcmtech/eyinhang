<?php include 'controllers/authController.php' ?>

<?php 

$result = mysqli_query($conn, "SELECT U.username, CO.compteSolde, CO.autorisationDecouvert, CO.typeCompteID
        FROM user U, Compte CO
        Where U.UserID='".$_SESSION['UserID']."'
        and CO.UserID='".$_SESSION['UserID']."'");

// j'affiche les infos du compte courant de l'user connecté
$result1 = mysqli_query($conn, "SELECT U.username, CO.compteSolde, CO.autorisationDecouvert, CO.typeCompteID
        FROM user U, Compte CO
        Where U.UserID='".$_SESSION['UserID']."'
        and CO.UserID='".$_SESSION['UserID']."'
        and CO.typeCompteID = '1'");

$result12 = mysqli_query($conn, "SELECT U.username, CO.compteSolde, CO.autorisationDecouvert, CO.typeCompteID, CO.limiteDecouvert
        FROM user U, Compte CO
        Where U.UserID='".$_SESSION['UserID']."'
        and CO.UserID='".$_SESSION['UserID']."'
        and CO.typeCompteID = '1'");

// j'affiche les infos du compte épargne de l'user connecté
$result11 = mysqli_query($conn, "SELECT U.username, CO.compteSolde, CO.autorisationDecouvert, CO.typeCompteID
        FROM user U, Compte CO
        Where U.UserID='".$_SESSION['UserID']."'
        and CO.UserID='".$_SESSION['UserID']."'
        and CO.typeCompteID = '2'");

// j'affiche les opérations de l'user connecté

$result3 = mysqli_query($conn, "SELECT U.username, u.userprenom, CO.typeCompteID, O.montant, O.libelleOperation, O.dateOperation, TC.typeCompteLibelle
        FROM user U, Compte CO, operation O, typeCompte TC
        Where O.user_debiteur = '".$_SESSION['UserID']."'
        or O.user_crediteur = '".$_SESSION['UserID']."'
        and CO.typeCompteID = TC.typeCompteID");

// Fonctionnalité chéquier : Quand je clique sur le bouton faire une demande de chéquier, ma demande est envoyée au back office pour que l'admin puisse valider
$result2 = mysqli_query($conn, "SELECT C.envoiChequier, C.dateEnvoiChequier, C.demandeChequier, C.dateDemandeChequier, C.envoiChequier, C.dateEnvoiChequier
		FROM user U, chequier C
		Where U.UserID='".$_SESSION['UserID']."'
        and C.UserID='".$_SESSION['UserID']."'");

 if(isset($_POST['demandeChequier-btn'])){
 	 $query = "UPDATE chequier SET demandeChequier='1', dateDemandeChequier=now() where UserID='".$_SESSION['UserID']."'";
        $stmt = $conn->prepare($query);
        $result = $stmt->execute();
    echo "<meta http-equiv='refresh' content='0'>";
    mysqli_close($conn);
    }


// pour la page compte courant, je récupère les opérations : les virements qu'on m'a fait + les virements que j'ai fait 

$compteID = mysqli_query($conn, "SELECT CO.compteID
        from user U, compte CO
        Where CO.UserID='".$_SESSION['UserID']."'
        and U.UserID='".$_SESSION['UserID']."'
        ");

$compteID1 = mysqli_fetch_array($compteID); // on va chercher le résultat de la query $compteID
$compteID2 = $compteID1['compteID']; // on stocke l'affichage du résultat dans une variable

$result8 = mysqli_query($conn, "SELECT montant, dateOperation, libelleOperation, compteID_debiteur, compteID_crediteur
FROM operation
WHERE UserID = '".$_SESSION['UserID']."'
AND (compteID_debiteur = $compteID2
OR compteID_crediteur = $compteID2)
ORDER BY dateOperation DESC
");

// Fonctionnalité bénéficiaire : Ajouter un bénéficiaire
// afficher les bénéficiaires validés d'un user
$result4 = mysqli_query($conn, "SELECT U.UserID, U.username, U.userprenom, B.Rib, B.dateAjoutBeneficiaire, B.beneficiaireStatus
        FROM user U, estBeneficiaire B
        Where B.userID='".$_SESSION['UserID']."'
        and B.userBeneficiaire = U.UserID 
        and beneficiaireStatus ='1'");

//afficher les bénéficiaires non validés par l'admin ajoutés par l'user
$result5 = mysqli_query($conn, "SELECT U.UserID, U.username, U.userprenom, B.Rib, B.dateAjoutBeneficiaire, B.beneficiaireStatus
        FROM user U, estBeneficiaire B
        Where U.UserID='".$_SESSION['UserID']."'
        and B.UserID='".$_SESSION['UserID']."'
        and U.UserID = B.UserID 
        and beneficiaireStatus ='0'");

//stocker la session de l'user
$userID = $_SESSION['UserID'];
    
// Lorsque l'user clique sur le bouton pour ajouter des bénéficiaires, si l'iban rentré
 if(isset($_POST['insertIBAN-btn'])){
    // récupérer la valeur de l'iban rentré par l'user
    $insertIBAN = $_POST['insertIBAN'];
    // vérifier que l'IBAN existe dans la table compte
    $IBANcheck = "SELECT Rib FROM compte WHERE Rib='$insertIBAN' LIMIT 1"; //je compare les rib dans ma base de données et celle que j'ai rentré dans interface
    $resultIBANcheck = mysqli_query($conn, $IBANcheck);

     if (mysqli_num_rows($resultIBANcheck) == 1) { 
        $query1 = mysqli_query($conn, "SELECT CO.UserID 
                                        from compte CO
                                        WHERE $insertIBAN = CO.Rib");
        $result7 = mysqli_fetch_array($query1);
        $userBeneficiaire = $result7['UserID'];
        $query2 = mysqli_query($conn, "INSERT INTO estBeneficiaire (userID, dateAjoutBeneficiaire, beneficiaireStatus, Rib, userBeneficiaire) VALUES ($userID, now(), '0',$insertIBAN, $userBeneficiaire) ");

    } else {
        echo "<p> Cet IBAN n'existe pas.</p>";
    }

    echo "<meta http-equiv='refresh' content='0'>";
    mysqli_close($conn);
    };


// Créer un compte épargne

if(isset($_POST['createCompteEpargne-btn'])){
     $query = "INSERT INTO compte (compteSolde, compteDateOuverture, Rib, autorisationDecouvert, limiteDecouvert, UserID, typeCompteID) VALUES ('0', now(), ROUND(RAND() * 99999999999999),'Pas autorisé', '0',$userID,'2') ";
        $stmt = $conn->prepare($query);
        $result = $stmt->execute();
    echo "<meta http-equiv='refresh' content='0'>";
    echo "<script> alert('Votre compte épargne a bien été créé.'); </script>";

    mysqli_close($conn);
    }

      
?>



