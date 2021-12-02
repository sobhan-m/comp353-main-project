# Description
This is a web application and database created as part of COMP 353, a course on databases.

It involves creating a database to handle the vaccination process for COVID-19. This involves setting appointments, doing the vaccination, keeping track of infection histories, and storing the information of healthcare facilities and their workers.

# Entity-Relationship Model
Here you'll find an image of the entity-relationship model used to conceptual the SQL tables.

![E-R Diagram](/Diagram/er-model.jpg)

# Installation Instructions

## Running MySQL
For ease of use, we recommend installing MySQL Workbench and using it to run all the statements in tables.sql in order.

## Running PHP
Start by downloading the files:
```
git clone https://github.com/Sobhan-M/comp353-main-project.git
```

Then enter the folder:
```
cd comp353-main-project
```

You then have to create a local file called "credentials.php" which should be in the following form (replace wherever relevant):
```
<?php

// Change these to local credentials.
$serverName = "mysql server";
$userName = "mysql user";
$password = "user password";
$databaseName = "pnc353_2";

?>
```

Finally run the PHP server using:
```
php -S localhost:8000
```

Then open a browser and go to localhost:8000 or alternatively click [here](http://localhost:8000/).