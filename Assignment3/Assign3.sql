
GRANT ALL ON bank.* TO 'root'@'localhost';

CREATE DATABASE bank;

USE bank;

CREATE TABLE BANK
	(
	Code VARCHAR(10) NOT NULL,
	Name VARCHAR(20) NOT NULL,
	Addr TEXT,

	PRIMARY KEY(Code)
	);
	
CREATE TABLE BANK_BRANCH
	(
	Br_Addr TEXT NOT NULL,
	Branch_no VARCHAR(10) NOT NULL,
	Bcode VARCHAR(10) NOT NULL,

	PRIMARY KEY(Bcode, Branch_no),
	FOREIGN KEY(Bcode) REFERENCES BANK(Code)
	);

CREATE TABLE ACCOUNT
	(
	Acct_no VARCHAR(10) NOT NULL,
	Balance DECIMAL(10,2) NOT NULL,
	Type VARCHAR(15) NOT NULL,
	Abranch_no VARCHAR(10) NOT NULL,
	Abcode VARCHAR(10) NOT NULL,

	PRIMARY KEY(Acct_no),
	FOREIGN KEY(Abcode, Abranch_no) REFERENCES BANK_BRANCH(Bcode, Branch_no)
	);

CREATE TABLE LOAN
	(
	Loan_no VARCHAR(10) NOT NULL,
	Amount DECIMAL(10,2) NOT NULL,
	Type VARCHAR(15) NOT NULL,
	Lbranch_no VARCHAR(10) NOT NULL,
	Lbcode VARCHAR(10) NOT NULL,

	PRIMARY KEY(Loan_no),
	FOREIGN KEY(Lbcode, Lbranch_no) REFERENCES BANK_BRANCH(Bcode, Branch_no)
	);

CREATE TABLE CUSTOMER
	(
	SSN CHAR(9) NOT NULL,
	Phone CHAR(10) NOT NULL,
	Name VARCHAR(30) NOT NULL,
	Addr TEXT,

	PRIMARY KEY(SSN)
	);

CREATE TABLE C_ACCOUNT
	(
	Cacct_no VARCHAR(10) NOT NULL,
	CSSN CHAR(9) NOT NULL,
	
	PRIMARY KEY(Cacct_no),
	FOREIGN KEY(Cacct_no) REFERENCES ACCOUNT(Acct_no),
	FOREIGN KEY(CSSN) REFERENCES CUSTOMER(SSN)
	);

CREATE TABLE C_LOAN
	(
	Cloan_no VARCHAR(10) NOT NULL,
	CSSN CHAR(9) NOT NULL,
	
	PRIMARY KEY(Cloan_no),
	FOREIGN KEY(Cloan_no) REFERENCES LOAN(Loan_no),
	FOREIGN KEY(CSSN) REFERENCES CUSTOMER(SSN)
	);

INSERT INTO BANK VALUES
('SAN5225', 'Santander', '345 Main Street, New York, NY'),
('WEFA4112', 'Wells Fargo', '999 Pine Cone Rd, Sartell, MN'),
('USB8989', 'US Bank', NULL);

INSERT INTO BANK_BRANCH VALUES
('1000 4th Ave. S., Providence, RI', '892', 'USB8989'),
('41 Smith St., Seattle, WA', '34', 'USB8989'),
('1 3rd St. SW, Minneapolis, MN', '4180', 'WEFA4112'),
('8818 Wallaby Way, Boston, MA', '251', 'SAN5225'),
('788 Yellow Rd, Smithfield, RI', '344', 'SAN5225');

INSERT INTO ACCOUNT VALUES
('2222222222', '34900.12', 'Savings', '892', 'USB8989'),
('3333344444', '8341.92', 'Checking', '892', 'USB8989'),
('1122399999', '325.10', 'Checking', '34', 'USB8989'),
('0000099888', '348002.00', 'Savings', '251', 'SAN5225'),
('3333333300', '32593.00', 'Savings', '251', 'SAN5225'),
('2000000000', '432293.18', 'Checking', '251', 'SAN5225'),
('5555566666', '3223.99', 'Checking', '344', 'SAN5225'),
('7777777777', '1821.00', 'Checking', '344', 'SAN5225'),
('0101010101', '9923.11', 'Checking', '344', 'SAN5225');

INSERT INTO LOAN VALUES
('09090909', '30000.00', 'Student', '4180', 'WEFA4112'),
('12121212', '205000.00', 'Mortgage', '4180', 'WEFA4112'),
('30303030', '15500.00', 'Student', '4180', 'WEFA4112'),
('65656565', '480000.00', 'Small Business', '34', 'USB8989'),
('12312312', '42200.00', 'Personal', '34', 'USB8989'),
('45674567', '13000.00', 'Auto', '892', 'USB8989'),
('88898889', '6000.00', 'Student', '892', 'USB8989');

INSERT INTO CUSTOMER VALUES
('333333333', '4013333333', 'John Smith', '32 5th Ave, Pittsburg, PA'),
('499999999', '3209999999', 'Sammy Evans', '4121 Walker Road, Houston, TX'),
('018888888', '4003333333', 'Madison Kowalski', NULL),
('122122122', '6123334433', 'Clare Minnerath', '90 Eaton St., Providence, RI'),
('778877888', '1221432222', 'George McKinley', '12 Wisker Drive, Seattle, WA'),
('999111999', '3209992222', 'Amy Jones', '322 Main St., Mansfield, MA'),
('444331111', '9204444444', 'Peter Rindall', NULL),
('422322222', '4761111111', 'Avery Fransoo', '43 Skyview Rd, Denver, CO'),
('122100000', '8888888888', 'Nicole Hanover', '9300 River Rd, Sartell, MN'),
('492042888', '2112040049', 'Jacob Scholm', NULL),
('764400230', '6666633333', 'Shawn Donovan', '88 93rd Ave N, Grand Forks, ND');

INSERT INTO C_ACCOUNT VALUES
('2222222222', '333333333'),
('3333344444', '333333333'),
('1122399999', '499999999'),
('0000099888', '018888888'),
('2000000000', '018888888'),
('3333333300', '122122122'),
('5555566666', '778877888'),
('7777777777', '999111999'),
('0101010101', '444331111');

INSERT INTO C_LOAN VALUES
('09090909', '018888888'),
('12121212', '999111999'),
('30303030', '422322222'),
('65656565', '122100000'),
('12312312', '492042888'),
('45674567', '764400230'),
('88898889', '764400230');

DESCRIBE BANK;

DESCRIBE BANK_BRANCH;

DESCRIBE ACCOUNT;

DESCRIBE LOAN;

DESCRIBE CUSTOMER;

DESCRIBE C_ACCOUNT;

DESCRIBE C_LOAN;

SELECT Name FROM BANK;

SELECT Name, Branch_no FROM BANK, BANK_BRANCH WHERE Code = Bcode;

SELECT Name FROM CUSTOMER;

SELECT Name, Cacct_no FROM CUSTOMER, C_ACCOUNT WHERE SSN = CSSN;

SELECT Name, Br_Addr FROM CUSTOMER, C_LOAN, LOAN, BANK_BRANCH WHERE SSN = CSSN AND Cloan_no = Loan_no AND Lbcode = Bcode AND Lbranch_no = Branch_no;


