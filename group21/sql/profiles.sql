-- Author: Connlaoi Smith
-- File: profiles.sql
-- Created: October 16 2017
-- WEBD 3201

-- DROP existing tables if necessary
-- DROP TABLE IF EXISTS profiles;
-- DROP TABLE IF EXISTS genders;
-- DROP TABLE IF EXISTS images;
-- DROP TABLE IF EXISTS cities;
-- DROP TABLE IF EXISTS relationships;
-- DROP TABLE IF EXISTS statuses;
-- DROP TABLE IF EXISTS religions;
-- DROP TABLE IF EXISTS education;
-- DROP TABLE IF EXISTS ethnicities;
-- DROP TABLE IF EXISTS habits;
-- DROP TABLE IF EXISTS exercises;
-- DROP TABLE IF EXISTS residences;
-- DROP TABLE IF EXISTS campuses;
-- DROP TABLE IF EXISTS users;

-- CREATE user table
CREATE TABLE users(
	id VARCHAR(20) PRIMARY KEY,
	password CHAR(32) NOT NULL,
	first_name CHAR(20) NOT NULL,
	last_name CHAR(30) NOT NULL,
	email_address CHAR(255) NOT NULL,
	account_type CHAR(1) NOT NULL,
	enroll_date DATE NOT NULL,
	last_access DATE NOT NULL
	);
	
-- CREATE initial user data
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
	'i',
	'2017-09-01',
	'2017-09-02'
);

INSERT INTO users(id, password, first_name, last_name, email_address, account_type, enroll_date, last_access) VALUES (
	'jpower',
	'0bdd6a22ce32c25322f0b86f2a83d2d9',
	'Jeremy',
	'Power',
	'jeremy.power@durhamcollege.ca',
	'i',
	'2017-09-01',
	'2017-09-02'
);

INSERT INTO users(id, password, first_name, last_name, email_address, account_type, enroll_date, last_access) VALUES (
	'lyminh',
	'a97957182ad58593d01717d158d57893',
	'Ly',
	'Tri Minh',
	'tri.minh.ly@durhamcollege.ca',
	'i',
	'2017-09-01',
	'2017-09-02'
);



-- CREATE tertiary tables


-- GENDERS
CREATE TABLE genders(
	gender_id SMALLINT NOT NULL PRIMARY KEY,
	gender_type VARCHAR(40) NOT NULL
);
INSERT INTO genders(gender_id, gender_type)
VALUES('0','Straight');


-- CITIES
CREATE TABLE cities(
	city_id INTEGER NOT NULL PRIMARY KEY,
	city_name VARCHAR(40) NOT NULL
);
INSERT INTO cities(city_id, city_name)
VALUES('0','Oshawa');


-- IMAGES
CREATE TABLE images(
	image_id SMALLINT NOT NULL PRIMARY KEY,
	image_address VARCHAR(40) NOT NULL
);
INSERT INTO images(image_id, image_address)
VALUES('0','./images/default_user.png');


-- RELATIONSHIPS
CREATE TABLE relationships(
	relationship_id INTEGER NOT NULL PRIMARY KEY,
	relationship_type VARCHAR(40) NOT NULL
);
INSERT INTO relationships(relationship_id, relationship_type)
VALUES('0','Friends');


-- STATUSES
CREATE TABLE statuses(
	status_id INTEGER NOT NULL PRIMARY KEY,
	status_type VARCHAR(40) NOT NULL
);
INSERT INTO statuses(status_id, status_type)
VALUES('0','Single');


-- RELIGIONS
CREATE TABLE religions(
	religion_id INTEGER NOT NULL PRIMARY KEY,
	religion_name VARCHAR(40) NOT NULL
);
INSERT INTO religions(religion_id, religion_name)
VALUES('0','Agnostic');


-- EDUCATION
CREATE TABLE education(
	education_id INTEGER NOT NULL PRIMARY KEY,
	education_type VARCHAR(40) NOT NULL
);
INSERT INTO education(education_id, education_type)
VALUES('0','College');


-- ETHNICITIES
CREATE TABLE ethnicities(
	ethnicity_id INTEGER NOT NULL PRIMARY KEY,
	ethnicity_name VARCHAR(40) NOT NULL
);
INSERT INTO ethnicities(ethnicity_id, ethnicity_name)
VALUES('0','Caucasian');


-- HABITS
CREATE TABLE habits(
	habit_id INTEGER NOT NULL PRIMARY KEY,
	habit_type VARCHAR(40) NOT NULL
);
INSERT INTO habits(habit_id, habit_type)
VALUES('0','None');


-- EXERCISES
CREATE TABLE exercises(
	exercise_id INTEGER NOT NULL PRIMARY KEY,
	exercise_type VARCHAR(40) NOT NULL
);
INSERT INTO exercises(exercise_id, exercise_type)
VALUES('0','Occasionally');


-- RESIDENCES
CREATE TABLE residences(
	residence_id INTEGER NOT NULL PRIMARY KEY,
	residence_type VARCHAR(40) NOT NULL
);
INSERT INTO residences(residence_id, residence_type)
VALUES('0','On Residence');


-- CAMPUSES
CREATE TABLE campuses(
	campus_id INTEGER NOT NULL PRIMARY KEY,
	campus_name VARCHAR(40) NOT NULL
); 
INSERT INTO campuses(campus_id, campus_name)
VALUES('0','North Oshawa');


-- CREATE secondary table

-- PROFILES
CREATE TABLE profiles(
	user_id CHAR(20) NOT NULL REFERENCES users(id),
	gender SMALLINT NOT NULL REFERENCES genders(gender_id),
	gender_sought SMALLINT NOT NULL REFERENCES genders(gender_id),
	city INTEGER NOT NULL REFERENCES cities(city_id),
	image SMALLINT NOT NULL REFERENCES images(image_id),
	headline VARCHAR(100),
	self_description VARCHAR(1000),
	match_description VARCHAR(1000),
	relationship_sought INTEGER NOT NULL REFERENCES relationships(relationship_id),
	relationship_status INTEGER NOT NULL REFERENCES statuses(status_id),
	preferred_age INTEGER NOT NULL,
	religion_sought INTEGER NOT NULL REFERENCES religions(religion_id),
	education_experience INTEGER NOT NULL REFERENCES education(education_id),
	habit INTEGER NOT NULL REFERENCES habits(habit_id),
	exercise INTEGER NOT NULL REFERENCES exercises(exercise_id),
	residence_type INTEGER NOT NULL REFERENCES residences(residence_id),
	campus INTEGER NOT NULL REFERENCES campuses(campus_id)
);
INSERT INTO profiles(user_id, gender, gender_sought, city, image, headline, self_description, match_description, relationship_sought, relationship_status, preferred_age, religion_sought, education_experience, habit, exercise, residence_type, campus) 
VALUES ('admin','0','0','0','0','Campus Crush Administrator','','','0','0','0','0','0','0','0','0','0');