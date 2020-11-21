# RateMyClass - A place to leave Temple course reviews

![RateMyClass](https://github.com/RateMyClassTU/RateMyClass/blob/main/RateMyClassLogo.png?raw=true)

## Description
Rate My Class is a dynamic website for Temple students to view and post reviews for classes in different departments.

## Requirements
Before you get started, you need:
- MySQL Database
- Email for PHP Mailer

## MySQL Script
To use our code, make sure your database doesn't contain the table "User". Next, take a look at the code below. In the first line, replace the *your database* with the name of the database you'll be using. Then, you will be able to create the table on your database.
<pre><code>
CREATE TABLE `FA20_3296_tug67601`.`User` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `FirstName` VARCHAR(45) NOT NULL,
  `LastName` VARCHAR(45) NOT NULL,
  `Email` VARCHAR(45) NOT NULL,
  `Password` VARCHAR(64) NULL,
  `Acode` VARCHAR(45) NULL,
  `Rdatetime` DATETIME NULL,
  `Adatetime` DATETIME NULL,
  `Upvotes` INT NOT NULL DEFAULT 0,
  `Downvotes` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`),
  UNIQUE INDEX `ID_UNIQUE` (`ID` ASC),
  UNIQUE INDEX `Email_UNIQUE` (`Email` ASC));
</code></pre>

## Email and Server Setup
You need to edit 3 files before you can connect to your database:
1. config.php - change the information to that of your MySQL database.
2. register2.php
  - change lines 46 and 47 to your Emailers information
  - change lines 52 and 53 to the email and name you want others to see when receiving the verification link
  - change line 56 to the domain that hosts the files
3. reset2.php
  - change lines 46 and 47 to your Emailers information
  - change lines 52 and 53 to the email and name you want others to see when receiving the verification link
  - change line 56 to the domain that hosts the files
