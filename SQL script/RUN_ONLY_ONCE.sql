DROP DATABASE IF EXISTS billViewerDB;

CREATE DATABASE billViewerDB;
USE billViewerDB;

DROP TABLE IF EXISTS company;
DROP TABLE IF EXISTS bill;
DROP TABLE IF EXISTS recipient;
DROP TABLE IF EXISTS account;

CREATE TABLE company
(
	companyID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	companyName VARCHAR(40),
	companyDescription VARCHAR(255),	-- reason for paying bill ie/ telephone service
	companyContactInfo VARCHAR(50)
);

CREATE TABLE recipient
(
	recipientID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	recipientFirstName VARCHAR(20),
	recipientLastName VARCHAR (20)
);

CREATE TABLE account
(
	accountID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	accountNumber VARCHAR(30),
	accountNote VARCHAR(255),
	accountRegisterDate DATE,
	companyID INT,
	recipientID INT,
	FOREIGN KEY (companyID) REFERENCES company(companyID),
	FOREIGN KEY (recipientID) REFERENCES recipient(recipientID)
	
);

CREATE TABLE bill
(
	billID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	billAmount DECIMAL(10, 2),
	billDate DATE,
	billNote VARCHAR(255) DEFAULT "",
	accountID INT,
	FOREIGN KEY (accountID) REFERENCES account(accountID)
);

CREATE USER 'billViewerUser' IDENTIFIED BY 'bvPass';
GRANT ALL ON billViewerDB.* TO 'billViewerUser';