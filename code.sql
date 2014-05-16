DROP DATABASE IF EXISTS BankingDB;
CREATE DATABASE BankingDB;
USE BankingDB;

CREATE TABLE user(username CHAR(8),
	password CHAR(15),
	PRIMARY KEY (username)) ENGINE=InnoDB;

CREATE TABLE customer (id CHAR(8) PRIMARY KEY,
	name_first VARCHAR(22),
	name_last VARCHAR(16),
	address VARCHAR(50),
	birthdate DATETIME,
	FOREIGN KEY (id) REFERENCES user(username)) ENGINE=InnoDB;
	
CREATE TABLE bank(bank_id CHAR(8) PRIMARY KEY,
	name CHAR(50)) ENGINE=InnoDB;
	
CREATE TABLE branch(name CHAR(12) ,
	bank_id CHAR(8),
	address CHAR(50),
	balance INTEGER,
	PRIMARY KEY(name, bank_id),
	FOREIGN KEY (bank_id) REFERENCES bank(bank_id)) ENGINE=InnoDB;
	
CREATE TABLE account (id CHAR(8) PRIMARY KEY,
	bank_id CHAR(8),
	branch_name CHAR(12),
	IBAN VARCHAR(34),
	balance DOUBLE,
	currency CHAR(3),
	dateCreated DATETIME,
	FOREIGN KEY (bank_id,branch_name) REFERENCES branch(bank_id,name)) ENGINE=InnoDB;
	
CREATE TABLE saving_account (id CHAR(8) PRIMARY KEY,
	interest_rate DOUBLE,
	date_start DATETIME,
	date_end DATETIME,
	FOREIGN KEY (id) REFERENCES account(id)) ENGINE=InnoDB;
	
CREATE TABLE business_account (id CHAR(8) PRIMARY KEY,
	tax_id CHAR(12),
	FOREIGN KEY (id) REFERENCES account(id)) ENGINE=InnoDB;

CREATE TABLE loan(loan_id CHAR(8) PRIMARY KEY,
	interest_rate DOUBLE,
	amount INTEGER,
	date_given DATETIME,
	date_due DATETIME,
	is_approved BOOLEAN);
	
CREATE TABLE staff (id CHAR(8) PRIMARY KEY,
	salary INTEGER,
	name VARCHAR(22),
	surname VARCHAR(16),
	phone_number VARCHAR(20),
	address VARCHAR(50),
	FOREIGN KEY (id) REFERENCES user(username)) ENGINE=InnoDB;
	
CREATE TABLE customer_assistant (id CHAR(8) PRIMARY KEY,
	FOREIGN KEY (id) REFERENCES staff(id)) ENGINE=InnoDB;
	
CREATE TABLE clerk (id CHAR(8) PRIMARY KEY,
	title VARCHAR(20),
	FOREIGN KEY (id) REFERENCES staff(id)) ENGINE=InnoDB;
	
CREATE TABLE manager(id CHAR(8) PRIMARY KEY,
	admin BOOLEAN,
	FOREIGN KEY (id) REFERENCES staff(id)) ENGINE=InnoDB;

CREATE TABLE bills(bill_id CHAR(8) PRIMARY KEY,
	amount DOUBLE,
	date DATETIME);
	
CREATE TABLE corporation(company_id CHAR(8) PRIMARY KEY,
	name VARCHAR(20),
	account_IBAN VARCHAR(34)) ENGINE=InnoDB;
	
CREATE TABLE atm(atm_id CHAR(8),
	address CHAR(50),
	balance INTEGER,
	PRIMARY KEY(atm_id)) ENGINE=InnoDB;
	
CREATE TABLE card(card_number CHAR(16) PRIMARY KEY,
	valid_until DATETIME,
	is_approved BOOLEAN,
	PIN CHAR(4)) ENGINE=InnoDB;
	
CREATE TABLE account_card(card_number CHAR(16) PRIMARY KEY,
	FOREIGN KEY (card_number) REFERENCES card(card_number)) ENGINE=InnoDB;
	
CREATE TABLE credit_card(card_number CHAR(16) PRIMARY KEY,
	limit_of_card INTEGER,
	statement_date INTEGER,
	FOREIGN KEY (card_number) REFERENCES card(card_number)) ENGINE=InnoDB;
	
CREATE TABLE installment(id CHAR(8) PRIMARY KEY,
	total_amount DOUBLE) ENGINE=InnoDB;
	
CREATE TABLE sub_installment(id INTEGER,
	sub_id INTEGER,
	amount DOUBLE,
	due_date DATETIME,
	PRIMARY KEY (id,sub_id)) ENGINE=InnoDB;

CREATE TABLE customer_accounts(cid CHAR(8),
	aid CHAR(8),
	PRIMARY KEY (cid, aid),
	FOREIGN KEY (cid) REFERENCES customer(id),
	FOREIGN KEY (aid) REFERENCES account(id)) ENGINE=InnoDB;
	
CREATE TABLE money_transfers(to_id CHAR(8),
	from_id CHAR(8),
	cid CHAR(8),
	amount INTEGER,
	date DATETIME,
	description VARCHAR(50),
	PRIMARY KEY(to_id, from_id, cid, date),
	FOREIGN KEY (to_id) REFERENCES account (id),
	FOREIGN KEY (from_id) REFERENCES account (id),
	FOREIGN KEY (cid) REFERENCES customer(id)) ENGINE=InnoDB;
	
CREATE TABLE bill_target(bill_id CHAR(8) PRIMARY KEY,
	company_id CHAR(8),
	FOREIGN KEY (bill_id) REFERENCES bills(bill_id),
	FOREIGN KEY (company_id) REFERENCES corporation(company_id)) ENGINE=InnoDB;
	
CREATE TABLE transactions(cid CHAR(8),
	aid CHAR(8),
	atm_id CHAR(8),
	amount INTEGER,
	date DATETIME,
	type CHAR(8),
	CHECK (type IN ('deposit', 'withdraw')),
	PRIMARY KEY (cid, aid, atm_id),
	FOREIGN KEY (cid) REFERENCES customer(id),
	FOREIGN KEY (aid) REFERENCES account(id),
	FOREIGN KEY (atm_id) REFERENCES atm(atm_id)) ENGINE=InnoDB;
	
CREATE TABLE loan_payments(loan_id CHAR(8),
	date DATETIME,
	amount INTEGER,
	cid CHAR(8),
	PRIMARY KEY(loan_id, date),
	FOREIGN KEY (loan_id) REFERENCES loan(loan_id),
	FOREIGN KEY (cid) REFERENCES customer(id)) ENGINE=InnoDB;
	
CREATE TABLE works_at (id CHAR(8) PRIMARY KEY,
	bank_id CHAR(8),
	bname CHAR(12),
	FOREIGN KEY (id) REFERENCES staff(id),
	FOREIGN KEY (bank_id, bname) REFERENCES branch(bank_id, name)) ENGINE=InnoDB;
	
CREATE TABLE payment (card_number CHAR(16),
	ins_id CHAR(8),
	c_id CHAR(8),
	a_id CHAR(8),
	FOREIGN KEY (c_id) REFERENCES customer(id),
	FOREIGN KEY (a_id) REFERENCES business_account(id),
	FOREIGN KEY (ins_id) REFERENCES installment(id),
	FOREIGN KEY (card_number) REFERENCES card(card_number),
	PRIMARY KEY (card_number, ins_id,c_id, a_id)) ENGINE=InnoDB;
	
CREATE TABLE pay_bills (bill_id CHAR(8) PRIMARY KEY,
	aid CHAR(8),
	cid CHAR(8),
	FOREIGN KEY (bill_id) REFERENCES bills(bill_id),
	FOREIGN KEY (aid) REFERENCES account(id),
	FOREIGN KEY(cid) REFERENCES customer(id)) ENGINE=InnoDB;
	
CREATE TABLE account_cards(card_number CHAR(12),
	cid CHAR(8),
	aid CHAR(8),
	PRIMARY KEY(card_number),
	FOREIGN KEY (card_number) REFERENCES card(card_number),
	FOREIGN KEY (cid) REFERENCES customer(id)) ENGINE=InnoDB;
	
CREATE TABLE atms(atm_id CHAR(8),
	branch_name CHAR(12),
	bank_id CHAR(8),
	PRIMARY KEY(atm_id),
	FOREIGN KEY (atm_id) REFERENCES atm(atm_id),
	FOREIGN KEY (bank_id) REFERENCES branch(bank_id),
	FOREIGN KEY (branch_name) REFERENCES branch(name)) ENGINE=InnoDB;
	
CREATE TABLE borrowing(loan_id CHAR(8),
	branch_name CHAR(12),
	bank_id CHAR(8),
	cid CHAR(8),
	PRIMARY KEY(loan_id),
	FOREIGN KEY (loan_id) REFERENCES loan(loan_id),
	FOREIGN KEY (cid) REFERENCES customer(id),
	FOREIGN KEY (branch_name, bank_id) REFERENCES branch(name,bank_id)) ENGINE=InnoDB;
	
CREATE TABLE credit_cards(cust_id CHAR(8),
	card_number CHAR(16),
	PRIMARY KEY(card_number),
	FOREIGN KEY (card_number) REFERENCES credit_card(card_number),
	FOREIGN KEY (cust_id) REFERENCES customer(id)) ENGINE=InnoDB;

/*1) BusinessCustomer View*/
CREATE VIEW business_customer AS
        SELECT C.* FROM customer C, customer_accounts R, business_account B
        WHERE C.id=R.cid and R.aid=B.id;


/*2) View Accounts of the Same Branch with Stuff*/
/*
CREATE VIEW branch_accounts AS
        SELECT * FROM account NATURAL JOIN
        (SELECT id, 'Business Account' as type FROM business_account
        UNION
        SELECT id, 'Saving Account' as type FROM saving_account)
        WHERE bank_id=@bank_id and branch_name=@bname;*/
/*
CREATE TRIGGER ATM_out_of_money
        AFTER UPDATE OF balance ON (atm)
REFERENCING NEW ROW AS nrow
REFERENCING OLD ROW AS orow
WHEN nrow.balance < 0 AND orow.balance IS NOT NULL
BEGIN ATOMIC
        UPDATE transactions T
        SET (
                SELECT amount FROM T
                WHERE T.aid = orow.atm_id
                ).amount = orow.balance
        SET nrow.balance = 0;
END;

CREATE TRIGGER acc_money 
        AFTER UPDATE OF balance ON (account)
REFERENCING NEW ROW AS nrow
REFERENCING OLD ROW AS orow
WHEN nrow.balance < 0 AND orow.balance IS NOT NULL
BEGIN
        ROLLBACK
END;
*/


INSERT INTO `user` (`username`, `password`) VALUES ('root', 'root');
INSERT INTO `user` (`username`, `password`) VALUES ('111', '111');
INSERT INTO `user` (`username`, `password`) VALUES ('1234', '1234');
INSERT INTO `user` (`username`, `password`) VALUES ('16658', '798678934tere');
INSERT INTO `user` (`username`, `password`) VALUES ('16758', '7986789');
INSERT INTO `user` (`username`, `password`) VALUES ('18726', '54321');
INSERT INTO `user` (`username`, `password`) VALUES ('32588', '54321');

INSERT INTO `customer` (`id`, `name_first`, `name_last`, `address`, `birthdate`) VALUES ('111', 'dsa', 'qwe', 'weasdqwe', '2014-01-05');
INSERT INTO `customer` (`id`, `name_first`, `name_last`, `address`, `birthdate`) VALUES ('16758', 'Osman', 'Hakan John', 'wefsdrwety', '2014-05-05');
INSERT INTO `customer` (`id`, `name_first`, `name_last`, `address`, `birthdate`) VALUES ('18726', 'Osman', 'asd', '09opp*0', '2014-05-22');
INSERT INTO `customer` (`id`, `name_first`, `name_last`, `address`, `birthdate`) VALUES ('32588', 'Hakan', 'Can', 'Mellbourne', '2014-05-05');
INSERT INTO `customer` (`id`, `name_first`, `name_last`, `address`, `birthdate`) VALUES ('root', 'Afsg', 'Sad', 'ankara', '2014-05-13');

INSERT INTO `bank` (`bank_id`, `name`) VALUES ('1', 'The Bank of Isengard');

INSERT INTO `branch` (`name`, `bank_id`, `address`, `balance`) VALUES ('bilkent', '1', 'bilkent', '180000');

INSERT INTO `branch` (`name`, `bank_id`, `address`, `balance`) VALUES ('Istanbul', '1', 'Ataşehir', '60000');

INSERT INTO `account` (`id`, `bank_id`, `branch_name`, `IBAN`, `balance`, `currency`, `dateCreated`) VALUES ('15048', '1', 'bilkent', '789789789789789789789', '500', 'tl', '2014-05-13');
INSERT INTO `account` (`id`, `bank_id`, `branch_name`, `IBAN`, `balance`, `currency`, `dateCreated`) VALUES ('19791', '1', 'bilkent', '4325234523', '0', 'tl', '2014-05-14');
INSERT INTO `account` (`id`, `bank_id`, `branch_name`, `IBAN`, `balance`, `currency`, `dateCreated`) VALUES ('21157', '1', 'bilkent', '43211234', '0', 'tl', '2014-05-14');
INSERT INTO `account` (`id`, `bank_id`, `branch_name`, `IBAN`, `balance`, `currency`, `dateCreated`) VALUES ('26983', '1', 'bilkent', '94325234523', '0', 'tl', '2014-05-14');
INSERT INTO `account` (`id`, `bank_id`, `branch_name`, `IBAN`, `balance`, `currency`, `dateCreated`) VALUES ('2965', '1', 'bilkent', '1194', '0', 'tl', '2014-05-14');
INSERT INTO `account` (`id`, `bank_id`, `branch_name`, `IBAN`, `balance`, `currency`, `dateCreated`) VALUES ('5959', '1', 'bilkent', '57567867', '0', 'tl', '2014-05-14');
INSERT INTO `account` (`id`, `bank_id`, `branch_name`, `IBAN`, `balance`, `currency`, `dateCreated`) VALUES ('887', '1', 'bilkent', '27620', '0', 'tl', '2014-05-14');

INSERT INTO `business_account` (`id`, `tax_id`) VALUES ('19791', '11484');

INSERT INTO `customer_accounts` (`cid`, `aid`) VALUES ('32588', '19791');
INSERT INTO `customer_accounts` (`cid`, `aid`) VALUES ('18726', '26983');
INSERT INTO `customer_accounts` (`cid`, `aid`) VALUES ('32588', '5959');
INSERT INTO `customer_accounts` (`cid`, `aid`) VALUES ('16758', '887');

INSERT INTO `saving_account` (`id`, `interest_rate`, `date_start`, `date_end`) VALUES ('5959', '15220', '2014-05-14', '2014-05-22');

INSERT INTO `card` (`card_number`, `valid_until`, `is_approved`, `PIN`) VALUES ('43214321', '2014-05-24', '0', '3333');
INSERT INTO `card` (`card_number`, `valid_until`, `is_approved`, `PIN`) VALUES ('534535', '2014-05-06', '0', '1523');

INSERT INTO `loan` (`loan_id`, `interest_rate`, `date_given`, `date_due`, `is_approved`) VALUES ('153', '12', '2014-05-01', '2014-05-22', '0');
INSERT INTO `loan` (`loan_id`, `interest_rate`, `date_given`, `date_due`, `is_approved`) VALUES ('657', '657897', '2014-05-03', '2014-05-12', '0');

INSERT INTO `borrowing` (`loan_id`, `branch_name`, `bank_id`, `cid`) VALUES ('153', 'Istanbul', '1', '32588');
INSERT INTO `borrowing` (`loan_id`, `branch_name`, `bank_id`, `cid`) VALUES ('657', 'Istanbul', '1', '32588');

INSERT INTO `credit_card` (`card_number`, `limit_of_card`, `statement_date`) VALUES ('43214321', '123', '8');
INSERT INTO `credit_card` (`card_number`, `limit_of_card`, `statement_date`) VALUES ('534535', '5235', '8');

INSERT INTO `credit_cards` (`cust_id`, `card_number`) VALUES ('32588', '43214321');
INSERT INTO `credit_cards` (`cust_id`, `card_number`) VALUES ('32588', '534535');

INSERT INTO `bills` (`bill_id`, `amount`, `date`) VALUES ('9834', '78', '2014-05-30');

INSERT INTO `staff` (`id`, `salary`, `name`, `surname`, `phone_number`, `address`) VALUES ('1234', '11111', 'Hakan', 'Osman2', '9999999', 'Birmingham');
INSERT INTO `staff` (`id`, `salary`, `name`, `surname`, `phone_number`, `address`) VALUES ('root', '0', 'root', 'root', '-', '-');

INSERT INTO `manager` (`id`, `admin`) VALUES ('root', '1');

INSERT INTO `customer_assistant` (`id`) VALUES ('1234');
	
INSERT INTO `installment` (`id`, `total_amount`) VALUES ('2382', '10000');
INSERT INTO `installment` (`id`, `total_amount`) VALUES ('19807', '10000');
INSERT INTO `installment` (`id`, `total_amount`) VALUES ('24699', '10000');
INSERT INTO `installment` (`id`, `total_amount`) VALUES ('5652', '10000');

INSERT INTO `payment` (`card_number`, `ins_id`, `c_id`, `a_id`) VALUES ('43214321', '2382', '32588', '19791');
INSERT INTO `payment` (`card_number`, `ins_id`, `c_id`, `a_id`) VALUES ('534535', '19807', '32588', '19791');
INSERT INTO `payment` (`card_number`, `ins_id`, `c_id`, `a_id`) VALUES ('534535', '24699', '32588', '19791');
INSERT INTO `payment` (`card_number`, `ins_id`, `c_id`, `a_id`) VALUES ('534535', '5652', '32588', '19791');
