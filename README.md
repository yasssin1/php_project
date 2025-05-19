# php_project
web project for php store

## SQL DB CREATION
```
CREATE DATABASE `php-store-project_db`;
USE `php-store-project_db`;


CREATE TABLE `php-store-project_db`.`accounts` (`ID` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `password` VARCHAR(50) NOT NULL , `email` VARCHAR(50) NOT NULL , `type` ENUM('standard','admin') NOT NULL , PRIMARY KEY (`ID`), UNIQUE (`name`), UNIQUE (`email`)) ENGINE = InnoDB;

CREATE TABLE `php-store-project_db`.`products` (`ID` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `description` VARCHAR(255) NOT NULL , `img` BLOB NULL DEFAULT NULL , `price` INT NOT NULL , `category` VARCHAR(50) NOT NULL , `brand` VARCHAR(50) NOT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;

CREATE TABLE `php-store-project_db`.`basket` (`userID` INT NOT NULL , `prodID` INT NOT NULL , `quantity` INT NOT NULL ) ENGINE = InnoDB;

ALTER TABLE `basket` ADD CONSTRAINT `users` FOREIGN KEY (`userID`) REFERENCES `accounts`(`ID`) ON DELETE CASCADE ON UPDATE CASCADE; ALTER TABLE `basket` ADD CONSTRAINT `products` FOREIGN KEY (`prodID`) REFERENCES `products`(`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `accounts` (`ID`, `name`, `password`, `email`, `type`) VALUES (NULL, 'admin', 'adminpass', 'admin@ynstore.com', 'admin');

ALTER TABLE `basket` ADD PRIMARY KEY(`userID`, `prodID`);
```