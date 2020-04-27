GRANT ALL ON university.* TO 'root'@'localhost';

DROP DATABASE university;

CREATE DATABASE university;

USE university;

CREATE TABLE STUDENT ( 
Name VARCHAR(30) NOT NULL,
StudentNumber INTEGER NOT NULL,
Class CHAR NOT NULL,
Major CHAR(4),
PRIMARY KEY (StudentNumber) );

CREATE TABLE COURSE ( 
CourseName VARCHAR(30) NOT NULL,
CourseNumber CHAR(8) NOT NULL,
CreditHours INTEGER,
Department CHAR(4),
PRIMARY KEY (CourseNumber),
UNIQUE (CourseName) );

CREATE TABLE PREREQUISITE ( 
CourseNumber CHAR(8) NOT NULL,
PrerequisiteNumber CHAR(8) NOT NULL,
PRIMARY KEY (CourseNumber, PrerequisiteNumber),
FOREIGN KEY (CourseNumber) REFERENCES COURSE (CourseNumber),
FOREIGN KEY (PrerequisiteNumber) REFERENCES COURSE (CourseNumber) );

CREATE TABLE SECTION ( 
SectionIdentifier INTEGER NOT NULL,
CourseNumber CHAR(8) NOT NULL,
Semester VARCHAR(6) NOT NULL,
Year CHAR(4) NOT NULL,
Instructor VARCHAR(15),
PRIMARY KEY (SectionIdentifier),
FOREIGN KEY (CourseNumber) REFERENCES COURSE (CourseNumber) );

CREATE TABLE GRADE_REPORT ( 
StudentNumber INTEGER NOT NULL,
SectionIdentifier INTEGER NOT NULL,
Grade CHAR,
PRIMARY KEY (StudentNumber, SectionIdentifier),
FOREIGN KEY (StudentNumber) REFERENCES STUDENT (StudentNumber),
FOREIGN KEY (SectionIdentifier) REFERENCES  SECTION (SectionIdentifier) );

INSERT INTO STUDENT VALUES 
('Smith', 17, 1, 'CS'),
('Brown', 8, 2, 'CS');

INSERT INTO COURSE VALUES
('Intro to CS', 'CS1310', 4, 'CS'),
('Data Structures', 'CS3320', 4, 'CS'),
('Discrete Math', 'MATH2410', 3, 'MATH'),
('Database', 'CS3380', 3, 'CS');

INSERT INTO SECTION VALUES 
(85, 'MATH2410', 'Fall', '07', 'King'),
(92, 'CS1310', 'Fall', '07', 'Anderson'),
(102, 'CS3320', 'Spring', '08', 'Knuth'),
(112, 'MATH2410', 'Fall', '08', 'Chang'),
(119, 'CS1310', 'Fall', '08', 'Anderson'),
(135, 'CS3380', 'Fall', '08', 'Stone');

INSERT INTO GRADE_REPORT VALUES
(17, 112, 'B'),
(17, 119, 'C'),
(8, 85, 'A'),
(8, 92, 'A'),
(8, 102, 'B'),
(8, 135, 'A');

INSERT INTO PREREQUISITE VALUES
('CS3380', 'CS3320'),
('CS3380', 'MATH2410'),
('CS3320', 'CS1310');

DESCRIBE STUDENT;
DESCRIBE COURSE;
DESCRIBE SECTION;
DESCRIBE GRADE_REPORT;
DESCRIBE PREREQUISITE;

SELECT * FROM STUDENT;
SELECT * FROM COURSE;
SELECT * FROM SECTION;
SELECT * FROM GRADE_REPORT;
SELECT * FROM PREREQUISITE;

