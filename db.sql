-- Create database
CREATE DATABASE IF NOT EXISTS `book`;

-- Use the database
USE `book`;

-- Create table with a new name
CREATE TABLE IF NOT EXISTS `book_records` (
  `sno` INT NOT NULL AUTO_INCREMENT,
  `date` DATE NOT NULL,
  `company` VARCHAR(255) NOT NULL,
  `book` VARCHAR(255) DEFAULT NULL,
  `mobile` VARCHAR(20) DEFAULT NULL,
  `quantity` INT DEFAULT NULL,
  `price` DECIMAL(10,2) DEFAULT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- Create table with new name
CREATE TABLE IF NOT EXISTS `book_send` (
  `sno` INT NOT NULL AUTO_INCREMENT,
  `date` DATE NOT NULL,
  `company` VARCHAR(255) NOT NULL,
  `book` VARCHAR(255) DEFAULT NULL,
  `mobile` VARCHAR(20) DEFAULT NULL,
  `quantity` INT DEFAULT NULL,
  `price` DECIMAL(10,2) DEFAULT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;