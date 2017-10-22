-- Author: Connlaoi Smith
-- File: users.sql
-- Created: September 19 2017
-- WEBD 3201

DROP TABLE IF EXISTS users;

-- CREATE primary user table
CREATE TABLE users(
	id VARCHAR(20) PRIMARY KEY,
	password CHAR(32) NOT NULL,
	first_name CHAR(20) NOT NULL,
	last_name CHAR(30) NOT NULL,
	email_address CHAR(255) NOT NULL,
	account_type CHAR(1) NOT NULL,
	birthday DATE NOT NULL,
	enroll_date DATE NOT NULL,
	last_access DATETIME NOT NULL
	);
	
-- CREATE initial user data
INSERT INTO users(id, password, first_name, last_name, email_address, account_type, birthday, enroll_date, last_access) VALUES (
	'admin',
	'7f256b0f754fb894682eeb554883b679',
	'Administrator',
	'Privileges',
	'group21@durhamcollege.ca',
	'a',
	'1980-08-01',
	'2017-08-01',
	'2017-08-02 06:00'
);

INSERT INTO users(id, password, first_name, last_name, email_address, account_type, birthday, enroll_date, last_access) VALUES (
	'csmith',
	'1492c81e612369f45f5509dfe8270b3c',
	'Connlaoi',
	'Smith',
	'connlaoi.smith@durhamcollege.ca',
	'a',
	'1992-05-04',
	'2017-09-01',
	'2017-09-02 07:23'
);

INSERT INTO users(id, password, first_name, last_name, email_address, account_type, birthday, enroll_date, last_access) VALUES (
	'jpower',
	'0bdd6a22ce32c25322f0b86f2a83d2d9',
	'Jeremy',
	'Power',
	'jeremy.power@durhamcollege.ca',
	'a',
	'1995-08-01',
	'2017-09-01',
	'2017-09-02 09:45'
);

INSERT INTO users(id, password, first_name, last_name, email_address, account_type, birthday, enroll_date, last_access) VALUES (
	'lyminh',
	'a97957182ad58593d01717d158d57893',
	'Ly',
	'Tri Minh',
	'tri.minh.ly@durhamcollege.ca',
	'a',
	'1993-08-01',
	'2017-09-01',
	'2017-09-02 11:00'
);

