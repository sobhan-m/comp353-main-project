# Relational Schema
- AgeGroup(<ins>groupID</ins>, minAge, maxAge)

- ApprovedVaccinations(<ins>vaccinationName</ins>, dateOfApproval, vaccinationType, dateOfSuspension)

- Province(<ins>name</ins>, ageGroup)

- Person(<ins>id</ins>, firstName, middleInitial, lastName, dateOfBirth, telephoneNumber, address, city, province, postalCode, citizenship, emailAddress)

- PersonAgeGroup(<ins>id</ins>, ageGroupID)

- Registered(id, <ins>medicareCardNum</ins>, medicareIssueDate, medicareExpiryDate)

- Unregistered(id, <ins>passportNum</ins>)

- HealthWorker(<ins>pID</ins>, ssn, employeeType)

- InfectionTypes(<ins>name</ins>)

- InfectionHistory(<ins>personID</ins>, <ins>infectionDate</ins>, type)

- PublicHealthFacilities(<ins>name</ins>, address, city, province, country, phoneNumber, webAddress, facilityType, category, capacity, managerID)

- Assignments(<ins>pID</ins>, <ins>facilityName</ins>, <ins>startDate</ins>, endDate, workerID, hourlyWage)

- Vaccinations(<ins>id</ins>, workerID, vaccinationName, <ins>vaccinationDate</ins>, lotNumber, facilityName, province, country, doseNumber)

- FacilitySchedule(<ins>name</ins>, days, openingHour, closingHour)

- WorkerSchedule( pID, <ins>workerID</ins>, <ins>facilityName</ins>, days, startingHour, endingHour)

- Appointments(<ins>date</ins>, <ins>time</ins>, pID, <ins>facilityName</ins>)
