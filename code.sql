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
	birthdate DATE,
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
	dateCreated DATE,
	FOREIGN KEY (bank_id) REFERENCES branch(bank_id),
	FOREIGN KEY (branch_name) REFERENCES branch(name)) ENGINE=InnoDB;
	
CREATE TABLE saving_account (id CHAR(8) PRIMARY KEY,
	interest_rate DOUBLE,
	date_start DATE,
	date_end DATE,
	FOREIGN KEY (id) REFERENCES account(id)) ENGINE=InnoDB;
	
CREATE TABLE business_account (id CHAR(8) PRIMARY KEY,
	tax_id CHAR(12),
	FOREIGN KEY (id) REFERENCES account(id)) ENGINE=InnoDB;

CREATE TABLE loan(loan_id CHAR(8) PRIMARY KEY,
	interest_rate DOUBLE,
	date_given DATE,
	date_due DATE,
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
	date DATE);
	
CREATE TABLE corporation(company_id CHAR(8) PRIMARY KEY,
	name VARCHAR(20),
	account_IBAN VARCHAR(34)) ENGINE=InnoDB;
	
CREATE TABLE atm(atm_id CHAR(8),
	address CHAR(50),
	balance INTEGER,
	PRIMARY KEY(atm_id)) ENGINE=InnoDB;
	
CREATE TABLE card(card_number CHAR(16) PRIMARY KEY,
	valid_until DATE,
	is_approved BOOLEAN,
	PIN CHAR(4)) ENGINE=InnoDB;
	
CREATE TABLE account_card(card_number CHAR(16) PRIMARY KEY,
	FOREIGN KEY (card_number) REFERENCES card(card_number)) ENGINE=InnoDB;
	
CREATE TABLE credit_card(card_number CHAR(16) PRIMARY KEY,
	limit_of_card INTEGER,
	statement_date DATE,
	FOREIGN KEY (card_number) REFERENCES card(card_number)) ENGINE=InnoDB;
	
CREATE TABLE installment(id CHAR(8) PRIMARY KEY,
	total_amount DOUBLE) ENGINE=InnoDB;
	
CREATE TABLE sub_installment(id INTEGER,
	sub_id INTEGER,
	amount DOUBLE,
	due_date DATE,
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
	date DATE,
	description VARCHAR(50),
	PRIMARY KEY(to_id, from_id, cid),
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
	date DATE,
	type CHAR(8),
	CHECK (type IN ('deposit', 'withdraw')),
	PRIMARY KEY (cid, aid, atm_id),
	FOREIGN KEY (cid) REFERENCES customer(id),
	FOREIGN KEY (aid) REFERENCES account(id),
	FOREIGN KEY (atm_id) REFERENCES atm(atm_id)) ENGINE=InnoDB;
	
CREATE TABLE loan_payments(loan_id CHAR(8),
	date DATE,
	amount INTEGER,
	cid CHAR(8),
	PRIMARY KEY(loan_id, date),
	FOREIGN KEY (loan_id) REFERENCES loan(loan_id),
	FOREIGN KEY (cid) REFERENCES customer(id)) ENGINE=InnoDB;
	
CREATE TABLE works_at (id CHAR(8) PRIMARY KEY,
	bank_id CHAR(8),
	bname CHAR(12),
	name VARCHAR(12),
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
	
CREATE TABLE credit_cards(customer_number CHAR(12),
	cid CHAR(8),
	PRIMARY KEY(customer_number),
	FOREIGN KEY (customer_number) REFERENCES credit_card(card_number),
	FOREIGN KEY (cid) REFERENCES customer(id)) ENGINE=InnoDB;



INSERT INTO `user` (`username`, `password`) VALUES ('root', 'root');
INSERT INTO `customer` (`id`, `name_first`, `name_last`, `address`, `birthdate`) VALUES ('root', 'Afsg', 'Sad', 'ankara', '2014-05-13');
INSERT INTO `bank` (`bank_id`, `name`) VALUES ('1', 'The Bank of Isengard');

