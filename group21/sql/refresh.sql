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
DROP TABLE IF EXISTS races;
DROP TABLE IF EXISTS habits;
DROP TABLE IF EXISTS exercises;
DROP TABLE IF EXISTS residences;
DROP TABLE IF EXISTS campuses;
DROP TABLE IF EXISTS months;
DROP TABLE IF EXISTS users;


-- CREATE tertiary tables


-- GENDERS
CREATE TABLE genders(
	gender_id SMALLINT NOT NULL PRIMARY KEY,
	gender_type VARCHAR(40) NOT NULL
);
INSERT INTO genders(gender_id, gender_type) VALUES('0','Male');
INSERT INTO genders(gender_id, gender_type) VALUES('1','Female');
INSERT INTO genders(gender_id, gender_type) VALUES('2','Other');


-- CITIES
CREATE TABLE cities(
	city_id INTEGER NOT NULL PRIMARY KEY,
	city_name VARCHAR(40) NOT NULL
);
INSERT INTO cities(city_id, city_name) VALUES('0','Oshawa');
INSERT INTO cities(city_id, city_name) VALUES('1','Whitby');
INSERT INTO cities(city_id, city_name) VALUES('2','Ajax');
INSERT INTO cities(city_id, city_name) VALUES('3','Courtice');
INSERT INTO cities(city_id, city_name) VALUES('4','Bowmanville');
INSERT INTO cities(city_id, city_name) VALUES('5','Out of Town');


-- IMAGES
CREATE TABLE images(
	image_id SMALLINT NOT NULL PRIMARY KEY,
	image_address VARCHAR(40) NOT NULL
);
INSERT INTO images(image_id, image_address) VALUES('0','./images/default_user.png');
INSERT INTO images(image_id, image_address) VALUES('1','./images/user-1-profile.png');
INSERT INTO images(image_id, image_address) VALUES('2','./images/user-2-profile.png');
INSERT INTO images(image_id, image_address) VALUES('3','./images/user-3-profile.png');
INSERT INTO images(image_id, image_address) VALUES('4','./images/user-4-profile.png');


-- RELATIONSHIPS
CREATE TABLE relationships(
	relationship_id INTEGER NOT NULL PRIMARY KEY,
	relationship_type VARCHAR(40) NOT NULL
);
INSERT INTO relationships(relationship_id, relationship_type) VALUES('0','Friends');
INSERT INTO relationships(relationship_id, relationship_type) VALUES('1','Casual');
INSERT INTO relationships(relationship_id, relationship_type) VALUES('2','Activities');
INSERT INTO relationships(relationship_id, relationship_type) VALUES('3','Dating');
INSERT INTO relationships(relationship_id, relationship_type) VALUES('4','Long Term');


-- STATUSES
CREATE TABLE statuses(
	status_id INTEGER NOT NULL PRIMARY KEY,
	status_type VARCHAR(40) NOT NULL
);
INSERT INTO statuses(status_id, status_type) VALUES('0','Single');
INSERT INTO statuses(status_id, status_type) VALUES('1','Off the Market');
INSERT INTO statuses(status_id, status_type) VALUES('2','In a Relationship');
INSERT INTO statuses(status_id, status_type) VALUES('3','Married');
INSERT INTO statuses(status_id, status_type) VALUES('4','Single Parent');
INSERT INTO statuses(status_id, status_type) VALUES('5','Taken Parent');


-- RELIGIONS
CREATE TABLE religions(
	religion_id INTEGER NOT NULL PRIMARY KEY,
	religion_name VARCHAR(40) NOT NULL
);
INSERT INTO religions(religion_id, religion_name) VALUES('0','Agnostic');
INSERT INTO religions(religion_id, religion_name) VALUES('1','Atheist');
INSERT INTO religions(religion_id, religion_name) VALUES('2','Buddhist');
INSERT INTO religions(religion_id, religion_name) VALUES('3','Catholic');
INSERT INTO religions(religion_id, religion_name) VALUES('4','Christian');
INSERT INTO religions(religion_id, religion_name) VALUES('5','Hindu');
INSERT INTO religions(religion_id, religion_name) VALUES('6','Jewish');
INSERT INTO religions(religion_id, religion_name) VALUES('7','Muslim');
INSERT INTO religions(religion_id, religion_name) VALUES('8','Rastafarian');
INSERT INTO religions(religion_id, religion_name) VALUES('9','Scientologist');


-- EDUCATION
CREATE TABLE education(
	education_id INTEGER NOT NULL PRIMARY KEY,
	education_type VARCHAR(40) NOT NULL
);
INSERT INTO education(education_id, education_type) VALUES('0','College');
INSERT INTO education(education_id, education_type) VALUES('1','University');
INSERT INTO education(education_id, education_type) VALUES('2','Diploma');
INSERT INTO education(education_id, education_type) VALUES('3','Advanced Diploma');
INSERT INTO education(education_id, education_type) VALUES('4','Bachelors');
INSERT INTO education(education_id, education_type) VALUES('5','Masters');
INSERT INTO education(education_id, education_type) VALUES('6','Doctorate');


-- RACES
CREATE TABLE races(
	race_id INTEGER NOT NULL PRIMARY KEY,
	race_name VARCHAR(40) NOT NULL
);
INSERT INTO races(race_id, race_name) VALUES('0','Native American');
INSERT INTO races(race_id, race_name) VALUES('1','Asian');
INSERT INTO races(race_id, race_name) VALUES('2','Black or African American');
INSERT INTO races(race_id, race_name) VALUES('3','Caucasian');
INSERT INTO races(race_id, race_name) VALUES('4','Pacific or Hawaiian Native');
INSERT INTO races(race_id, race_name) VALUES('5','Middle Eastern');
INSERT INTO races(race_id, race_name) VALUES('6','Indian');


-- HABITS
CREATE TABLE habits(
	habit_id INTEGER NOT NULL PRIMARY KEY,
	habit_type VARCHAR(40) NOT NULL
);
INSERT INTO habits(habit_id, habit_type) VALUES('0','None');
INSERT INTO habits(habit_id, habit_type) VALUES('1','Drinker');
INSERT INTO habits(habit_id, habit_type) VALUES('2','Smoker');
INSERT INTO habits(habit_id, habit_type) VALUES('3','Gamer');


-- EXERCISES
CREATE TABLE exercises(
	exercise_id INTEGER NOT NULL PRIMARY KEY,
	exercise_type VARCHAR(40) NOT NULL
);
INSERT INTO exercises(exercise_id, exercise_type) VALUES('0','Occasionally');
INSERT INTO exercises(exercise_id, exercise_type) VALUES('1','1-2/Week');
INSERT INTO exercises(exercise_id, exercise_type) VALUES('2','3-6/Week');
INSERT INTO exercises(exercise_id, exercise_type) VALUES('3','Every Day');


-- RESIDENCES
CREATE TABLE residences(
	residence_id INTEGER NOT NULL PRIMARY KEY,
	residence_type VARCHAR(40) NOT NULL
);
INSERT INTO residences(residence_id, residence_type) VALUES('0','My Dorm Room');
INSERT INTO residences(residence_id, residence_type) VALUES('1','My Parents Place');
INSERT INTO residences(residence_id, residence_type) VALUES('2','My House');
INSERT INTO residences(residence_id, residence_type) VALUES('3','My Apartment');
INSERT INTO residences(residence_id, residence_type) VALUES('4','My Condo');
INSERT INTO residences(residence_id, residence_type) VALUES('5','My Beach House');
INSERT INTO residences(residence_id, residence_type) VALUES('6','My Parents Mansion');


-- CAMPUSES
CREATE TABLE campuses(
	campus_id INTEGER NOT NULL PRIMARY KEY,
	campus_name VARCHAR(40) NOT NULL
); 
INSERT INTO campuses(campus_id, campus_name) VALUES('0','North Oshawa');
INSERT INTO campuses(campus_id, campus_name) VALUES('1','Downtown Oshawa');
INSERT INTO campuses(campus_id, campus_name) VALUES('2','Whitby');
INSERT INTO campuses(campus_id, campus_name) VALUES('3','Pickering');


-- MONTHS
CREATE TABLE months(
	month_id INTEGER NOT NULL PRIMARY KEY,
	month_name VARCHAR(9) NOT NULL
); 
INSERT INTO months(month_id, month_name) VALUES('0','January');
INSERT INTO months(month_id, month_name) VALUES('1','February');
INSERT INTO months(month_id, month_name) VALUES('2','March');
INSERT INTO months(month_id, month_name) VALUES('3','April');
INSERT INTO months(month_id, month_name) VALUES('4','May');
INSERT INTO months(month_id, month_name) VALUES('5','June');
INSERT INTO months(month_id, month_name) VALUES('6','July');
INSERT INTO months(month_id, month_name) VALUES('7','August');
INSERT INTO months(month_id, month_name) VALUES('8','September');
INSERT INTO months(month_id, month_name) VALUES('9','October');
INSERT INTO months(month_id, month_name) VALUES('10','November');
INSERT INTO months(month_id, month_name) VALUES('11','December');


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
	last_access DATE NOT NULL
	);
	
-- CREATE initial user data
INSERT INTO users(id, password, first_name, last_name, email_address, account_type, birthday, enroll_date, last_access) VALUES (
	'admin',
	'1492c81e612369f45f5509dfe8270b3c',
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
	'i',
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
	'i',
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
	'i',
	'1993-08-01',
	'2017-09-01',
	'2017-09-02 11:00'
);


-- CREATE secondary table

-- PROFILES
CREATE TABLE profiles(
	user_id CHAR(20) NOT NULL REFERENCES users(id),
	gender SMALLINT NOT NULL REFERENCES genders(gender_id),
	gender_sought SMALLINT NOT NULL REFERENCES genders(gender_id),
	city INTEGER NOT NULL REFERENCES cities(city_id),
	image SMALLINT NOT NULL REFERENCES images(image_id),
	headline VARCHAR(100) NOT NULL,
	self_description VARCHAR(1000) NOT NULL,
	match_description VARCHAR(1000) NOT NULL,
	relationship_sought INTEGER NOT NULL REFERENCES relationships(relationship_id),
	relationship_status INTEGER NOT NULL REFERENCES statuses(status_id),
	preferred_age_minimum INTEGER NOT NULL,
	preferred_age_maximum INTEGER NOT NULL,
	religion_sought INTEGER NOT NULL REFERENCES religions(religion_id),
	education_experience INTEGER NOT NULL REFERENCES education(education_id),
	race INTEGER NOT NULL REFERENCES races(race_id),
	habit INTEGER NOT NULL REFERENCES habits(habit_id),
	exercise INTEGER NOT NULL REFERENCES exercises(exercise_id),
	residence_type INTEGER NOT NULL REFERENCES residences(residence_id),
	campus INTEGER NOT NULL REFERENCES campuses(campus_id)
);

-- ADMIN PROFILE
INSERT INTO profiles(user_id, gender, gender_sought, city, image, headline, self_description, match_description, relationship_sought, relationship_status, preferred_age_minimum, preferred_age_maximum, religion_sought, education_experience, race, habit, exercise, residence_type, campus) 
VALUES ('admin','0','0','0','0','Campus Crush Administrator','NA','NA','0','0','0','0','0','0','0','0','0','0','0');
