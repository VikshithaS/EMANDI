-- DROP existing database and user if needed
DROP DATABASE IF EXISTS fsms;

-- CREATE the database
CREATE DATABASE fsms;
USE fsms;

-- CREATE tables
CREATE TABLE chef (
    chef_username VARCHAR(10) NOT NULL,
    chef_fname VARCHAR(50),
    chef_lname VARCHAR(50),
    chef_age INT(3),
    chef_gender VARCHAR(10),
    chef_password VARCHAR(255) NOT NULL,
    PRIMARY KEY (chef_username)
);

CREATE TABLE meal (
    meal_id VARCHAR(10) NOT NULL,
    meal_name VARCHAR(50),
    meal_price INT(11),
    meal_category VARCHAR(50) NOT NULL,
    PRIMARY KEY (meal_id)
);

CREATE TABLE allergy (
    allergy_num INT(5) NOT NULL AUTO_INCREMENT,
    allergy_type VARCHAR(50) NOT NULL,
    allergy_severity INT(2) NOT NULL,
    PRIMARY KEY (allergy_num)
);

CREATE TABLE supplier (
    supp_num INT(5) NOT NULL AUTO_INCREMENT,
    supp_name VARCHAR(50),
    supp_phone BIGINT,
    supp_country VARCHAR(50),
    PRIMARY KEY (supp_num)
);

CREATE TABLE ingredient (
    ingredient_id VARCHAR(10) NOT NULL,
    ingredient_name VARCHAR(50),
    ingredient_cost FLOAT,
    purchase_date DATE,
    expire_date DATE NOT NULL,
    allergy_type INT(5),
    supplier INT(5) NOT NULL,
    PRIMARY KEY (ingredient_id),
    FOREIGN KEY (allergy_type) REFERENCES allergy (allergy_num) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (supplier) REFERENCES supplier (supp_num) ON UPDATE CASCADE
);

CREATE TABLE meal_chef (
    meal_id VARCHAR(10) NOT NULL,
    chef_username VARCHAR(10) NOT NULL,
    action_date DATE NOT NULL,
    action_type VARCHAR(50) NOT NULL,
    PRIMARY KEY (meal_id, chef_username, action_date),
    FOREIGN KEY (chef_username) REFERENCES chef (chef_username),
    FOREIGN KEY (meal_id) REFERENCES meal (meal_id)
);

CREATE TABLE meal_ingredient (
    meal_id VARCHAR(10) NOT NULL,
    ingredient_id VARCHAR(10) NOT NULL,
    PRIMARY KEY (meal_id, ingredient_id),
    FOREIGN KEY (meal_id) REFERENCES meal (meal_id),
    FOREIGN KEY (ingredient_id) REFERENCES ingredient (ingredient_id)
);
