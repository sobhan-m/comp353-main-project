DROP DATABASE IF EXISTS pnc353_2;
CREATE DATABASE pnc353_2;
USE pnc353_2;

/*
====================================================================
 Age Group
====================================================================
*/

DROP TABLE IF EXISTS AgeGroup;

CREATE TABLE AgeGroup(
groupID int,
minAge int NOT NULL,
maxAge int NOT NULL,
PRIMARY KEY (groupID),
CHECK (maxAge > minAge));

SELECT * FROM AgeGroup;

DELETE FROM AgeGroup;

INSERT INTO AgeGroup (groupID, minAge, maxAge)
VALUES 
(0, 9999, 99999),
(1, 80, 999),
(2, 70, 79),
(3, 60, 69),
(4, 50, 59),
(5, 40, 49),
(6, 30, 39),
(7, 18, 29),
(8, 12, 17),
(9, 5, 11),
(10, 0, 4);

/*
====================================================================
 ApprovedVaccinations
====================================================================
*/

DROP TABLE IF EXISTS ApprovedVaccinations;

CREATE TABLE ApprovedVaccinations(
vaccinationName VARCHAR(100),
dateOfApproval DATE,
vaccinationType ENUM("SAFE","SUSPENDED") NOT NULL DEFAULT "SAFE",
dateOfSuspension DATE,
PRIMARY KEY (vaccinationName)
);

SELECT * FROM ApprovedVaccinations;

DELETE FROM ApprovedVaccinations;

INSERT INTO ApprovedVaccinations(vaccinationName, dateOfApproval, vaccinationType, dateOfSuspension)
 VALUES('AstraZeneca', '2020-10-28', 'SAFE', NULL), ('Pfizer', '2020-06-10', 'SAFE', NULL),
 ('JJ', '2021-01-03', 'SUSPENDED', '2021-02-04'), ('Moderna', '2020-04-04', 'SAFE', NULL),
 ('AZ', '2020-07-28', 'SAFE', NULL), ('PB', '2020-03-10', 'SAFE', NULL),
 ('Astra', '2020-04-28', 'SUSPENDED', '2020-10-18'),('Pfiz', '2020-05-29', 'SUSPENDED', '2020-08-29'),
 ('Johnson & Johnson', '2020-10-03', 'SUSPENDED', '2021-01-14'),('Janssen', '2020-12-12', 'SAFE', NULL),
 ('M.', '2020-06-06', 'SAFE', NULL), ('Mod.', '2020-05-04', 'SUSPENDED', '2020-08-08');
 
 /*
====================================================================
 Province
====================================================================
*/

DROP TABLE IF EXISTS Province;

CREATE TABLE Province(
name VARCHAR(100), 
ageGroup int DEFAULT 0, 
PRIMARY KEY(name),
FOREIGN KEY (ageGroup) REFERENCES AgeGroup(groupID)
	ON DELETE SET NULL
	ON UPDATE CASCADE);

SELECT * FROM Province;

DELETE FROM Province;

INSERT INTO Province(name, ageGroup)
VALUES('NL', 10),
('PE', 10),
('NS', 10),
('NB', 10),
('QC', 10),
('ON', 10),
('MB', 10),
('SK', 10),
('AB', 10),
('YT', 10),
('NT', 10),
('NU', 10),
('BC', 10);

/*
====================================================================
 Person
====================================================================
*/

DROP TABLE IF EXISTS Person;

CREATE TABLE Person(
id INT AUTO_INCREMENT,
firstName VARCHAR(100) NOT NULL,
middleInitial varchar(100) NOT NULL,
lastName VARCHAR(100) NOT NULL,
dateOfBirth DATE,
telephoneNumber INT,
address VARCHAR(100),
city VARCHAR(100),
province VARCHAR(100),
postalCode VARCHAR(6),
citizenship VARCHAR(100),
emailAddress VARCHAR(100),
PRIMARY KEY(id),
UNIQUE (firstName, middleInitial, lastName),
FOREIGN KEY (province) REFERENCES Province(name)
	ON DELETE SET NULL
	ON UPDATE CASCADE
);

SELECT * FROM Person;

DELETE FROM Person;

INSERT INTO Person (firstName, middleInitial, lastName, dateOfBirth, telephoneNumber, address, city, province, postalCode, citizenship, emailAddress) 
VALUES ("John", "A", "Smith", '1990-01-01', 000000, '100 Guy Street', 'Montreal', 'QC', 'A1A1A1', 'Canadian', 'john.smith@gmail.com'),
("Mark", "B", "Julius", '1987-10-23', 111111, '200 Maisonneuve Street', 'Almaty', 'NB', 'B1B1B1', 'Kazakhastanian', 'mark.julius@gmail.com'),
("Jackie", "C", "Chan", '2000-03-30', 222222, '1980 Norman Street', 'Kawasaki', 'NL', 'C1C1C1', 'Japanese', 'jackie.chan@gmail.com'),
("Bruce","D", "Lee", '2021-09-01', 333333, '3475 De la montagne Street', 'Bandung', 'PE', 'D1D1D1', 'Indian', 'bruce.goerge@gmail.com'),
("King", "E","George", '1960-03-20', 444444, '5000 Peel Street', 'Sapporo', 'NS', 'E1E1E1', 'Japanese', 'king.george@gmail.com'),
("Vanilla","F", "Ice", '1975-01-01', 555555, '2001 Dutrisac Street', 'Baghdad', 'ON', 'F1F1F1', 'Indian', 'vanilla.ice@gmail.com'),
("Rock", "G","Lee", '2003-11-10', 666666, '1111 Fillion Street', 'Shiraz', 'MB', 'G1G1G1', 'Iranian', 'rock.lee@gmail.com'),
("Black","H", "Reaper", '2017-01-01', 777777, '908 Deguire Street', 'Praque', 'SK', 'H1H1H1', 'Czechinians', 'black.reaper@gmail.com'),
("Naruto","I", "Uzumaki", '1974-10-28', 888888, '743 Cleroux Street', 'Kathmandu', 'AB', 'I1I1I1', 'Nepalian', 'naruto.uzumaki@gmail.com'),
("Monkey", "J","Luffy", '2011-12-02', 999999, '1111 Sherbrook Street', 'Yokohama', 'YT', 'J1J1J1', 'Japanese', 'monkey.luffy@gmail.com'),
("John","K", "Cena", '1980-01-01', 100000, '101 Guy Street', 'Montreal', 'QC', 'K1K1K1', 'Canadian', 'john.cena@gmail.com'),
("Xin","L", "Lu", '1977-10-23', 211111, '201 Maisonneuve Street', 'Almaty', 'NB', 'L1L1L1', 'Kazakhastanian', 'xin.lu@gmail.com'),
("Spongebob","M", "Squarepants", '1990-03-30', 322222, '1981 Norman Street', 'Kawasaki', 'NL', 'M1M1M1', 'Japanese', 'spongebob.squarepants@gmail.com'),
("Sanji","N", "Blackleg", '2011-09-01', 433333, '3476 De la montagne Street', 'Bandung', 'PE', 'N1N1N1', 'Indian', 'Sanji.Blackleg@gmail.com'),
("Black","O", "Beard", '1950-03-20', 544444, '5001 Peel Street', 'Sapporo', 'NS', 'O1O1O1', 'Japanese', 'black.beard@gmail.com'),
("Junior","P", "Desolo", '1965-01-01', 655555, '2002 Dutrisac Street', 'Baghdad', 'ON', 'P1P1P1', 'Indian', 'junior.desolo@gmail.com'),
("Adrien","Q", "Burns", '1993-11-10', 766666, '1112 Fillion Street', 'Shiraz', 'MB', 'Q1Q1Q1', 'Iranian', 'adrien.burns@gmail.com'),
("Tala","R", "Sleeman", '2007-01-01', 877777, '909 Deguire Street', 'Praque', 'SK', 'R1R1R1', 'Czechinians', 'tala.sleeman@gmail.com'),
("Malek","S", "Jerbi", '1964-10-28', 988888, '744 Cleroux Street', 'Kathmandu', 'AB', 'S1S1S1', 'Nepalian', 'malek.jerbi@gmail.com'),
("Hercules","T", "DeGreece", '2001-12-02', 099999, '1112 Sherbrook Street', 'Yokohama', 'YT', 'T1T1T1', 'Japanese', 'Hercules.degreece@gmail.com'),
("Jimmy","U", "Neutron", '1970-01-01', 110000, '102 Guy Street', 'Montreal', 'QC', 'U1U1U1', 'Canadian', 'jimmy.neutron@gmail.com'),
("Crocodile","V", "Nini", '1967-10-23', 221111, '202 Maisonneuve Street', 'Almaty', 'NB', 'V1V1V1', 'Kazakhastanian', 'crocodile.nini@gmail.com'),
("Ali","W", "Dawah", '1980-03-30', 332222, '1982 Norman Street', 'Kawasaki', 'NL', 'W1W1W1', 'Japanese', 'ali.dawah@gmail.com'),
("Mohammed","X", "Hijad", '2001-09-01', 433333, '3477 De la montagne Street', 'Bandung', 'PE', 'X1X1X1', 'Indian', 'mohammed.hijad@gmail.com'),
("Ragnar","Y", "Lothbrok", '1950-01-01', 554444, '5002 Peel Street', 'Sapporo', 'NS', 'A2A2A2', 'Japanese', 'ragnar.lothbrok@gmail.com'),
("Younes","Z", "Garbili", '1955-01-01', 665555, '2003 Dutrisac Street', 'Baghdad', 'ON', 'B2B2B2', 'Indian', 'younes.garbili@gmail.com'),
("Jean-Francois","A", "Vo", '1983-11-10', 776666, '1113 Fillion Street', 'Shiraz', 'MB', 'C2C2C2', 'Iranian', 'jeanfrancois.vo@gmail.com'),
("Emilio","B", "Sanchez", '1997-01-01', 887777, '910 Deguire Street', 'Praque', 'SK', 'D2D2D2', 'Czechinians', 'emilio.sanchez@gmail.com'),
("Gustave","C", "Americ", '1954-10-28', 998888, '745 Cleroux Street', 'Kathmandu', 'AB', 'E2E2E2', 'Nepalian', 'gustave.americ@gmail.com'),
("Hermes","D", "Lefameux", '1991-12-02', 009999, '1113 Sherbrook Street', 'Yokohama', 'YT', 'F2F2F2', 'Japanese', 'Hermes.Lefameux@gmail.com'),
("Christine","C", "Kam", '1996-12-02', 009999, '7830 John Street', 'Montreal', 'QC', 'G2G2G2', 'Canadian', 'Christine.Kam@gmail.com');

/*
====================================================================
 PersonAgeGroup
====================================================================
*/

DROP TABLE IF EXISTS PersonAgeGroup;

CREATE TABLE PersonAgeGroup(
	id INT,
	ageGroupID INT DEFAULT 0,
	PRIMARY KEY (id),
	FOREIGN KEY (id) REFERENCES Person(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (ageGroupID) REFERENCES AgeGroup(groupID)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

SELECT * FROM PersonAgeGroup;

DELETE FROM PersonAgeGroup;

-- No inserts. They are done automatically at the time of vaccination.

/*
====================================================================
 Registered
====================================================================
*/

DROP TABLE IF EXISTS Registered;

CREATE TABLE Registered(
id INT NOT NULL,
medicareCardNum INT AUTO_INCREMENT,
medicareIssueDate DATE NOT NULL,
medicareExpiryDate DATE NOT NULL,
PRIMARY KEY (medicareCardNum),
FOREIGN KEY (id) REFERENCES Person(id)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);

SELECT * FROM Registered;

DELETE FROM Registered;

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
(30, '1991-12-02', '2041-12-02'),
(31, '1991-12-03', '2041-12-03');

/*
====================================================================
 Unregistered Person
====================================================================
*/

DROP TABLE IF EXISTS Unregistered;

CREATE TABLE Unregistered(
id INT NOT NULL,
passportNum INT AUTO_INCREMENT,
PRIMARY KEY (passportNum),
FOREIGN KEY (id) REFERENCES Person(id)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);

SELECT * FROM Unregistered;

DELETE FROM Unregistered;

INSERT INTO Unregistered(id)
VALUES (11),(12),(13),(14),(15),(16),(17),(18),(19),(20);

/*
====================================================================
 Health Worker
====================================================================
*/

DROP TABLE IF EXISTS HealthWorker;

CREATE TABLE HealthWorker(
pID INT,
ssn INT,
employeeType ENUM("Nurse", "Manager", "Security", "Secretary", "Regular Employee") NOT NULL DEFAULT "Regular Employee",
PRIMARY KEY (pID),
FOREIGN KEY (pID) REFERENCES Registered(id)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);

SELECT * FROM HealthWorker;

DELETE FROM HealthWorker;

INSERT INTO HealthWorker(pID, ssn, employeeType)
VALUES(1, 101, 'Manager'),(2, 102,'Nurse'), (3, 103, 'Security'), (4, 104, 'Secretary'),(5, 105, 'Regular Employee'),
(6, 106, 'Nurse'), (7, 107, 'Security'),(8, 108, 'Regular Employee'),(9, 109, 'Nurse'),(10, 110, 'Security'),(21, 111, 'Regular Employee'), 
(22, 112, 'Manager'),(23, 113, 'Manager'),(24, 114, 'Manager'),(25, 115, 'Manager'),(26, 117, 'Manager'),(27, 118, 'Manager'),(28, 119, 'Manager'),
(29, 120, 'Manager'),(30, 121, 'Nurse'),(31, 122, 'Nurse');

/*
====================================================================
 InfectionTypes
====================================================================
*/

DROP TABLE IF EXISTS InfectionTypes;

CREATE TABLE InfectionTypes(
	name VARCHAR(100),
	PRIMARY KEY (name)
);

SELECT * FROM InfectionTypes;

DELETE FROM InfectionTypes;

INSERT INTO InfectionTypes(name) 
VALUES 
("Unknown"),
("Alpha"),
("Beta"),
("Gamma"),
("Delta"),
("Mu");

/*
====================================================================
 Infection History
====================================================================
*/

DROP TABLE IF EXISTS InfectionHistory;

CREATE TABLE InfectionHistory(
personID INT,
infectionDate DATE,
type varchar(100) DEFAULT "Unknown",
PRIMARY KEY (personID, infectionDate),
FOREIGN KEY (personID) REFERENCES Person(id)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
FOREIGN KEY (type) REFERENCES InfectionTypes(name)
	ON DELETE SET DEFAULT
	ON UPDATE CASCADE
);

SELECT * FROM InfectionHistory;

DELETE FROM InfectionHistory;

INSERT INTO InfectionHistory(personID, infectionDate, type)
VALUES(6,'2020-10-10', "Alpha"),(16,'2020-09-09', "Beta"),(19, '2020-08-08', "Gamma"),(8, '2020-07-07', "MU"),(9, '2020-06-06', "MU"),
(5, '2020-05-05', "Beta"),(11, '2020-04-04', "Beta"),(13, '2020-03-03', "Alpha"),(1, '2020-02-02', "Alpha"),(3, '2020-01-01', "Delta"), (3, '2021-01-01', "MU"), (2, '2021-01-01', "Delta"), (2, '2021-03-01', "Delta"), (4, '2021-01-01', "Delta"), (12, '2021-01-01', "Delta");

/*
====================================================================
 PublicHealthFacilities
====================================================================
*/

DROP TABLE IF EXISTS PublicHealthFacilities;

CREATE TABLE PublicHealthFacilities(
name VARCHAR(100),
address VARCHAR(100),
city VARCHAR(100),
province VARCHAR(100),
country VARCHAR(100),
phoneNumber INT,
webAddress VARCHAR(100),
facilityType ENUM('HOSPITAL', 'CLINIC', 'SPECIAL INSTALLMENT'),
category ENUM('RESERVATION-ONLY', 'WALKIN-ALLOWED'),
capacity INT NOT NULL DEFAULT 0,
managerID INT,
FOREIGN KEY (managerID) REFERENCES HealthWorker(pID)
	ON DELETE SET NULL
	ON UPDATE CASCADE,
FOREIGN KEY (province) REFERENCES Province(name)
	ON DELETE SET NULL
	ON UPDATE CASCADE,
PRIMARY KEY (name)
);

SELECT * FROM PublicHealthFacilities;

DELETE FROM PublicHealthFacilities;

INSERT INTO PublicHealthFacilities(name, address, city, province, country, phoneNumber, webAddress, facilityType, category, capacity, managerID)
VALUES('A', '1 Elephant street', 'Montreal', 'QC', 'Canada', 514111111,'www.a.com', 'HOSPITAL', 'RESERVATION-ONLY', 5000, 1),
('B', '2 Mouse street', 'Laval', 'QC', 'Canada',  514222222,'www.b.com', 'CLINIC', 'WALKIN-ALLOWED', 500, 22),
('C', '3 Cat street', 'Montreal', 'QC', 'Canada',  514333333,'www.c.com', 'SPECIAL INSTALLMENT', 'RESERVATION-ONLY', 50, 29),
('D', '4 Dog street', 'Vancouver', 'BC', 'Canada',  514444444,'www.d.com', 'HOSPITAL', 'RESERVATION-ONLY', 6000, 23),
('E', '5 Bird street', 'Vancouver', 'BC', 'Canada',  514555555,'www.e.com', 'CLINIC', 'WALKIN-ALLOWED', 600, 24),
('F', '6 Snake street', 'Calgary', 'AB', 'Canada',  514666666,'www.f.com', 'SPECIAL INSTALLMENT', 'RESERVATION-ONLY', 60, 25),
('G', '7 Spider street', 'Ottawa', 'ON', 'Canada',  514777777,'www.g.com', 'HOSPITAL', 'RESERVATION-ONLY', 7000, 26),
('H', '8 Kangoroo street', 'Toronto', 'ON', 'Canada',  514888888,'www.h.com', 'CLINIC', 'WALKIN-ALLOWED', 700, 27),
('I', '9 Ant street', 'Vancouver', 'BC', 'Canada',  514999999,'www.i.com', 'SPECIAL INSTALLMENT', 'RESERVATION-ONLY', 70, 28),
('J', '10 Rabbit street', 'Quebec City', 'QC', 'Canada',  514000000,'www.j.com', 'HOSPITAL', 'RESERVATION-ONLY', 8000, 29),
('K', '12 Christine street', 'BestCity' ,'ON', 'Canada',  51412346,'www.k.com', 'HOSPITAL', 'RESERVATION-ONLY', 1, 28);


/*
====================================================================
 Assignments
====================================================================
*/

DROP TABLE IF EXISTS Assignments;

CREATE TABLE Assignments(
pID INT,
facilityName VARCHAR(100),
startDate DATE,
endDate DATE,
workerID INT AUTO_INCREMENT NOT NULL,
hourlyWage FLOAT,
UNIQUE (workerID, facilityName),
PRIMARY KEY (pID, facilityName, startDate),
FOREIGN KEY (pID) REFERENCES HealthWorker(pID)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
FOREIGN KEY (facilityName) REFERENCES PublicHealthFacilities(name)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);

SELECT * FROM Assignments;

DELETE FROM Assignments;

INSERT INTO Assignments(pID, facilityName, startDate, endDate, workerID, hourlyWage)
VALUES(1, 'A', '2019-12-12', NULL, 1, 11),
(2, 'B', '2020-01-01', '2020-06-01', 2, 12),
(3, 'C', '2020-05-13', '2020-10-13', 3, 13),
(4, 'D', '2020-04-25', '2020-09-25', 4, 14),
(5, 'E', '2021-01-01', '2021-06-01', 5, 15),
(6, 'F', '2020-10-10', '2021-03-10', 6, 16),
(7, 'G', '2020-03-23', '2020-08-23', 7, 17),
(8, 'H', '2020-07-12', '2020-12-12', 8, 18),
(9, 'I', '2020-06-11', '2020-11-11', 9, 19),
(10, 'J', '2020-09-02', '2020-02-02', 10, 20),
(21, 'B', '2019-12-12', NULL, 11, 21),
(22, 'C', '2020-01-01', NULL, 12, 22),
(23, 'D', '2020-05-13', NULL, 13, 23),
(24, 'E', '2020-04-25', NULL, 14, 24),
(25, 'F', '2021-01-01', NULL, 15, 25),
(26, 'G', '2020-10-10', NULL, 16, 26),
(27, 'H', '2020-03-23', NULL, 17, 27),
(28, 'I', '2020-07-12', NULL, 18, 28),
(29, 'J', '2020-06-11', NULL, 19, 29),
(30, 'K', '0001-12-12', NULL, 20, 30),
(31, 'K', '0001-12-12', NULL, 21, 33);

/*
====================================================================
 Vaccinations
====================================================================
*/

DROP TABLE IF EXISTS Vaccinations;

CREATE TABLE Vaccinations(
id INT,
workerID INT,
vaccinationName VARCHAR(100),
vaccinationDate DATE,
lotNumber INT,
facilityName VARCHAR(100),
province VARCHAR(100),
country VARCHAR(100),
doseNumber INT,
PRIMARY KEY (id, vaccinationDate),
FOREIGN KEY (id) REFERENCES Person(id)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
FOREIGN KEY (workerID, facilityName) REFERENCES Assignments(workerID, facilityName)
	ON DELETE CASCADE
	ON UPDATE CASCADE,
FOREIGN KEY (vaccinationName) REFERENCES ApprovedVaccinations(vaccinationName)
	ON DELETE SET NULL
	ON UPDATE CASCADE,
FOREIGN KEY (province) REFERENCES Province(name)
	ON DELETE SET NULL
	ON UPDATE CASCADE
);

SELECT * FROM Vaccinations;

DELETE FROM Vaccinations;

CREATE VIEW vaccinatedNurses AS
SELECT workerID, facilityName
FROM Assignments
	INNER JOIN (
			SELECT a.pID
			FROM Vaccinations v
				INNER JOIN Assignments a ON v.workerID = a.workerID AND v.facilityName = a.facilityName
			WHERE a.pID IN (SELECT id FROM Vaccinations)
				AND a.pID IN (SELECT pID FROM HealthWorker WHERE employeeType = "Nurse")) vaccinatedNurses ON Assignments.pID =  vaccinatedNurses.pID;

DELIMITER $$
CREATE TRIGGER NursesMustBeVaccinated_INSERT
AFTER INSERT ON Vaccinations
FOR EACH ROW
BEGIN
	IF ( NEW.workerID IS NOT NULL AND (NEW.workerID, NEW.facilityName) NOT IN (SELECT * FROM vaccinatedNurses)) THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Administrator must be a vaccinated nurse!";
	END IF;
END $$

CREATE TRIGGER NursesMustBeVaccinated_UPDATE
AFTER UPDATE ON Vaccinations
FOR EACH ROW
BEGIN
	IF ( NEW.workerID IS NOT NULL AND (NEW.workerID, NEW.facilityName) NOT IN (SELECT * FROM vaccinatedNurses)) THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Administrator must be a vaccinated nurse!";
	END IF;
END $$

CREATE TRIGGER ValidateAgeGroup_Insert
AFTER INSERT ON Vaccinations
FOR EACH ROW
BEGIN
	-- If the person has a valid ageGroup for the province.
	IF NEW.province IS NULL OR (SELECT groupID
		FROM AgeGroup
		WHERE TIMESTAMPDIFF(YEAR, (SELECT dateOfBirth FROM Person WHERE id = NEW.id), NEW.vaccinationDate) >= minAge 
		AND TIMESTAMPDIFF(YEAR, (SELECT dateOfBirth FROM Person WHERE id = NEW.id), NEW.vaccinationDate) <= maxAge) < (SELECT ageGroup FROM Province WHERE name = NEW.province) THEN
			-- Assign an agegroup to the person.
			DELETE FROM PersonAgeGroup WHERE id = NEW.id;
			INSERT INTO PersonAgeGroup(id, ageGroupID) VALUES (NEW.id, (SELECT groupID
																FROM AgeGroup
																WHERE TIMESTAMPDIFF(YEAR, (SELECT dateOfBirth FROM Person WHERE id = NEW.id), NEW.vaccinationDate) >= minAge 
																AND TIMESTAMPDIFF(YEAR, (SELECT dateOfBirth FROM Person WHERE id = NEW.id), NEW.vaccinationDate) <= maxAge));
	-- If the person is a healthworker then they can still get vaccinated.
	ELSEIF NEW.id IN (SELECT pID FROM HealthWorker) THEN
		DELETE FROM PersonAgeGroup WHERE id = NEW.id;
		INSERT INTO PersonAgeGroup(id, ageGroupID) VALUES (NEW.id, (SELECT groupID
																FROM AgeGroup
																WHERE TIMESTAMPDIFF(YEAR, (SELECT dateOfBirth FROM Person WHERE id = NEW.id), NEW.vaccinationDate) >= minAge 
																AND TIMESTAMPDIFF(YEAR, (SELECT dateOfBirth FROM Person WHERE id = NEW.id), NEW.vaccinationDate) <= maxAge));
	-- Otherwise reject changes.
	ELSE
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "The person is not in a valid age group for vaccination!";
    END IF;
END $$

CREATE TRIGGER ValidateAgeGroup_Update
AFTER UPDATE ON Vaccinations
FOR EACH ROW
BEGIN
	-- If the person has a valid ageGroup for the province.
	IF NEW.province IS NULL OR (SELECT groupID
		FROM AgeGroup
		WHERE TIMESTAMPDIFF(YEAR, (SELECT dateOfBirth FROM Person WHERE id = NEW.id), NEW.vaccinationDate) >= minAge 
		AND TIMESTAMPDIFF(YEAR, (SELECT dateOfBirth FROM Person WHERE id = NEW.id), NEW.vaccinationDate) <= maxAge) < (SELECT ageGroup FROM Province WHERE name = NEW.province) THEN
			-- Assign an agegroup to the person.
			DELETE FROM PersonAgeGroup WHERE id = NEW.id;
			INSERT INTO PersonAgeGroup(id, ageGroupID) VALUES (NEW.id, (SELECT groupID
																FROM AgeGroup
																WHERE TIMESTAMPDIFF(YEAR, (SELECT dateOfBirth FROM Person WHERE id = NEW.id), NEW.vaccinationDate) >= minAge 
																AND TIMESTAMPDIFF(YEAR, (SELECT dateOfBirth FROM Person WHERE id = NEW.id), NEW.vaccinationDate) <= maxAge));
	-- If the person is a healthworker.
	ELSEIF NEW.id IN (SELECT pID FROM HealthWorker) THEN
		DELETE FROM PersonAgeGroup WHERE id = NEW.id;
		INSERT INTO PersonAgeGroup(id, ageGroupID) VALUES (NEW.id, (SELECT groupID
																FROM AgeGroup
																WHERE TIMESTAMPDIFF(YEAR, (SELECT dateOfBirth FROM Person WHERE id = NEW.id), NEW.vaccinationDate) >= minAge 
																AND TIMESTAMPDIFF(YEAR, (SELECT dateOfBirth FROM Person WHERE id = NEW.id), NEW.vaccinationDate) <= maxAge));
	-- Otherwise reject changes.
	ELSE
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "The person is not in a valid age group for vaccination!";
    END IF;
END $$

CREATE TRIGGER VaccinationWaitPeriod_INSERT
BEFORE INSERT ON Vaccinations
FOR EACH ROW
BEGIN
	IF (NEW.id IN (SELECT id FROM Vaccinations) 
		AND
		(14  > ANY(SELECT ABS(DATEDIFF(vaccinationDate, NEW.vaccinationDate)) FROM Vaccinations WHERE id = NEW.id))) THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "A person must wait at least 14 days before getting another vaccine!";
	END IF;
END $$

CREATE TRIGGER VaccinationWaitPeriod_UPDATE
BEFORE UPDATE ON Vaccinations
FOR EACH ROW
BEGIN
	IF (NEW.id IN (SELECT id FROM Vaccinations) 
		AND
		(14  > ANY(SELECT ABS(DATEDIFF(vaccinationDate, NEW.vaccinationDate)) FROM Vaccinations WHERE id = NEW.id AND vaccinationDate <> OLD.vaccinationDate))) THEN
			SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "A person must wait at least 14 days before getting another vaccine!";
	END IF;
END $$

CREATE TRIGGER VaccinesMustBeSafe_INSERT
BEFORE INSERT ON Vaccinations
FOR EACH ROW
BEGIN
	IF (NEW.vaccinationName NOT IN (SELECT vaccinationName FROM ApprovedVaccinations WHERE vaccinationType = "SAFE")) THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Cannot administer an unsafe vaccination!";
	END IF;
END $$

CREATE TRIGGER VaccinesMustBeSafe_UPDATE
BEFORE UPDATE ON Vaccinations
FOR EACH ROW
BEGIN
	IF (NEW.vaccinationName NOT IN (SELECT vaccinationName FROM ApprovedVaccinations WHERE vaccinationType = "SAFE")) THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Cannot administer an unsafe vaccination!";
	END IF;
END $$
DELIMITER ;

INSERT INTO Vaccinations(id, workerID, vaccinationName, vaccinationDate, lotNumber, facilityName, province, country, doseNumber)
VALUES
(6, NULL, 'Pfizer', '2020-11-12', 14, "I", 'QC', 'Canada', 1),
(9, NULL, 'Pfizer', '2020-11-12', 14, 'I', 'QC', 'Canada', 1),
(2, 9, 'AstraZeneca', '2020-11-12', 14, 'I', 'QC', 'Canada', 1),
(2, 9, 'AstraZeneca', '2020-12-12', 14, 'I', 'BC', 'Canada', 2),
(17, 2, 'AstraZeneca', '2020-12-12', 5, 'B', 'QC', 'Canada', 1),
(12, 6, 'AstraZeneca', '2020-08-12', 10, 'F', NULL, 'United States', 1),
(12, 6, 'AstraZeneca', '2020-12-12', 10, 'F', NULL, 'United States', 2),
(22, 9, 'Pfizer', '2020-07-10', 7, 'I', NULL, 'Iran', 1),
(16, 9, 'M.', '2020-11-12', 12, 'I', NULL, 'Iraq', 1),
(16, 9, 'M.', '2020-12-12', 12, 'I', NULL, 'Iraq', 2),
(14, 6, 'Janssen', '2020-12-12', 6, 'F', NULL, 'Lebanon', 1),
(19, 2, 'PB', '2020-11-12', 8, 'B', NULL, 'Syria', 1),
(19, 2, 'PB', '2020-12-12', 8, 'B', NULL, 'Syria', 2),
(7, 2, 'Moderna', '2020-12-12', 9, 'B', NULL, 'Morocco', 1),
(1, 9, 'AstraZeneca', '2020-12-12', 13, 'I', NULL, 'Tunisia', 1),
(4, 2, 'AZ', '2020-11-12', 11, 'B', NULL, 'Algeria', 1),
(4, 2, 'AZ', '2020-12-12', 11, 'B', NULL, 'Algeria', 2);

/*
====================================================================
 FacilitySchedule
====================================================================
*/

DROP TABLE IF EXISTS FacilitySchedule;

CREATE TABLE FacilitySchedule(
name VARCHAR(100), -- This is the facility name.
days VARCHAR(1000) NOT NULL,
openingHour TIME NOT NULL,
closingHour TIME NOT NULL,
PRIMARY KEY (name),
FOREIGN KEY (name) REFERENCES PublicHealthFacilities(name)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);

SELECT * FROM FacilitySchedule;

DELETE FROM FacilitySchedule;

INSERT INTO FacilitySchedule(name, days, openingHour, closingHour)
VALUES("A","MON-TUE-WED-THU-FRI","08:00:00","20:00:00"),
("B","MON-TUE-WED-THU-FRI","08:00:00","20:00:00"),
("C","MON-TUE-WED-THU-FRI","08:00:00","20:00:00"),
("D","MON-TUE-WED-THU-FRI","08:00:00","20:00:00"),
("E","MON-TUE-WED-THU-FRI","08:00:00","20:00:00"),
("F","MON-TUE-WED-THU-FRI","08:00:00","20:00:00"),
("G","MON-TUE-WED-THU-FRI","08:00:00","20:00:00"),
("H","MON-TUE-WED-THU-FRI","08:00:00","20:00:00"),
("I","MON-TUE-WED-THU-FRI","08:00:00","20:00:00"),
("J","MON-TUE-WED-THU-FRI","08:00:00","20:00:00"),
("K","MON-TUE-WED-THU-FRI","08:00:00","20:00:00"); 

/*
====================================================================
 WorkerSchedule
====================================================================
*/

DROP TABLE IF EXISTS WorkerSchedule;

CREATE TABLE WorkerSchedule(
pID int,
workerID INT,
facilityName VARCHAR(100),
days VARCHAR(1000) NOT NULL DEFAULT "Monday-Tuesday-Wednesday-Thursday-Friday",
startingHour TIME NOT NULL DEFAULT "07:00:00",
endingHour TIME NOT NULL DEFAULT "21:00:00",
PRIMARY KEY (workerID, facilityName),
FOREIGN KEY (pID) REFERENCES HealthWorker(pID)
	ON DELETE SET NULL
	ON UPDATE CASCADE,
FOREIGN KEY (workerID, facilityName) REFERENCES Assignments (workerID, facilityName)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);

SELECT * FROM WorkerSchedule;

DELETE FROM WorkerSchedule;
SELECT workerID, facilityName FROM Assignments;
INSERT INTO WorkerSchedule(pID, workerID, facilityName, days, startingHour, endingHour)
VALUES (1, 1, 'A', "Monday-Tuesday-Wednesday-Thursday-Friday","07:00:00","21:00:00" ),
(2, 2, 'B', "Monday-Tuesday-Wednesday-Thursday-Friday","07:00:00","21:00:00" ),
(3, 3, 'C', "Monday-Tuesday-Wednesday-Thursday-Friday","07:00:00","21:00:00"),
(4, 4, 'D', "Monday-Tuesday-Wednesday-Thursday-Friday","07:00:00","21:00:00"),
(5, 5, 'E', "Monday-Tuesday-Wednesday-Thursday-Friday","07:00:00","21:00:00"),
(6, 6, 'F', "Monday-Tuesday-Wednesday-Thursday-Friday","07:00:00","21:00:00"),
(7, 7, 'G', "Monday-Tuesday-Wednesday-Thursday-Friday","07:00:00","21:00:00"),
(8, 8, 'H', "Monday-Tuesday-Wednesday-Thursday-Friday","07:00:00","21:00:00"),
(9, 9, 'I', "Monday-Tuesday-Wednesday-Thursday-Friday","07:00:00","21:00:00"),
(30, 20, 'K', "Monday-Tuesday-Wednesday-Thursday-Friday","07:00:00","21:00:00"),
(31, 21, 'K', "Monday-Tuesday-Wednesday-Thursday-Friday","07:00:00","21:00:00");

/*
====================================================================
Appointments
====================================================================
*/

DROP TABLE IF EXISTS Appointments;

CREATE TABLE Appointments(
date date,
time time,
pID int,
facilityName varchar(100) NOT NULL,
PRIMARY KEY(date, time, facilityName),
FOREIGN KEY (pID) REFERENCES Person(id)
	ON DELETE SET NULL
	ON UPDATE CASCADE,
FOREIGN KEY (facilityName) REFERENCES PublicHealthFacilities(name)
	ON DELETE CASCADE
	ON UPDATE CASCADE
);

SELECT * FROM Appointments;

DELETE FROM Appointments;

INSERT INTO Appointments(date, time, pID, facilityName)
VALUES("2021-12-25" , "12:00:00" , 9, "A"),
("2021-11-25" , "13:00:00" , 1, "B"),
("2021-01-25" , "12:00:00" , 2, "C"),
("2021-09-25" , "12:00:00" , 3, "D"),
("2021-04-25" , "12:00:00" , 4, "E"),
("2021-06-25" , "12:00:00" , 5, "F"),
("2021-07-25" , "12:00:00" , 6, "G"),
("2021-08-25" , "12:00:00" , 7, "H"),
("2021-02-25" , "12:00:00" , 8, "I"),
("2021-03-25" , "12:00:00" , 10, "G"),
("2022-12-25" , "08:00:00" , NULL, "C"),
("2022-12-25" , "08:20:00" , NULL, "C"),
("2022-12-25" , "08:40:00" , NULL, "C"),
("2022-12-25" , "09:00:00" , NULL, "C"),
("2022-12-25" , "09:20:00" , NULL, "C"),
("2022-12-25" , "09:40:00" , NULL, "C"),
("2022-12-25" , "10:00:00" , NULL, "C"),
("2022-12-25" , "10:20:00" , NULL, "C"),
("2022-12-25" , "10:40:00" , NULL, "C"),
("2022-12-25" , "11:00:00" , NULL, "C"),
("2022-12-25" , "11:20:00" , NULL, "C"),
("2022-12-25" , "11:40:00" , NULL, "C"),
("2022-12-25" , "12:20:00" , NULL, "C"),
("2022-12-25" , "12:40:00" , NULL, "C"),
("2022-12-25" , "13:00:00" , NULL, "C"),
("2022-12-25" , "13:20:00" , NULL, "C"),
("2022-12-25" , "13:40:00" , NULL, "C"),
("2022-12-25" , "14:00:00" , NULL, "C"),
("2022-12-25" , "14:20:00" , NULL, "C"),
("2022-12-25" , "14:40:00" , NULL, "C"),
("2022-12-25" , "15:00:00" , NULL, "C");