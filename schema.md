# Relational Schema
- AgeGroup(<ins>groupID</ins>, groupDescription)

- ApprovedVaccinations(<ins>vaccinationName</ins>, dateOfApproval, vaccinationType, dateOfSuspension)

- Province(<ins>name</ins>, ageGroup)

- Person(<ins>id</ins>, firstName, middleInitial, lastName, dateOfBirth, telephoneNumber, address, city, province, postalCode, citizenship, emailAddress, ageGroupID)

- Registered(id, <ins>medicareCardNum</ins>, medicareIssueDate, medicareExpiryDate)

- Unregistered(id, <ins>passportNum</ins>)

- HealthWorker(<ins>id</ins>, ssn, employeeType)

- InfectionTypes(<ins>name</ins>)

- InfectionHistory(<ins>personID</ins>, <ins>infectionDate</ins>, type)

- PublicHealthFacilities(<ins>name</ins>, address, province, country, phoneNumber, webAddress, facilityType, category, capacity, managerID)

- Assignments(<ins>pID</ins>, <ins>startDate</ins>, workerID, hourlyWage <ins>facilityName</ins>, endDate)

- Vaccinations(<ins>id</ins>, healthWorkerID, vaccinationName, <ins>vaccinationDate</ins>, lotNumber, location, province, country, doseNumber)

- FacilitySchedule(<ins>name</ins>, days, openingHour, closingHour)

- WorkerSchedule(<ins>workerID</ins>, <ins>facilityName</ins>, day, startingHour, endingHour)

- Appointments(pID, <ins>date</ins>, <ins>time</ins>, facilityName)
