-- CSC 424 - Fall 2018
-- Assignment #5

GRANT ALL ON STORE.* TO 'root'@'localhost';

DROP DATABASE STORE;

CREATE DATABASE STORE;

USE STORE;

CREATE TABLE  customers 
(
	cid		INT		AUTO_INCREMENT,
	cfname	TEXT	NOT NULL,
	clname	TEXT	NOT NULL,
	cstreet	TEXT	NOT NULL,
	ccity	TEXT	NOT NULL,
	cstate	CHAR(2) NOT NULL,
	czip	CHAR(5)	NOT NULL,
	ctype	TEXT	NOT NULL,
	PRIMARY KEY (cid)
);

INSERT INTO customers VALUES
(NULL,'Mary','Smith','123 Main Street','Providence', 'RI', '02918', 'Premier');

CREATE TABLE	orders
(
	orderno		INT		AUTO_INCREMENT,
	cid			INT		NOT NULL,
	qty_8493	INT		NOT NULL,
	qty_3423	INT		NOT NULL,
	qty_2382	INT		NOT NULL,
	qty_4523	INT		NOT NULL,
	qty_6851	INT		NOT NULL,
	orderdate	DATETIME NOT NULL,
	fprice	DECIMAL(10,2) NOT NULL,
	PRIMARY KEY (orderno),
	FOREIGN KEY (cid) REFERENCES customers(cid)
);

INSERT INTO orders VALUES
(NULL,1,1,1,1,1,1,NOW(),22.15);

