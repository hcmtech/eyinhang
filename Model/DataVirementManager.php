<?php 
    require_once("Model/Manager.php");
    //connexion à la db + requetes mySQL pour récuperer l'hirstorique debit credit

    // $_SESSION['UserID'] = $user['UserID'];
    // $_SESSION['email'] = $user['email'];
    // $_SESSION['username'] = $user['username'];
    // $_SESSION['userprenom'] = $user['userprenom'];
    // $_SESSION['adresse'] = $user['adresse'];
    // $_SESSION['ville'] = $user['ville'];
    // $_SESSION['codepostale']= $user['codepostale'];
    // $_SESSION['numerotel']= $user['numerotel'];
    // $_SESSION['verified'] = $user['verified'];

     
    class DataVirementManager extends Manager{
        //COMPTE COURANT 
        public function operationUser(){
            $db = $this->dbConnect();
            $virements = $db->prepare('SELECT * FROM operation WHERE user_debiteur = :userDebiteur OR user_crediteur = :userDebiteur ORDER BY dateOperation DESC');
            $virements->execute(array(
                'userDebiteur' => $_SESSION['UserID'],
                'userCrediteur' => $_SESSION['UserID']
                ));

            return $virements;
        }

         //AFFICHER UNE LISTE BENEFICIAIRES
         public function listeBeneficiaires(){
            $db = $this->dbConnect();
            $benef = $db->prepare('SELECT u.username username, u.userprenom  userprenom, eB.Rib Rib, c.* FROM estBeneficiaire eB
                                    JOIN compte c
                                        ON eB.Rib = c.Rib
                                    JOIN user u
                                        ON c.UserID = u.UserID
                                    WHERE eB.userID = :userID'
                                        );
            $benef->execute(array(
                'userID' => $_SESSION['UserID'],
                ));

            return $benef;
        }

        public function CompteUser(){
            $db = $this->dbConnect();
            $CompteInfo = $db->prepare('SELECT CO.compteSolde compteSolde, CO.autorisationDecouvert autorisationDecouvert
        FROM Compte CO
        JOIN user u
            ON CO.UserID = u.UserID
        Where CO.UserID=:UserID');
            $CompteInfo->execute(array(
       'userID' => $_SESSION['UserID'],
                ));


            return $CompteUser;
        }

        //AJOUTER UN BENEFICIAIRE
        public function addBeneficiaire($userID, $rib)
		{
			$db = $this->dbConnect();
            $beneficiaire = $db->prepare('INSERT INTO estBeneficiaire(userID, dateAjoutBeneficiaire, beneficiaireStatus, Rib) VALUES(?, NOW(), 1, ?)');
            $beneficiaire->execute(array($userID, $rib));

            return $beneficiaire;
		}


    }

    // //VIREMENT 
    // function virement($creditUser, $montant, $descritpion){
    //     //recuperer le solde du debiteur + màj operation 
    //     $soldeDebiteur = $conn->prepare('SELECT solde FROM tableUser WHERE UserId = :userId');
    //     $soldeDebiteur->execute(array(
    //             'userId' => $user_ID
    //     ));
    //     $opSoldeDebiteur = $soldeDebiteur - $montant;

    //     //recuperer le solde du crediteur + màj operation
    //     $soldeCrediteur = $conn->prepare('SELECT solde FROM tableUser WHERE UserId = :userId');
    //     $soldeCrediteur->execute(array(
    //             'userId' => $creditUser
    //     ));
    //     $opSoldeCrediteur = $soldeCrediteur + $montant;

    //     // $operationCrediteur = $conn->prepare('SELECT * FROM operation WHERE user_debiteur = ? && user_crediteur = ? ORDER BY date_montant DESC');
    //     // $operationCrediteur->execute(array($user_ID));


    //     //compte à crediter
    //     $virements = $conn->prepare('UPDATE solde = :solde FROM tableUser WHERE UserID = :UserId');
    //     $virements->execute(array(
    //             'solde' => $opSoldeCrediteur,
    //             'UserID' => $creditUser
    //     ));


    //     //compte à debiter (user Actuel)
    //     $virements = $conn->prepare('UPDATE solde = :solde FROM tableUser WHERE UserID = :UserId');
    //     $virements->execute(array(
    //             'solde' => $opSoldeDebiteur,
    //             'UserID' => $user_ID
    //     ));

    //     // MàJ operation
    //     $operationDebiteur = $conn->prepare('INSERT INTO operation(id_debiteur, id_crediteur, montant, descritpion, date_transaction) VALUES(?, ?, ?, ?, NOW())');
    //     $operationDebiteur->execute(array($user_ID, $creditUser, $montant, $descritpion
    //         ));
    // }

    // //solde actuelle de UserId
    // function soldeUser(){
    //     $solde = $conn->prepare('SELECT solde FROM operation WHERE UserId = ?');
    //     $solde->execute(array($userId));

    //     return $solde;
        
    // }