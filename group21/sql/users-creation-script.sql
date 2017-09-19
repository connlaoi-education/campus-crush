-- Author: Connlaoi Smith
-- File: users-creation-script.sql
-- Created: September 19 2017
-- WEBD 3201

-- DROP existing Users table if necessary
DROP TABLE IF EXISTS users;

-- CREATE users table with id, password, first name, last name, email address, enroll date, and last access.
CREATE TABLE users(
	id CHAR(20) PRIMARY KEY,
	password CHAR(20) NOT NULL,
	first_name CHAR(20) NOT NULL,
	last_name CHAR(30) NOT NULL,
	email_address CHAR(255) NOT NULL,
	enroll_date DATE NOT NULL,
	last_access DATE NOT NULL
	);

INSERT INTO users(id, password, first_name, last_name, email_address, enroll_date, last_access) VALUES (
	'admin',
	'restricted1nf0',
	'Administrator',
	'Privileges',
	'group21_webd3201@durhamcollege.ca',
	'2017-09-01',
	'2017-09-02'
);

INSERT INTO users(id, password, first_name, last_name, email_address, enroll_date, last_access) VALUES (
	'hpotter',
	'lightning',
	'Harry',
	'Potter',
	'harry.potter@gryffindor.com',
	'2017-09-01',
	'2017-09-02'
);

INSERT INTO users(id, password, first_name, last_name, email_address, enroll_date, last_access) VALUES (
	'hgranger',
	'dobby',
	'Hermione',
	'Granger',
	'hermione.granger@gryffindor.com',
	'2017-09-01',
	'2017-09-02'
);

INSERT INTO users(id, password, first_name, last_name, email_address, enroll_date, last_access) VALUES (
	'rweasley',
	'snoggin',
	'Ronald',
	'Weasley',
	'ron.weasley@gryffindor.com',
	'2017-09-01',
	'2017-09-02'
);