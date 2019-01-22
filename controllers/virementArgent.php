<?php include 'controllers/authController.php' ?>
<?php 

 // Dans cette requête, je récupère les données du bénéficiaire, le créditeur.
$result = mysqli_query($conn,"SELECT B.userBeneficiaire, U.username, U.userprenom, CO.Rib, B.beneficiaireStatus, CO.compteID
        from user U, estBeneficiaire B, compte CO
        Where B.UserID ='".$_SESSION['UserID']."'
        and B.userBeneficiaire = U.UserID
        and B.userBeneficiaire = CO.UserID
        and B.beneficiaireStatus = '1'
        ");

// Dans cette requête, je récupère seulement les virements que fait l'user connecté. 
$result2 = mysqli_query($conn,"SELECT O.montant, O.dateOperation, O.libelleOperation, O.compteID_crediteur, O.compteID_debiteur, CO.typeCompteID, TC.typeCompteLibelle, U.username, U.userprenom
        from operation O, compte CO, typeCompte TC, user U
        Where U.UserID = '".$_SESSION['UserID']."'
        and  U.UserID = O.UserID
        and O.UserID = '".$_SESSION['UserID']."'
        and CO.compteID = O.compteID_debiteur
        and CO.typeCompteID = TC.typeCompteID
        ORDER BY O.dateOperation DESC
        ");

// Dans cette requête, je récupère tous les comptes (courant et épargne) de l'user connecté
$result3 = mysqli_query($conn,"SELECT CO.compteID, CO.typeCompteID, CO.compteSolde, TC.typeCompteLibelle, CO.Rib
        from user U, compte CO, typeCompte TC
        Where U.UserID = '".$_SESSION['UserID']."'
        and CO.UserID = '".$_SESSION['UserID']."'
        and CO.typeCompteID = TC.typeCompteID
        ");







$userIDConn = $_SESSION['UserID']; // UserID de l'user connecté



 if(isset($_POST['insertMontant-btn'])){
        //Chercher le compteID du bénéficiaire
        $UserIDBenef = mysqli_query($conn, "SELECT CO.UserID
                from compte CO
                Where CO.compteID='".$_POST['selectBenef']."'
                ");

        $compteID3 = mysqli_fetch_array($userIDBenef); // on va chercher le résultat de la query $userIDBenef
        $compteID4 = $compteID3['UserID']; // on stocke l'affichage du résultat dans une variable
            // on va récupérer ce que l'user insert dans les champs lorqu'il fait son virement
        $insertMontant = $_POST['montant']; // on récupère ce que l'user a mis dans le input montant et on le stocke dans une variable pour l'utiliser plus tard
        $insertLibelle = $_POST['libelle'];
        $insertEmet = $_POST['selectCompte'];
        $insertBenef = $_POST['selectBenef']; // compteID du bénéficiaires  

         $query = "INSERT INTO operation (montant, libelleOperation, UserID, compteID_debiteur,compteID_crediteur ) VALUES ('$insertMontant', '$insertLibelle', '".$_SESSION['UserID']."', '$insertEmet', '$insertBenef')";
        $stmt = mysqli_query($conn, $query);

        $query1 = "UPDATE compte SET compteSolde = (compteSolde - $insertMontant)
                WHERE compteID = $insertEmet";
        $stmt = mysqli_query($conn, $query1);

        $query3 = "UPDATE compte SET compteSolde = (compteSolde + $insertMontant)
                WHERE compteID = $insertBenef
                ";

        $stmt = mysqli_query($conn, $query3);

        echo "<meta http-equiv='refresh' content='0'>";


        mysqli_close($conn);
 };



?>




