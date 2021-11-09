
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

/*
====================================================================
 Query 8
====================================================================
*/

/*
====================================================================
 Query 9
====================================================================
*/

/*
====================================================================
 Query 10
====================================================================
*/

/*
====================================================================
 Query 11
====================================================================
*/

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
