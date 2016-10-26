DROP TABLE IF EXISTS pages;
DROP TABLE IF EXISTS account;
DROP TABLE IF EXISTS event;
DROP TABLE IF EXISTS news;
DROP TABLE IF EXISTS person;
DROP TABLE IF EXISTS img;

/* This is a very simple table for a mysql-php example */
CREATE TABLE pages (
    id INT NOT NULL AUTO_INCREMENT,
    urlTitle VARCHAR(32) NOT NULL, /* what word goes into the url that distinguishes this page from others */
    pageTitle VARCHAR(32) NOT NULL, /* title shown on bookmarks, tab, etc. */
    menuTitle VARCHAR(32) NOT NULL, /* title shown in menus */
    parent INT, /* parent page */
    bodyTitle VARCHAR(128) NOT NULL, /* title shown in the body of the page */
    body TEXT, /* content of the page (only text for now) */
    PRIMARY KEY (id)
);

CREATE TABLE account (
	id INT NOT NULL AUTO_INCREMENT,
	userName VARCHAR(32) NOT NULL, /* account for login */
	password VARCHAR(32) NOT NULL, /* password for login */
	admin INT, /* determine if a user is administrator or not */
	PRIMARY KEY (id)
);

CREATE TABLE event (
	id INT NOT NULL AUTO_INCREMENT,
	eventName VARCHAR(32) NOT NULL, /* shown as the title on the calendar or the list of event */
	timeToHold VARCHAR(32) NOT NULL, /* time message of event */
	content VARCHAR(255), /* details about this event */
	PRIMARY KEY (id)
);

CREATE TABLE news (
	id INT NOT NULL AUTO_INCREMENT,
	newsTitle VARCHAR(32) NOT NULL, /* shown as the title on the list of news */
	timePost VARCHAR(32) NOT NULL, /* time the news posted */
	preview VARCHAR(255), /* short preview content to show on the list */
	PRIMARY KEY (id)
);

CREATE TABLE person (
	id INT NOT NULL AUTO_INCREMENT,
	firstName VARCHAR(32) NOT NULL, /* Person's name */
    lastName VARCHAR(32) NOT NULL,
	email VARCHAR(32) NOT NULL, 
	phone VARCHAR(32), /* 2 types of contact information, phone can be null */
	personType VARCHAR(32) NOT NULL, /* person's title shown on the list */
	PRIMARY KEY (id)
);

CREATE TABLE img (
	id INT NOT NULL AUTO_INCREMENT,
	fileName VARCHAR(32) NOT NULL, /* the name used to save image on the server */
	PRIMARY KEY (id)
);

/* Insert home page */
INSERT INTO person (firstName, lastName, email, phone, personType) VALUES ("JP", "PN", "whoever@uiowa.edu", "", "member");
INSERT INTO pages (urlTitle, pageTitle, menuTitle, parent, bodyTitle, body) VALUES ("home", "Home - Soccer Lover's Club", "home", -1, "Welcome to the Soccer Lover's Club", "Cleats, goals, and tackles.");
