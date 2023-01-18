-- PUT YOUR SQL SCHEMA CODE HERE 

CREATE DATABASE IF NOT EXISTS `isitec` CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `isitec`;

CREATE TABLE IF NOT EXISTS users(
    `iduser` INT AUTO_INCREMENT , 
    `mail` VARCHAR(40) NOT NULL , 
    `username` VARCHAR(16) NOT NULL , 
    `passHash` VARCHAR(60) NOT NULL , 
    `userFirstName` VARCHAR(60) NOT NULL , 
    `userLastName` VARCHAR(120) NOT NULL , 
    `creationDate` DATETIME NOT NULL , 
    `removeDate` DATETIME NOT NULL , 
    `lastSignIn` DATETIME NOT NULL , 
    `active` TINYINT(1) NOT NULL , 
    PRIMARY KEY (`iduser`), UNIQUE (`username`), UNIQUE (`mail`)) ENGINE = InnoDB;