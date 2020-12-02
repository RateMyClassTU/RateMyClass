# RateMyClass - A place to leave Temple course reviews

![RateMyClass](https://github.com/RateMyClassTU/RateMyClass/blob/main/assets/img/brand/RateMyClassLogo.png?raw=true)

## Description
Rate My Class is a dynamic website for Temple students to view and post reviews for classes in different departments.

## Pre-requisites
Before we begin, you'll need to setup a few things. You'll need
- MySQL Database
- Email for PHP Mailer
- PyMySQL (python package)

## MySQL Script
To use our code, make sure your database doesn't contain the table "User". Next, take a look at the code below. In the first line, replace the *your database* with the name of the database you'll be using. Then, you will be able to create the table on your database.

### Users
```
CREATE TABLE `*your database*`.`User` (
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
```
### Reviews
```
CREATE TABLE `*your database*`.`CourseReviews` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `Course` VARCHAR(128) NOT NULL,
  `Username` VARCHAR(45) NOT NULL,
  `Comment` VARCHAR(512) NOT NULL,
  `Upvotes` INT NOT NULL DEFAULT 0,
  `Downvotes` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`),
  UNIQUE INDEX `ID_UNIQUE` (`ID` ASC));
```
```
CREATE TABLE `*your database*`.`ProfessorReviews` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `Professor` VARCHAR(45) NOT NULL,
  `Comment` VARCHAR(512) NOT NULL,
  `Upvotes` INT NOT NULL DEFAULT 0,
  `Downvotes` INT NOT NULL DEFAULT 0,
  PRIMARY KEY(`ID`),
  UNIQUE INDEX `ID_UNIQUE` (`ID` ASC));
```

## Server setup
In addition to setting up the MySQL table, you'll also need to setup your server files. This can be found in assets/php/config.php. You will have to provide your server credentials to access the MySQL database. You need to do this so that the code is able to access the MySQL tables to do various functions. Examples:
- Authenticating users
- Getting a users rating

## PyMySQL
[PyMySQL](https://pypi.org/project/PyMySQL/) is a python package that helps communicate with MySQL. In order to download it, you'll need a python version of 2.7.x and >= 3.5. To check your version, run `python --version` in your terminal. If you do not have the necessary version of python, you can download it [here](https://www.python.org/downloads/).

Please run the command for your version of python in the console:
##### Python 2.7.x
`pip install PyMySQL`

##### Python >= 3.5
`python3 -m pip install PyMySQL`
