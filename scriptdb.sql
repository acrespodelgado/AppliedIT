CREATE DATABASE IF NOT EXISTS appliedit_prueba;
USE appliedit_prueba;

CREATE TABLE IF NOT EXISTS `User` (
    id INT PRIMARY KEY AUTO_INCREMENT ,
    email VARCHAR(255) NOT NULL UNIQUE,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    admin BIT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS `Country` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `Activity` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `Company` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    tax_number VARCHAR(255) NOT NULL,
    employees INT,
    countryId INT,
    zip_code VARCHAR(255),
    email VARCHAR(255),
    phone_number VARCHAR(255),
    activityId INT,
    risk BOOLEAN,
    payment ENUM('Bank', 'Credit', 'Cash'),
    FOREIGN KEY (countryId) REFERENCES Country(id),
    FOREIGN KEY (activityId) REFERENCES Activity(id)
);

INSERT INTO `User` (`email`,`username`,`password`,`admin`) VALUES ('admin@admin.com','admin', 'c93ccd78b2076528346216b3b2f701e6', 1);
INSERT INTO `Country` (`name`) VALUES ('Spain'),('France'),('England'),('Germany');
INSERT INTO `Activity` (`name`) VALUES ('Insurance'),('Advisory'),('Invest'),('Engineering');