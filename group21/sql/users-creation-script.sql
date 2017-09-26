-- Author: Connlaoi Smith
-- File: users-creation-script.sql
-- Created: September 19 2017
-- WEBD 3201

-- DROP existing Users table if necessary
DROP TABLE IF EXISTS users;

-- CREATE users table with id, password, first name, last name, email address, account type, enroll date, and last access.
CREATE TABLE users(
	id CHAR(20) PRIMARY KEY,
	password CHAR(32) NOT NULL,
	first_name CHAR(20) NOT NULL,
	last_name CHAR(30) NOT NULL,
	email_address CHAR(255) NOT NULL,
	account_type CHAR(1) NOT NULL,
	enroll_date DATE NOT NULL,
	last_access DATE NOT NULL
	);

INSERT INTO users(id, password, first_name, last_name, email_address, account_type, enroll_date, last_access) VALUES (
	'admin',
	'7f256b0f754fb894682eeb554883b679',
	'Administrator',
	'Privileges',
	'group21@durhamcollege.ca',
	'a',
	'2017-08-01',
	'2017-08-02'
);

INSERT INTO users(id, password, first_name, last_name, email_address, account_type, enroll_date, last_access) VALUES (
	'csmith',
	'1492c81e612369f45f5509dfe8270b3c',
	'Connlaoi',
	'Smith',
	'connlaoi.smith@durhamcollege.ca',
	'c',
	'2017-09-01',
	'2017-09-02'
);

INSERT INTO users(id, password, first_name, last_name, email_address, account_type, enroll_date, last_access) VALUES (
	'jpower',
	'0bdd6a22ce32c25322f0b86f2a83d2d9',
	'Jeremy',
	'Power',
	'jeremy.power@durhamcollege.ca',
	'c',
	'2017-09-01',
	'2017-09-02'
);

INSERT INTO users(id, password, first_name, last_name, email_address, account_type, enroll_date, last_access) VALUES (
	'lyminh',
	'a97957182ad58593d01717d158d57893',
	'Ly',
	'Tri Minh',
	'tri.minh.ly@durhamcollege.ca',
	'c',
	'2017-09-01',
	'2017-09-02'
);