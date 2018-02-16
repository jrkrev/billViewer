DROP DATABASE IF EXISTS bdDB_;

CREATE DATABASE bdDB_;
USE bdDB_;

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



-- dummy data

INSERT INTO company (companyName, companyDescription) VALUES 
("Company A", "A great company inspired by the letter A"),
("Company B", "Another company"),
("Company C", "A third");

INSERT INTO recipient VALUES
(NULL, "John", "Doe"),
(NULL, "Joe", "Smith");

INSERT INTO account VALUES
(NULL, "231231-12", "no note", CURRENT_DATE, 1, 1),
(NULL, "231322abc", "no note", CURRENT_DATE, 2, 2);

INSERT INTO bill VALUES
(NULL, 25.25, '2017-01-24', "pay this", 1),
(NULL, 22.00, '2017-01-23', "aa", 2),
(NULL, 40, '2017-02-08', NULL, 2);
