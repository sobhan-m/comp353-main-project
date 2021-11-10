
/*
====================================================================
 Query 1
====================================================================
*/

/*
====================================================================
 Query 2
====================================================================
*/

/*
====================================================================
 Query 3
====================================================================
*/

/*
-- PHP Version:

-- Creating.
INSERT INTO PublicHealthFacilities (name, address, province, country, phoneNumber, webAddress, facilityType, category, capacity, managerID)
VALUES ($name, $address, $province, $country, $phoneNumber, $webAddress, $facilityType, $category, $capacity, $managerID);

-- Deleting.
DELETE FROM PublicHealthFacilities
WHERE name = '$name';

-- Editing.
UPDATE PublicHealthFacilities
SET name = $name, address = $address, province = $province, country = $country,
	phoneNumber = $phoneNumber, webAddress = $webAddress, facilityType = $facilityType, 
	category = $category, capacity = $capacity, managerID = $managerID
WHERE name = $name;

-- Displaying.
SELECT *
FROM PublicHealthFacilities
WHERE name = $name;
*/

-- SQL Version:

-- Creating.
INSERT INTO PublicHealthFacilities (name, address, province, country, phoneNumber, webAddress, facilityType, category, capacity, managerID)
VALUES ('AA', '1 Street', 'QC', 'Canada', 11111111, 'aa.com', 'HOSPITAL', 'RESERVATION-ONLY', 100, 1);

-- Deleting.
DELETE FROM PublicHealthFacilities
WHERE name = 'AA';

-- Editing.
UPDATE PublicHealthFacilities
SET name = 'AA', address = '1.5 Street', province = 'ON', country = 'Canada',
	phoneNumber = 11111, webAddress = 'aaaaa.com', facilityType = 'Hospital', 
	category = 'RESERVATION-ONLY', capacity = 101, managerID = 2
WHERE name = 'AA';

-- Displaying.
SELECT *
FROM PublicHealthFacilities
WHERE name = 'AA';

/*
====================================================================
 Query 4
====================================================================
*/

/*
-- PHP Version:

-- Creating.
INSERT INTO ApprovedVaccinations (vaccinationName, dateOfApproval, vaccinationType, dateOfSuspension)
VALUES ($name, $approvalDate, $type, $suspensionDate);


-- Deleting.
DELETE FROM ApprovedVaccinations
WHERE vaccinationName = $name;

-- Editing.
UPDATE ApprovedVaccinations
SET vaccinationName = $name, dateOfApproval = $approvalDate, vaccinationType = $type, dateOfSuspension = $suspensionDate
WHERE vaccinationName = $name;

-- Displaying.
SELECT *
FROM ApprovedVaccinations
WHERE vaccinationName = $name;
*/

-- SQL Version:

-- Creating.
INSERT INTO ApprovedVaccinations (vaccinationName, dateOfApproval, vaccinationType, dateOfSuspension)
VALUES ('A', '2020-12-12', 'SAFE', NULL);


-- Deleting.
DELETE FROM ApprovedVaccinations
WHERE vaccinationName = 'A';

-- Editing.
UPDATE ApprovedVaccinations
SET vaccinationName = 'A', dateOfApproval = '2020-12-12', vaccinationType = 'SUSPENDED', dateOfSuspension = '2021-11-09'
WHERE vaccinationName = 'A';

-- Displaying.
SELECT *
FROM ApprovedVaccinations
WHERE vaccinationName = 'A';

/*
====================================================================
 Query 5
====================================================================
*/
SELECT * FROM InfectionTypes;

INSERT INTO InfectionTypes(name)
VALUES("Charlie") 
ON DUPLICATE KEY UPDATE name = "Charlie";


DELETE FROM InfectionTypes
WHERE name = "Alpha";

UPDATE InfectionTypes
SET name = "Quebec"
WHERE name = "Mu";

SELECT *
FROM InfectionTypes
WHERE name = "Beta";
/*
====================================================================
 Query 6
====================================================================
*/
INSERT INTO AgeGroup(groupDescription)
VALUES("0-4");

DELETE FROM AgeGroup
WHERE groupDescription = "80+";

UPDATE AgeGroup
SET groupDescription = "0-4"
WHERE groupDescription = "80+";

SELECT *
FROM AgeGroup
WHERE groupDescription = "80+";
/*
====================================================================
 Query 7
====================================================================
*/
-- Creating.
INSERT INTO Province(name, ageGroup)
VALUES('pr', NULL);

-- Editing.
UPDATE Province
SET name = 'pq', ageGroup=NULL
WHERE name = 'pr';

-- Displaying.
SELECT *
FROM Province
WHERE name = 'pq';

-- Deleting.
DELETE FROM Province
WHERE name = 'pq';

/*
====================================================================
 Query 8
====================================================================
*/
-- Editing.
UPDATE Province
SET name = 'Quebec', ageGroup=2
WHERE name = 'Quebec';

/*
====================================================================
 Query 9
====================================================================
*/
-- Creating.
INSERT INTO Appointments(date, time, pID, facilityName)
VALUES("2020-8-7" , "11:25:22" , 2, "C");

-- Editing.
UPDATE Appointments
SET date="2020-8-7" , time="11:25:22", pID=3, facilityName="D"
WHERE date="2020-8-7" AND time="11:25:22";

-- Displaying.
SELECT *
FROM Appointments
WHERE date="2020-8-7" AND time="11:25:22";

-- Deleting.
DELETE FROM Appointments
WHERE date="2020-8-7" AND time="11:25:22";

/*
====================================================================
 Query 10
====================================================================
*/

-- Creating.
INSERT INTO Assignments(pID, facilityName, startDate, endDate, hourlyWage)
VALUES(2, 'C', '2017-1-20', NULL, 20);

-- Editing.
UPDATE Assignments
SET pID=2, facilityName='C', startDate='2016-11-20', endDate=NULL, hourlyWage=38
WHERE pID=2 AND facilityName='C' AND startDate='2017-1-20';

-- Displaying.
SELECT *
FROM Assignments
WHERE pID=2 AND facilityName='C' AND startDate='2016-11-20';

-- Deleting.
DELETE FROM Assignments
WHERE pID=2 AND facilityName='C' AND startDate='2016-11-20';

/*
====================================================================
 Query 11
====================================================================
*/
-- $facilityName, $startTime, $endTime
SELECT *
FROM Appointments A
INNER JOIN PublicHealthFacilities PHF ON A.facilityName=PHF.name
INNER JOIN FacilitySchedule FS ON A.facilityName=FS.name
WHERE SUBSTRING(DAYNAME('2016-11-20'), 1, 3) LIKE FS.days;

/*
====================================================================
 Query 12
====================================================================
*/

/*
====================================================================
 Query 13
====================================================================
*/

/*
====================================================================
 Query 14
====================================================================
*/

/*
====================================================================
 Query 15
====================================================================
*/

/*
====================================================================
 Query 16
====================================================================
*/

/*
====================================================================
 Query 17
====================================================================
*/

/*
====================================================================
 Query 18
====================================================================
*/

/*
====================================================================
 Query 19
====================================================================
*/

/*
====================================================================
 Query 20
====================================================================
*/
