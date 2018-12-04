CREATE TABLE admin(
adminID int auto_increment,
login varchar(25) NOT NULL,
adminPassword char(40) character set ascii not null,
CONSTRAINT PK_admin PRIMARY KEY (adminID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;;


CREATE TABLE user(
userID int auto_increment,
username varchar(25) NOT NULL,
userprenom varchar(25) NOT NULL,
adresse varchar(50) NOT NULL,
ville varchar(20) NOT NULL,
codepostale varchar(5) NOT NULL,
numerotel varchar(10) NOT NULL,
email varchar(255) NOT NULL,
Password varchar(255) NOT NULL,
CONSTRAINT PK_user PRIMARY KEY (userID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE estBeneficiaire(
estBeneficiaireID int auto_increment,
userID int not null,
beneficiaireID int not null,
dateAjoutBeneficiaire timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
CONSTRAINT PK_beneficiaire PRIMARY KEY (estBeneficiaireID),
CONSTRAINT FK_beneficiaireID FOREIGN KEY (beneficiaireID) REFERENCES user
(userID),
CONSTRAINT FK_user FOREIGN KEY (userID) REFERENCES user
(userID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE typeCompte (
typeCompteID int auto_increment,
typeCompteLibelle varchar(30),
CONSTRAINT PK_typeCompte PRIMARY KEY (typeCompteID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE compte(
compteID int auto_increment,
compteSolde decimal(11,2) NOT NULL DEFAULT '0.00',
compteDateOuverture timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
Rib varchar(64) NOT NULL,
autorisationDecouvert boolean DEFAULT NULL,
limiteDecouvert int(11) DEFAULT '500',
userID int NOT NULL,
typeCompteID int not null,
CONSTRAINT PK_compte PRIMARY KEY (compteID),
CONSTRAINT FK_userID FOREIGN KEY (userID) REFERENCES user
(userID),
CONSTRAINT FK_typeCompteID FOREIGN KEY (typeCompteID) REFERENCES typeCompte
(typeCompteID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE operation (
operationID int auto_increment,
debiteurID int not null,
crediteurID int not null,
compteSolde decimal(11,2) NOT NULL DEFAULT '0.00',
montant decimal(11,2),
dateOperation timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
libelleOperation SET("Chèque", "CB", "Virement"),
descriptionOperation text,
description varchar (15),
compteID int not null,
CONSTRAINT PK_operation PRIMARY KEY (operationID),
CONSTRAINT FK_compte FOREIGN KEY (CompteID) REFERENCES compte
(compteID)
CONSTRAINT FK_debiteurID FOREIGN KEY (debiteurID) REFERENCES user
(userID)
CONSTRAINT FK_crediteurID FOREIGN KEY (crediteurID) REFERENCES user
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE cb (
cbID int auto_increment,
numCb varchar(16) not null,
compteID int not null,
CONSTRAINT PK_cb PRIMARY KEY (cbID),
CONSTRAINT FK_compteID FOREIGN KEY (compteID) REFERENCES compte
(compteID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE estOperationCb (
	estOperationCbID int auto_increment,
	operationID int not null,
	cbID int not null,
	CONSTRAINT PK_estOperationCbID PRIMARY KEY (estOperationCbID),
	CONSTRAINT FK_operationID FOREIGN KEY (operationID) REFERENCES operation
	(operationID),
	CONSTRAINT FK_cbID FOREIGN KEY (cbID) REFERENCES cb
	(cbID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE chequier (
chequierID int auto_increment,
envoiChequier boolean NOT NULL DEFAULT '0',
dateEnvoiChequier datetime NOT NULL,
userID int not null,
CONSTRAINT PK_chequier PRIMARY KEY (chequierID),
CONSTRAINT FK_chequier FOREIGN KEY (userID) REFERENCES user
(userID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE depotCheque (
chequeID int auto_increment,
dateDepotCheque datetime NOT NULL,
chequierID int not null,
compteID int not null,
CONSTRAINT PK_depotCheque PRIMARY KEY (chequeID),
CONSTRAINT FK_chequierID FOREIGN KEY (chequierID) REFERENCES chequier
(chequierID),
CONSTRAINT FK_compteID1 FOREIGN KEY (compteID) REFERENCES compte
(compteID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE estOperationCheque (
	estOperationChequeID int auto_increment,
	operationID int not null,
	chequeID int not null,
	CONSTRAINT PK_estOperationChequeID PRIMARY KEY (estOperationChequeID),
	CONSTRAINT FK_operationID1 FOREIGN KEY (operationID) REFERENCES operation
	(operationID),
	CONSTRAINT FK_chequeID FOREIGN KEY (chequeID) REFERENCES depotCheque
	(chequeID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO typeCompte (typeCompteLibelle)
VALUES ('Compte Courant'),
('Compte Épargne')


INSERT INTO compte (rib, userID, typeCompteID)
VALUES (FR123232331231231, 1, 1)
VALUES (FR123232331231231, 1, 2)
