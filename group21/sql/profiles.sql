-- Author: Connlaoi Smith
-- File: profiles.sql
-- Created: October 16 2017
-- WEBD 3201

-- DROP existing tables if necessary
DROP TABLE IF EXISTS profiles;
DROP TABLE IF EXISTS genders;
DROP TABLE IF EXISTS images;
DROP TABLE IF EXISTS cities;
DROP TABLE IF EXISTS relationships;
DROP TABLE IF EXISTS statuses;
DROP TABLE IF EXISTS religions;
DROP TABLE IF EXISTS education;
DROP TABLE IF EXISTS ethnicities;
DROP TABLE IF EXISTS habits;
DROP TABLE IF EXISTS exercises;
DROP TABLE IF EXISTS residences;
DROP TABLE IF EXISTS campuses;

-- CREATE tables
CREATE TABLE profiles(
	user_id VARCHAR(20) FOREIGN KEY NOT NULL,
	gender SMALLINT FOREIGN KEY NOT NULL,
	gender_sought SMALLINT FOREIGN KEY NOT NULL,
	city INTEGER FOREIGN KEY NOT NULL,
	images SMALLINT FOREIGN KEY NOT NULL,
	headline VARCHAR(100) NOT NULL,
	self_description VARCHAR(1000) NOT NULL,
	match_description VARCHAR(1000) NOT NULL,
	relationship_sought INTEGER FOREIGN KEY NOT NULL
	relationship_status INTEGER FOREIGN KEY NOT NULL,
	preferred_age INTEGER FOREIGN KEY NOT NULL,
	religion_sought INTEGER FOREIGN KEY NOT NULL,
	education_experience INTEGER FOREIGN KEY NOT NULL,
	habits INTEGER FOREIGN KEY NOT NULL,
	exercise INTEGER FOREIGN KEY NOT NULL,
	residence_type INTEGER FOREIGN KEY NOT NULL,
	campus INTEGER FOREIGN KEY NOT NULL
);

CREATE TABLE genders(
	gender_id SMALLINT PRIMARY KEY,
	gender_type VARCHAR(40) NOT NULL
);

CREATE TABLE cities(
	city_id INTEGER PRIMARY KEY,
	city_name VARCHAR(40) NOT NULL
);

CREATE TABLE images(
	user_id VARCHAR(20) FOREIGN KEY NOT NULL,
	image_id SMALLINT PRIMARY KEY,
	image_address VARCHAR(40) NOT NULL
);

CREATE TABLE relationships(
	relationship_id INTEGER PRIMARY KEY,
	relationship_type VARCHAR(40) NOT NULL
);

CREATE TABLE statuses(
	status_id INTEGER PRIMARY KEY,
	status_type CHAR(40) NOT NULL
);

CREATE TABLE religions(
	religion_id INTEGER PRIMARY KEY,
	religion_name CHAR(40) NOT NULL
);

CREATE TABLE education(
	education_id INTEGER PRIMARY KEY,
	education_type CHAR(40) NOT NULL
);

CREATE TABLE ethnicities(
	ethnicity_id INTEGER PRIMARY KEY,
	ethnicity_name CHAR(40) NOT NULL
);

CREATE TABLE habits(
	habit_id INTEGER PRIMARY KEY,
	habit_type CHAR(40) NOT NULL
);

CREATE TABLE exercises(
	exercise_id INTEGER PRIMARY KEY,
	exercise_type CHAR(40) NOT NULL
);

CREATE TABLE residences(
	residence_id INTEGER PRIMARY KEY,
	residence_type CHAR(40) NOT NULL
);

CREATE TABLE campuses(
	campus_id INTEGER PRIMARY KEY,
	campus_name CHAR(40) NOT NULL
);

INSERT INTO profiles(user_id, gender, gender_sought, city, images, headline, self_description, match_description, relationship_sought, relationship_status, preferred_age, religion_sought, education_experience, habits, experience, residence_type, campus) VALUES (
	'admin',
	0,
	0,
	0,
	0,
	0,
);