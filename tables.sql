CREATE DATABASE Project;
USE Project;
DROP DATABASE Project;

/*
====================================================================
 Person
====================================================================
*/

CREATE TABLE Person(
id INT AUTO_INCREMENT,
firstName VARCHAR(100),
middleInitial varchar(100),
lastName VARCHAR(100),
dateOfBirth DATE,
telephoneNumber INT,
address VARCHAR(100),
city VARCHAR(100),
province ENUM('NL','PE','NS','NB','QC','ON','MB','SK','AB','BC','YT','NT','NU'),
postalCode VARCHAR(6),
citizenship VARCHAR(100),
emailAddress VARCHAR(100),
ageGroupID INT,
PRIMARY KEY(id),
FOREIGN KEY (ageGroupID) REFERENCES AgeGroup(groupID)
);
#("80+"), 1
#("70-79"), 2 
#("60-69"), 3
#("50-59"), 4
#("40-49"), 5
#("30-39"), 6
#("18-29"), 7
#("12-17"), 8
#("5-11"), 9
#("0-4"); 10
INSERT INTO Person (firstName, middleInitial, lastName, dateOfBirth, telephoneNumber, address, city, province, postalCode, citizenship, emailAddress, ageGroupID) 
VALUES ("John", "A", "Smith", '1990-01-01', 000000, '100 Guy Street', 'Montreal', 'QC', 'A1A1A1', 'Canadian', 'john.smith@gmail.com', 6),
("Mark", "B", "Julius", '1987-10-23', 111111, '200 Maisonneuve Street', 'Almaty', 'NB', 'B1B1B1', 'Kazakhastanian', 'mark.julius@gmail.com', 5),
("Jackie", "C", "Chan", '2000-03-30', 222222, '1980 Norman Street', 'Kawasaki', 'NL', 'C1C1C1', 'Japanese', 'jackie.chan@gmail.com', 7),
("Bruce","D", "Lee", '2021-09-01', 333333, '3475 De la montagne Street', 'Bandung', 'PE', 'D1D1D1', 'Indian', 'bruce.goerge@gmail.com', 10),
("King", "E","George", '1960-03-20', 444444, '5000 Peel Street', 'Sapporo', 'NS', 'E1E1E1', 'Japanese', 'king.george@gmail.com', 3),
("Vanilla","F", "Ice", '1975-01-01', 555555, '2001 Dutrisac Street', 'Baghdad', 'ON', 'F1F1F1', 'Indian', 'vanilla.ice@gmail.com', 5),
("Rock", "G","Lee", '2003-11-10', 666666, '1111 Fillion Street', 'Shiraz', 'MB', 'G1G1G1', 'Iranian', 'rock.lee@gmail.com', 7),
("Black","H", "Reaper", '2017-01-01', 777777, '908 Deguire Street', 'Praque', 'SK', 'H1H1H1', 'Czechinians', 'black.reaper@gmail.com', 10),
("Naruto","I", "Uzumaki", '1974-10-28', 888888, '743 Cleroux Street', 'Kathmandu', 'AB', 'I1I1I1', 'Nepalian', 'naruto.uzumaki@gmail.com', 5),
("Monkey", "J","Luffy", '2011-12-02', 999999, '1111 Sherbrook Street', 'Yokohama', 'YT', 'J1J1J1', 'Japanese', 'monkey.luffy@gmail.com', 9),
("John","K", "Cena", '1980-01-01', 100000, '101 Guy Street', 'Montreal', 'QC', 'K1K1K1', 'Canadian', 'john.cena@gmail.com', 5),
("Xin","L", "Lu", '1977-10-23', 211111, '201 Maisonneuve Street', 'Almaty', 'NB', 'L1L1L1', 'Kazakhastanian', 'xin.lu@gmail.com', 5),
("Spongebob","M", "Squarepants", '1990-03-30', 322222, '1981 Norman Street', 'Kawasaki', 'NL', 'M1M1M1', 'Japanese', 'spongebob.squarepants@gmail.com', 6),
("Sanji","N", "Blackleg", '2011-09-01', 433333, '3476 De la montagne Street', 'Bandung', 'PE', 'N1N1N1', 'Indian', 'Sanji.Blackleg@gmail.com', 9),
("Black","O", "Beard", '1950-03-20', 544444, '5001 Peel Street', 'Sapporo', 'NS', 'O1O1O1', 'Japanese', 'black.beard@gmail.com', 2),
("Junior","P", "Desolo", '1965-01-01', 655555, '2002 Dutrisac Street', 'Baghdad', 'ON', 'P1P1P1', 'Indian', 'junior.desolo@gmail.com', 4),
("Adrien","Q", "Burns", '1993-11-10', 766666, '1112 Fillion Street', 'Shiraz', 'MB', 'Q1Q1Q1', 'Iranian', 'adrien.burns@gmail.com', 7),
("Tala","R", "Sleeman", '2007-01-01', 877777, '909 Deguire Street', 'Praque', 'SK', 'R1R1R1', 'Czechinians', 'tala.sleeman@gmail.com', 8),
("Malek","S", "Jerbi", '1964-10-28', 988888, '744 Cleroux Street', 'Kathmandu', 'AB', 'S1S1S1', 'Nepalian', 'malek.jerbi@gmail.com', 4),
("Hercules","T", "DeGreece", '2001-12-02', 099999, '1112 Sherbrook Street', 'Yokohama', 'YT', 'T1T1T1', 'Japanese', 'Hercules.degreece@gmail.com', 7),
("Jimmy","U", "Neutron", '1970-01-01', 110000, '102 Guy Street', 'Montreal', 'QC', 'U1U1U1', 'Canadian', 'jimmy.neutron@gmail.com', 4),
("Crocodile","V", "Nini", '1967-10-23', 221111, '202 Maisonneuve Street', 'Almaty', 'NB', 'V1V1V1', 'Kazakhastanian', 'crocodile.nini@gmail.com', 4),
("Ali","W", "Dawah", '1980-03-30', 332222, '1982 Norman Street', 'Kawasaki', 'NL', 'W1W1W1', 'Japanese', 'ali.dawah@gmail.com', 5),
("Mohammed","X", "Hijad", '2001-09-01', 433333, '3477 De la montagne Street', 'Bandung', 'PE', 'X1X1X1', 'Indian', 'mohammed.hijad@gmail.com', 7),
("Ragnar","Y", "Lothbrok", '1950-01-01', 554444, '5002 Peel Street', 'Sapporo', 'NS', 'A2A2A2', 'Japanese', 'ragnar.lothbrok@gmail.com', 2),
("Younes","Z", "Garbili", '1955-01-01', 665555, '2003 Dutrisac Street', 'Baghdad', 'ON', 'B2B2B2', 'Indian', 'younes.garbili@gmail.com', 3),
("Jean-Francois","A", "Vo", '1983-11-10', 776666, '1113 Fillion Street', 'Shiraz', 'MB', 'C2C2C2', 'Iranian', 'jeanfrancois.vo@gmail.com', 6),
("Emilio","B", "Sanchez", '1997-01-01', 887777, '910 Deguire Street', 'Praque', 'SK', 'D2D2D2', 'Czechinians', 'emilio.sanchez@gmail.com', 7),
("Gustave","C", "Americ", '1954-10-28', 998888, '745 Cleroux Street', 'Kathmandu', 'AB', 'E2E2E2', 'Nepalian', 'gustave.americ@gmail.com', 3),
("Hermes","D", "Lefameux", '1991-12-02', 009999, '1113 Sherbrook Street', 'Yokohama', 'YT', 'F2F2F2', 'Japanese', 'Hermes.Lefameux@gmail.com', 6);
#("80+"), 1
#("70-79"), 2 
#("60-69"), 3
#("50-59"), 4
#("40-49"), 5
#("30-39"), 6
#("18-29"), 7
#("12-17"), 8
#("5-11"), 9
#("0-4"); 10
SELECT * FROM Person;

DROP TABLE Person;

/*
====================================================================
 Registered Person
====================================================================
*/

CREATE TABLE Registered(
id INT,
medicareCardNum INT AUTO_INCREMENT,
medicareIssueDate DATE,
medicareExpiryDate DATE,
PRIMARY KEY (medicareCardNum),
FOREIGN KEY (id) REFERENCES Person(id)
);
INSERT INTO Registered (id, medicareIssueDate, medicareExpiryDate)
VALUES(1, '1990-01-01','2040-01-01'),
(2,'1987-10-23', '2037-10-23'),
(3, '2000-03-30', '2050-03-30'),
(4, '2021-09-01', '2071-09-01'),
(5, '1960-03-20', '2022-03-20'),
(6, '1975-01-01', '2025-01-01'),
(7, '2003-11-10', '2053-11-10'),
(8, '2017-01-01', '2067-01-01'),
(9, '1974-10-28', '2024-10-28'),
(10, '2011-12-02', '2011-12-02'),
(21, '1970-01-01', '2025-01-01'),
(22, '1967-10-23', '2025-10-23'),
(23, '1980-03-30', '2030-03-30'),
(24, '2001-09-01', '2051-09-01'),
(25, '1950-01-01', '2025-01-01'),
(26, '1955-01-01', '2025-01-01'),
(27, '1983-11-10', '2033-11-10'),
(28, '1997-01-01', '2047-01-01'),
(29, '1954-10-28', '2025-10-28'),
(30, '1991-12-02', '2041-12-02');


DROP TABLE Registered;

/*
====================================================================
 Unregistered Person
====================================================================
*/

CREATE TABLE Unregistered(
id INT,
passportNum INT AUTO_INCREMENT,
PRIMARY KEY (passportNum),
FOREIGN KEY (id) REFERENCES Person(id)
);

INSERT INTO Unregistered(id)
VALUES (11),(12),(13),(14),(15),(16),(17),(18),(19),(20);

SELECT * FROM Unregistered;

DROP TABLE Unregistered;
/*
====================================================================
 Age Group
====================================================================
*/

CREATE TABLE AgeGroup(
groupID int AUTO_INCREMENT,
groupDescription VARCHAR(20),
PRIMARY KEY (groupID));

INSERT INTO AgeGroup (groupDescription)
VALUES ("80+"), 
("70-79"), 
("60-69"), 
("50-59"), 
("40-49"), 
("30-39"), 
("18-29"), 
("12-17"), 
("5-11"), 
("0-4");

SELECT * FROM AgeGroup;

DROP TABLE AgeGroup;
/*
====================================================================
 Infection History
====================================================================
*/

CREATE TABLE InfectionHistory(
personID INT,
infectionDate DATE,
PRIMARY KEY (personID, infectionDate),
FOREIGN KEY (personID) REFERENCES Person(id)
);

INSERT INTO InfectionHistory(personID, infectionDate)
VALUES(6,'2020-10-10'),(16,'2020-09-09'),(19, '2020-08-08'),(8, '2020-07-07'),(9, '2020-06-06'),
(5, '2020-05-05'),(11, '2020-04-04'),(13, '2020-03-03'),(1, '2020-02-02'),(3, '2020-01-01'), (3, '2021-01-01'), (2, '2021-01-01'), (2, '2021-03-01'), (4, '2021-01-01'), (12, '2021-01-01');

SELECT * FROM InfectionHistory;

DELETE FROM InfectionHistory;

DROP TABLE InfectionHistory;
/*
====================================================================
 Health Worker
====================================================================
*/

CREATE TABLE HealthWorker(
workerID INT AUTO_INCREMENT,
id INT,
employeeType ENUM("Nurse", "Manager", "Security", "Secretary", "Regular Employee"),
PRIMARY KEY (workerID),
FOREIGN KEY (id) REFERENCES Person(id)
);

INSERT INTO HealthWorker(id, employeeType)
VALUES(1,'Manager'),(2, 'Nurse'), (3, 'Security'), (4, 'Secretary'),(5, 'Regular Employee'),
(6, 'Nurse'), (7, 'Security'),(8, 'Regular Employee'),(9, 'Nurse'),(10, 'Security'),(21, 'Regular Employee'), 
(22, 'Manager'),(23, 'Manager'),(24, 'Manager'),(25, 'Manager'),(26, 'Manager'),(27, 'Manager'),(28, 'Manager'),
(29, 'Manager'),(30, 'Manager');

SELECT * FROM HealthWorker;

DROP TABLE HealthWorker;

/*
====================================================================
 Health Worker
====================================================================
*/

CREATE TABLE PublicHealthFacilities(
name VARCHAR(100),
address VARCHAR(100),
province ENUM('NL','PE','NS','NB','QC','ON','MB','SK','AB','BC','YT','NT','NU'),
country VARCHAR(100),
phoneNumber INT,
webAddress VARCHAR(100),
facilityType ENUM('HOSPITAL', 'CLINIC', 'SPECIAL INSTALLMENT'),
category ENUM('RESERVATION-ONLY', 'WALKIN-ALLOWED')
capacity INT,
managerID INT,
FOREIGN KEY (managerID) REFERENCES HealthWorker(workerID),
FOREIGN KEY (province) REFERENCES Province(name),
PRIMARY KEY (name)
);

INSERT INTO PublicHealthFacilities(name, address, province, country, phoneNumber, webAddress, facilityType, category, capacity, managerID)
VALUES('A', '1 Elephant street', 'QC', 'Canada', 514111111,'www.a.com', 'HOSPITAL', 'RESERVATION-ONLY', 5000, 1),
('B', '2 Mouse street', 'QC', 'Canada',  514222222,'www.b.com', 'CLINIC', 'WALKIN-ALLOWED', 500, 11),
('C', '3 Cat street', 'QC', 'Canada',  514333333,'www.c.com', 'SPECIAL INSTALLMENT', 'RESERVATION-ONLY', 50, 12),
('D', '4 Dog street', 'BC', 'Canada',  514444444,'www.d.com', 'HOSPITAL', 'RESERVATION-ONLY', 6000, 13),
('E', '5 Bird street', 'BC', 'Canada',  514555555,'www.e.com', 'CLINIC', 'WALKIN-ALLOWED', 600, 14),
('F', '6 Snake street', 'AB', 'Canada',  514666666,'www.f.com', 'SPECIAL INSTALLMENT', 'RESERVATION-ONLY', 60, 15),
('G', '7 Spider street', 'ON', 'Canada',  514777777,'www.g.com', 'HOSPITAL', 'RESERVATION-ONLY', 7000, 16),
('H', '8 Kangoroo street', 'ON', 'Canada',  514888888,'www.h.com', 'CLINIC', 'WALKIN-ALLOWED', 700, 17),
('I', '9 Ant street', 'BC', 'Canada',  514999999,'www.i.com', 'SPECIAL INSTALLMENT', 'RESERVATION-ONLY', 70, 18),
('J', '10 Rabbit street', 'QC', 'Canada',  514000000,'www.j.com', 'HOSPITAL', 'RESERVATION-ONLY', 8000, 19);

SELECT * FROM PublicHealthFacilities;

DROP TABLE PublicHealthFacilities;
/*
====================================================================
 Assignments
====================================================================
*/

CREATE TABLE InfectionTypes(
	name VARCHAR(100),
	PRIMARY KEY (name)
)

INSERT INTO InfectionTypes(name) 
VALUES ("Alpha"),
("Beta"),
("Gamma"),
("Delta"),
("Mu");


DROP TABLE IF EXISTS PublicHealthFacilities;

/*
====================================================================
 Assignments
====================================================================
*/

CREATE TABLE Assignments(
pID INT,
facilityName VARCHAR(100),
startDate DATE,
endDate DATE,
workerID INT AUTO_INCREMENT,
hourlyWage FLOAT,
UNIQUE (workerID, facilityName),
PRIMARY KEY (pID, facilityName, startDate),
FOREIGN KEY (pID) REFERENCES HealthWorker(pID),
FOREIGN KEY (facilityName) REFERENCES PublicHealthFacilities(name)
);

INSERT INTO Assignments(pID, facilityName, startDate, endDate, hourlyWage)
VALUES(1, 'A', '2019-12-12', NULL),
(2, 'B', '2020-01-01', '2020-06-01'),
(3, 'C', '2020-05-13', '2020-10-13'),
(4, 'D', '2020-04-25', '2020-09-25'),
(5, 'E', '2021-01-01', '2021-06-01'),
(6, 'F', '2020-10-10', '2021-03-10'),
(7, 'G', '2020-03-23', '2020-08-23'),
(8, 'H', '2020-07-12', '2020-12-12'),
(9, 'I', '2020-06-11', '2020-11-11'),
(10, 'J', '2020-09-02', '2020-02-02'),
(11, 'B', '2019-12-12', NULL),
(12, 'C', '2020-01-01', NULL),
(13, 'D', '2020-05-13', NULL),
(14, 'E', '2020-04-25', NULL),
(15, 'F', '2021-01-01', NULL),
(16, 'G', '2020-10-10', NULL),
(17, 'H', '2020-03-23', NULL),
(18, 'I', '2020-07-12', NULL),
(19, 'J', '2020-06-11', NULL);

DROP TABLE Assignments;

/*
====================================================================
 ApprovedVaccinations
====================================================================
*/

CREATE TABLE ApprovedVaccinations(
vaccinationName VARCHAR(100),
dateOfApproval DATE,
vaccinationType ENUM("SAFE","SUSPENDED"),
dateOfSuspension DATE,
PRIMARY KEY (vaccinationName)
);

INSERT INTO ApprovedVaccinations(vaccinationName, dateOfApproval, vaccinationType, dateOfSuspension)
 VALUES('AstraZeneca', '2020-10-28', 'SAFE', NULL), ('Pfizer', '2020-06-10', 'SAFE', NULL),
 ('JJ', '2021-01-03', 'SUSPENDED', '2021-02-04'), ('Moderna', '2020-04-04', 'SAFE', NULL),
 ('AZ', '2020-07-28', 'SAFE', NULL), ('PB', '2020-03-10', 'SAFE', NULL),
 ('Astra', '2020-04-28', 'SUSPENDED', '2020-10-18'),('Pfiz', '2020-05-29', 'SUSPENDED', '2020-08-29'),
 ('Johnson & Johnson', '2020-10-03', 'SUSPENDED', '2021-01-14'),('Janssen', '2020-12-12', 'SAFE', NULL),
 ('M.', '2020-06-06', 'SAFE', NULL), ('Mod.', '2020-05-04', 'SUSPENDED', '2020-08-08');
 
 SELECT * FROM ApprovedVaccinations;
 
 DROP TABLE ApprovedVaccinations;
/*
====================================================================
 Vaccinations
====================================================================
*/

CREATE TABLE Vaccinations(
id INT,
workerID INT,
vaccinationName VARCHAR(100),
vaccinationDate DATE,
lotNumber INT,
facilityName VARCHAR(100),
province ENUM('NL','PE','NS','NB','QC','ON','MB','SK','AB','BC','YT','NT','NU'),
country VARCHAR(100),
doseNumber INT,
PRIMARY KEY (id, vaccinationDate),
FOREIGN KEY (id) REFERENCES Person(id),
FOREIGN KEY (workerID, facilityName) REFERENCES Assignments(workerID, facilityName),
FOREIGN KEY (vaccinationName) REFERENCES ApprovedVaccinations(vaccinationName),
FOREIGN KEY (province) REFERENCES Province(name)
);

INSERT INTO Vaccinations(id, workerID, vaccinationName, vaccinationDate, lotNumber, facilityName, province, country, doseNumber)
VALUES(17, 2, 'AstraZeneca', '2020-12-12', 5, 'A', 'QC', 'Canada', 1),
(12, 6, 'AstraZeneca', '2020-08-12', 10, 'B', NULL, 'United States', 1),
(12, 6, 'AstraZeneca', '2020-12-12', 10, 'B', NULL, 'United States', 2),
(22, 9, 'Pfizer', '2020-07-10', 7, 'C', NULL, 'Iran', 1),
(16, 9, 'M.', '2020-11-12', 12, 'D', NULL, 'Iraq', 1),
(16, 9, 'M.', '2020-12-12', 12, 'D', NULL, 'Iraq', 2),
(14, 6, 'Janssen', '2020-12-12', 6, 'E', NULL, 'Lebanon', 1),
(19, 2, 'PB', '2020-11-12', 8, 'F', NULL, 'Syria', 1),
(19, 2, 'PB', '2020-12-12', 8, 'F', NULL, 'Syria', 2),
(7, 2, 'Moderna', '2020-12-12', 9, 'F', NULL, 'Morocco', 1),
(4, 2, 'AZ', '2020-11-12', 11, 'G', NULL, 'Algeria', 1),
(4, 2, 'AZ', '2020-12-12', 11, 'G', NULL, 'Algeria', 2),
(1, 9, 'AstraZeneca', '2020-12-12', 13, 'H', NULL, 'Tunisia', 1),
(2, 9, 'AstraZeneca', '2020-11-12', 14, 'H', 'QC', 'Canada', 1),
(2, 9, 'AstraZeneca', '2020-12-12', 14, 'H', 'BC', 'Canada', 2);

SELECT * FROM Vaccinations;

DELETE FROM Vaccinations;

DROP TABLE Vaccinations;
