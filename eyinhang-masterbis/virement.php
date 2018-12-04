<!-------------- CONNEXION DB  ---------------->
<?php


    //connexion à la db + requetes mySQL pour récuperer l'operation / historique debit credit
    $conn = new mysqli('localhost', 'root', 'root', 'bank');
	 //La case code est vide, en mettre un si dans phpmyadmin vous en avez configuré un

    //$user_ID = $_SESSION['UserID'];


    //lignes dans table operation où l'UserId = debiteurID
    // NE PAS OUBLIER DE FAIRE UN INNER JOIN
  //  function OperationUser(){
        //$virements = $conn->prepare('SELECT * FROM operation WHERE debiteurID = ? && crediteurID = ? ORDER BY date_montant DESC');
        //$virements->execute(array($user_ID));

        //return $virements;

    //}

    //VIREMENT
    function virement($crediteurID, $montant, $description){
        //recuperer le solde du debiteur + màj historique
        $soldeDebiteur = $conn->prepare('SELECT compteSolde FROM operation WHERE userId = :userID');
        $soldeDebiteur->execute(array(
                'userID' => $debiteurID
        ));
        $opSoldeDebiteur = $soldeDebiteur - $montant;

        //recuperer le solde du crediteur + màj historique
        $soldeCrediteur = $conn->prepare('SELECT compteSolde FROM operation WHERE userId = :userID');
        $soldeCrediteur->execute(array(
                'userID' => $crediteurID
        ));
        $opSoldeCrediteur = $soldeCrediteur + $montant;

        // $historiqueCrediteur = $conn->prepare('SELECT * FROM operation WHERE $debiteurID = ? && crediteurID = ? ORDER BY date_montant DESC');
        // $historiqueCrediteur->execute(array($user_ID));


        //compte à crediter
        $virements = $conn->prepare('UPDATE compteSolde = :compteSolde FROM operation WHERE userId = :userID');
        $virements->execute(array(
                'compteSolde' => $opSoldeCrediteur,
                'userID' => $crediteurID
        ));


        //compte à debiter (user Actuel)
        $virements = $conn->prepare('UPDATE solde = :solde FROM tableUser WHERE UserID = :UserId');
        $virements->execute(array(
                'solde' => $opSoldeDebiteur,
                'userID' => $user_ID
        ));

        // MàJ historique
        $historiqueDebiteur = $conn->prepare('INSERT INTO operation (debiteurID, crediteurID, montant, description, dateOperation) VALUES(2, 3, 2, 3, NOW())');
        $historiqueDebiteur->execute(array($user_ID, $crediteurID, $montant, $description
            ));
    }

    //solde/balance actuelle de UserId
    function soldeUser(){
        $solde = $conn->prepare('SELECT compteSolde FROM operation WHERE userId = ?');
        $solde->execute(array($userId));

        return $solde;

    }

    //$lignesOperation = historiqueUser();

?>
