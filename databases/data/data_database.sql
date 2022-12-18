DROP DATABASE IF EXISTS data;

CREATE DATABASE data DEFAULT CHARACTER SET utf8 COLLATE utf8_slovak_ci;

USE data;

CREATE TABLE products (
    id_product INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    brand VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL,
    category VARCHAR(255) NOT NULL,
    price FLOAT(5.2) NOT NULL,
    caption TEXT NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(2048) NOT NULL,
    quantity BIGINT NOT NULL,
    volume BIGINT NOT NULL
)Engine = Innodb;

CREATE TABLE brands(
    id_brand INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
)Engine = Innodb;

CREATE TABLE types(
    id_type INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
)Engine = Innodb;

CREATE TABLE categories(
    id_category INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
)Engine = Innodb;

CREATE TABLE admin(
    id_admin INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    admin_name VARCHAR(255) NOT NULL,
    admin_password VARCHAR(255) NOT NULL
)Engine = Innodb;

CREATE TABLE volume(
    id_volume INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    volume BIGINT NOT NULL
)Engine = Innodb;