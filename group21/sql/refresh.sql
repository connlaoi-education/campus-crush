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
	power_id SMALLINT NOT NULL,
	gender_type VARCHAR(40) NOT NULL
);
INSERT INTO genders(gender_id, power_id, gender_type) VALUES('0','2','Male');
INSERT INTO genders(gender_id, power_id, gender_type) VALUES('1','4','Female');
INSERT INTO genders(gender_id, power_id, gender_type) VALUES('2','8','Other');


-- CITIES
CREATE TABLE cities(
	city_id INTEGER NOT NULL PRIMARY KEY,
	power_id SMALLINT NOT NULL,
	city_name VARCHAR(40) NOT NULL
);
INSERT INTO cities(city_id, power_id, city_name) VALUES('0','2','Ajax');
INSERT INTO cities(city_id, power_id, city_name) VALUES('1','4','Whitby');
INSERT INTO cities(city_id, power_id, city_name) VALUES('2','8','Oshawa');
INSERT INTO cities(city_id, power_id, city_name) VALUES('3','16','Courtice');
INSERT INTO cities(city_id, power_id, city_name) VALUES('4','32','Bowmanville');
INSERT INTO cities(city_id, power_id, city_name) VALUES('5','64','Out of Town');


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
	power_id SMALLINT NOT NULL,
	relationship_type VARCHAR(40) NOT NULL
);
INSERT INTO relationships(relationship_id, power_id, relationship_type) VALUES('0','2','Friends');
INSERT INTO relationships(relationship_id, power_id, relationship_type) VALUES('1','4','Casual');
INSERT INTO relationships(relationship_id, power_id, relationship_type) VALUES('2','8','Activities');
INSERT INTO relationships(relationship_id, power_id, relationship_type) VALUES('3','16','Dating');
INSERT INTO relationships(relationship_id, power_id, relationship_type) VALUES('4','32','Long Term');


-- STATUSES
CREATE TABLE statuses(
	status_id INTEGER NOT NULL PRIMARY KEY,
	power_id SMALLINT NOT NULL,
	status_type VARCHAR(40) NOT NULL
);
INSERT INTO statuses(status_id, power_id, status_type) VALUES('0','2','Single');
INSERT INTO statuses(status_id, power_id, status_type) VALUES('1','4','Off the Market');
INSERT INTO statuses(status_id, power_id, status_type) VALUES('2','8','In a Relationship');
INSERT INTO statuses(status_id, power_id, status_type) VALUES('3','16','Married');
INSERT INTO statuses(status_id, power_id, status_type) VALUES('4','32','Single Parent');
INSERT INTO statuses(status_id, power_id, status_type) VALUES('5','64','Taken Parent');


-- RELIGIONS
CREATE TABLE religions(
	religion_id INTEGER NOT NULL PRIMARY KEY,
	power_id SMALLINT NOT NULL,
	religion_name VARCHAR(40) NOT NULL
);
INSERT INTO religions(religion_id, power_id, religion_name) VALUES('0','2','Agnostic');
INSERT INTO religions(religion_id, power_id, religion_name) VALUES('1','4','Atheist');
INSERT INTO religions(religion_id, power_id, religion_name) VALUES('2','8','Buddhist');
INSERT INTO religions(religion_id, power_id, religion_name) VALUES('3','16','Catholic');
INSERT INTO religions(religion_id, power_id, religion_name) VALUES('4','32','Christian');
INSERT INTO religions(religion_id, power_id, religion_name) VALUES('5','64','Hindu');
INSERT INTO religions(religion_id, power_id, religion_name) VALUES('6','128','Jewish');
INSERT INTO religions(religion_id, power_id, religion_name) VALUES('7','256','Muslim');
INSERT INTO religions(religion_id, power_id, religion_name) VALUES('8','512','Rastafarian');
INSERT INTO religions(religion_id, power_id, religion_name) VALUES('9','1024','Scientologist');


-- EDUCATION
CREATE TABLE education(
	education_id INTEGER NOT NULL PRIMARY KEY,
	power_id SMALLINT NOT NULL,
	education_type VARCHAR(40) NOT NULL
);
INSERT INTO education(education_id, power_id, education_type) VALUES('0','2','College');
INSERT INTO education(education_id, power_id, education_type) VALUES('1','4','University');
INSERT INTO education(education_id, power_id, education_type) VALUES('2','8','Diploma');
INSERT INTO education(education_id, power_id, education_type) VALUES('3','16','Advanced Diploma');
INSERT INTO education(education_id, power_id, education_type) VALUES('4','32','Bachelors');
INSERT INTO education(education_id, power_id, education_type) VALUES('5','64','Masters');
INSERT INTO education(education_id, power_id, education_type) VALUES('6','128','Doctorate');


-- RACES
CREATE TABLE races(
	race_id INTEGER NOT NULL PRIMARY KEY,
	power_id SMALLINT NOT NULL,
	race_name VARCHAR(40) NOT NULL
);
INSERT INTO races(race_id, power_id, race_name) VALUES('0','2','Native American');
INSERT INTO races(race_id, power_id, race_name) VALUES('1','4','Asian');
INSERT INTO races(race_id, power_id, race_name) VALUES('2','8','Black or African American');
INSERT INTO races(race_id, power_id, race_name) VALUES('3','16','Caucasian');
INSERT INTO races(race_id, power_id, race_name) VALUES('4','32','Pacific or Hawaiian Native');
INSERT INTO races(race_id, power_id, race_name) VALUES('5','64','Middle Eastern');
INSERT INTO races(race_id, power_id, race_name) VALUES('6','128','Indian');


-- HABITS
CREATE TABLE habits(
	habit_id INTEGER NOT NULL PRIMARY KEY,
	power_id SMALLINT NOT NULL,
	habit_type VARCHAR(40) NOT NULL
);
INSERT INTO habits(habit_id, power_id, habit_type) VALUES('0','2','None');
INSERT INTO habits(habit_id, power_id, habit_type) VALUES('1','4','Drinker');
INSERT INTO habits(habit_id, power_id, habit_type) VALUES('2','8','Smoker');
INSERT INTO habits(habit_id, power_id, habit_type) VALUES('3','16','Gamer');


-- EXERCISES
CREATE TABLE exercises(
	exercise_id INTEGER NOT NULL PRIMARY KEY,
	power_id SMALLINT NOT NULL,
	exercise_type VARCHAR(40) NOT NULL
);
INSERT INTO exercises(exercise_id, power_id, exercise_type) VALUES('0','2','Occasionally');
INSERT INTO exercises(exercise_id, power_id, exercise_type) VALUES('1','4','1-2/Week');
INSERT INTO exercises(exercise_id, power_id, exercise_type) VALUES('2','8','3-6/Week');
INSERT INTO exercises(exercise_id, power_id, exercise_type) VALUES('3','16','Every Day');


-- RESIDENCES
CREATE TABLE residences(
	residence_id INTEGER NOT NULL PRIMARY KEY,
	power_id SMALLINT NOT NULL,
	residence_type VARCHAR(40) NOT NULL
);
INSERT INTO residences(residence_id, power_id, residence_type) VALUES('0','2','My Dorm Room');
INSERT INTO residences(residence_id, power_id, residence_type) VALUES('1','4','My Parents Place');
INSERT INTO residences(residence_id, power_id, residence_type) VALUES('2','8','My House');
INSERT INTO residences(residence_id, power_id, residence_type) VALUES('3','16','My Apartment');
INSERT INTO residences(residence_id, power_id, residence_type) VALUES('4','32','My Condo');
INSERT INTO residences(residence_id, power_id, residence_type) VALUES('5','64','My Beach House');
INSERT INTO residences(residence_id, power_id, residence_type) VALUES('6','128','My Parents Mansion');


-- CAMPUSES
CREATE TABLE campuses(
	campus_id INTEGER NOT NULL PRIMARY KEY,
	power_id SMALLINT NOT NULL,
	campus_name VARCHAR(40) NOT NULL
); 
INSERT INTO campuses(campus_id, power_id, campus_name) VALUES('0','2','North Oshawa');
INSERT INTO campuses(campus_id, power_id, campus_name) VALUES('1','4','Downtown Oshawa');
INSERT INTO campuses(campus_id, power_id, campus_name) VALUES('2','8','Whitby');
INSERT INTO campuses(campus_id, power_id, campus_name) VALUES('3','16','Pickering');


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
	'connlaoi',
	'smith',
	'connlaoi.smith@durhamcollege.ca',
	'i',
	'1992-05-04',
	'2017-09-01',
	'2017-09-02 07:23'
);

INSERT INTO users(id, password, first_name, last_name, email_address, account_type, birthday, enroll_date, last_access) VALUES (
	'jpower',
	'0bdd6a22ce32c25322f0b86f2a83d2d9',
	'jeremy',
	'power',
	'jeremy.power@durhamcollege.ca',
	'i',
	'1995-08-01',
	'2017-09-01',
	'2017-09-02 09:45'
);

INSERT INTO users(id, password, first_name, last_name, email_address, account_type, birthday, enroll_date, last_access) VALUES (
	'tminhly',
	'a97957182ad58593d01717d158d57893',
	'tri',
	'minh ly',
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
