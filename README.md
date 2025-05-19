# php_project
web project for php store

## SQL DB CREATION
```
-- Create the database
CREATE DATABASE IF NOT EXISTS `php-store-project_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Use the newly created database
USE `php-store-project_db`;

-- Table structure for table `accounts`
CREATE TABLE `accounts` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type` enum('standard','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `accounts`
INSERT INTO `accounts` (`ID`, `name`, `password`, `email`, `type`) VALUES
(1, 'admin', 'adminpass', 'admin@ynstore.com', 'admin');

-- Table structure for table `basket`
CREATE TABLE `basket` (
  `userID` int(11) NOT NULL,
  `prodID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for table `products`
CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `img` blob DEFAULT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Indexes for table `accounts`
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `email` (`email`);

-- Indexes for table `basket`
ALTER TABLE `basket`
  ADD PRIMARY KEY (`userID`,`prodID`),
  ADD KEY `products` (`prodID`);

-- Indexes for table `products`
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

-- AUTO_INCREMENT for table `accounts`
ALTER TABLE `accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- AUTO_INCREMENT for table `products`
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

-- Constraints for table `basket`
ALTER TABLE `basket`
  ADD CONSTRAINT `products` FOREIGN KEY (`prodID`) REFERENCES `products` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users` FOREIGN KEY (`userID`) REFERENCES `accounts` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
```
<!-- ```
CREATE DATABASE `php-store-project_db`;
USE `php-store-project_db`;


CREATE TABLE `php-store-project_db`.`accounts` (`ID` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `password` VARCHAR(50) NOT NULL , `email` VARCHAR(50) NOT NULL , `type` ENUM('standard','admin') NOT NULL , PRIMARY KEY (`ID`), UNIQUE (`name`), UNIQUE (`email`)) ENGINE = InnoDB;

CREATE TABLE `php-store-project_db`.`products` (`ID` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `description` VARCHAR(255) NOT NULL , `img` BLOB NULL DEFAULT NULL , `price` INT NOT NULL , `category` VARCHAR(50) NOT NULL , `brand` VARCHAR(50) NOT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;

CREATE TABLE `php-store-project_db`.`basket` (`userID` INT NOT NULL , `prodID` INT NOT NULL , `quantity` INT NOT NULL ) ENGINE = InnoDB;

ALTER TABLE `basket` ADD CONSTRAINT `users` FOREIGN KEY (`userID`) REFERENCES `accounts`(`ID`) ON DELETE CASCADE ON UPDATE CASCADE; ALTER TABLE `basket` ADD CONSTRAINT `products` FOREIGN KEY (`prodID`) REFERENCES `products`(`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `accounts` (`ID`, `name`, `password`, `email`, `type`) VALUES (NULL, 'admin', 'adminpass', 'admin@ynstore.com', 'admin');

ALTER TABLE `basket` ADD PRIMARY KEY(`userID`, `prodID`);
``` -->