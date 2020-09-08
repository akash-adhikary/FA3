---doctor_details(doctor_id,doctor_name,specialization_name)
---drug_details(drug_id,drug_name,specialization_name,expiry_date,price_per_unit,quantity_available)
---specialization(specialization_id,specialization_name)
---bill_details(Bill_id,patient_name,patient_age,Doctor_name,bill_amount)

DROP TABLE IF EXISTS drug_details;
DROP TABLE IF EXISTS bill_details;
DROP TABLE IF EXISTS doctor_details;
DROP TABLE IF EXISTS specialization;


--
-- Table structure for table `specialization`
--
CREATE TABLE If NOT EXISTS specialization
(
	specialization_name VARCHAR(255) NOT NULL,
	specialization_id VARCHAR(5) NOT NULL,
	PRIMARY KEY(specialization_name)
)ENGINE=InnoDB ;

--
-- Table structure for table `doctor_details`
--

CREATE TABLE IF NOT EXISTS doctor_details
(	
	doctor_id INT(5) PRIMARY KEY AUTO_INCREMENT,
	doctor_name VARCHAR(255) NOT NULL,
	specialization_name VARCHAR(255) NOT NULL,
	CONSTRAINT dd_sn_fk FOREIGN KEY(specialization_name) REFERENCES specialization(specialization_name)
)ENGINE=InnoDB   AUTO_INCREMENT=5001;

--
-- Table structure for table `drug_details`
--
CREATE TABLE IF NOT EXISTS drug_details
(
	drug_id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	drug_name VARCHAR(255) NOT NULL,
	specialization_name VARCHAR(255) NOT NULL,
	expiry_date DATE NOT NULL,
	price_per_unit DECIMAL(10,2) NOT NULL,
	quantity_available INT(5) NOT NULL,
	CONSTRAINT DD_SN_FK1 FOREIGN KEY(specialization_name) REFERENCES specialization(specialization_name)
)ENGINE=InnoDB   AUTO_INCREMENT=6001;


	
--
-- Table structure for table `bill_details`
--
CREATE TABLE IF NOT EXISTS bill_details
(
	bill_id INT(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	patient_name VARCHAR(255) NOT NULL,
	patient_age VARCHAR(15) NOT NULL,
	doctor_id INT(5) NOT NULL,
	bill_amount DECIMAL NOT NULL,
	CONSTRAINT BD_DI_FK FOREIGN KEY(doctor_id) REFERENCES doctor_details(doctor_id)
)ENGINE=InnoDB  AUTO_INCREMENT=8001;


---ALTER TABLE drug_details AUTO_INCREMENT=6001;
---ALTER TABLE doctor_details AUTO_INCREMENT=5001;
---ALTER TABLE bill_details AUTO_INCREMENT=8001;

--
-- Dumping data for table `specialization`
--
INSERT specialization 
VALUES
	('General Physician','S101'),
	('Allopath','S102'),
	('Dermatologist','S103'),
	('Dentist','S104');
	
--
-- Dumping data for table `doctor_details`
--

INSERT  doctor_details (doctor_name,specialization_name)  
VALUES 	('Dr B Rajashekar','General Physician'),
		('Dr Sharada Shekar','General Physician'),
		('Dr Sharat Honatti','Allopath'),
		('Dr Janet Alexander','Dermatologist');
			
--
-- Dumping data for table `drug_details`
--	
INSERT INTO drug_details (drug_name,specialization_name,expiry_date,price_per_unit,quantity_available) 
VALUES
	('Amoxicillin','General Physician','2022-01-01',8.50,150),
	('Doxycycline','General Physician','2022-01-01',18.00,200),
	('Codeine','General Physician','2022-01-01',15.50,100),
	('Ibuprofen','General Physician','2022-01-01',10.00,250),
	('Gabapentin','Allopath','2022-01-01',11.50,20),
	('Lyrica','Allopath','2022-01-01',32.00,170),
	('Naproxen','Dentist','2022-01-01',35.00,200),
	('Metoprolol','Dentist','2022-01-01',40.00,100),
	('Tramadol','Dentist','2022-01-01',45.00,70);
