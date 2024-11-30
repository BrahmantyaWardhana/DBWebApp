-- Table creation and values
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    role ENUM('admin', 'staff') NOT NULL,
);

INSERT INTO users (username, password, role) VALUES
('admin', 'admin', 'admin'),
('staff', 'staff', 'staff');

-- User creation for DB connection (all privilege)
CREATE USER 'test'@'%' IDENTIFIED BY 'test';

GRANT ALL PRIVILEGES ON *.* TO 'test'@'%';

FLUSH PRIVILEGES;

-- Create Tables

-- Doctors
CREATE TABLE Doctor (
    doctorID INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(25),
    lastName VARCHAR(25),
    specialization VARCHAR(40),
    status ENUM('active', 'inactive') NOT NULL,
    email VARCHAR(40),
    clinicID int,
    FOREIGN KEY (clinicID) REFERENCES Clinic(clinicID)
);

-- Patients
CREATE TABLE Patients (
    patientID INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(25),
    lastName VARCHAR(25),
    phone VARCHAR(25),
    email VARCHAR(40),
    address VARCHAR(70),
    gender VARCHAR(30),
    birthdate DATE
);

-- Appointment
CREATE TABLE Appointment (
    apptID INT AUTO_INCREMENT PRIMARY KEY,
    patientID INT,
    doctorID INT,
    apptDate DATE,
    apptTime TIME,
    status ENUM('scheduled', 'completed', 'canceled') NOT NULL,
    reasonForVisit VARCHAR(255),
    FOREIGN KEY (patientID) REFERENCES Patients(patientID),
    FOREIGN KEY (doctorID) REFERENCES Doctor(doctorID)
);

-- Payment
CREATE TABLE Payments (
    paymentID INT AUTO_INCREMENT PRIMARY KEY,
    apptID INT,
    amount DECIMAL(10, 2) NOT NULL,
    paymentDate DATE,
    paymentMethod ENUM('credit_card', 'cash', 'insurance', 'other') NOT NULL,
    status ENUM('paid', 'pending') NOT NULL,
    FOREIGN KEY (apptID) REFERENCES Appointment(apptID)
);

-- Schedule
CREATE TABLE Schedule (
    scheduleID INT AUTO_INCREMENT PRIMARY KEY,
    doctorID INT,
    dayOfWeek ENUM('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday') NOT NULL,
    startTime TIME NOT NULL,
    endTime TIME NOT NULL,
    clinicName VARCHAR(100) NOT NULL,
    FOREIGN KEY (doctorID) REFERENCES Doctor(doctorID)
);

-- Clinic
CREATE TABLE Clinic (
    clinicID INT AUTO_INCREMENT PRIMARY KEY,
    clinicName VARCHAR(100) NOT NULL,
    address VARCHAR(255) NOT NULL
);

-- Insert values for testing

INSERT INTO Clinic (clinicName, address) VALUES
('Downtown Health Clinic', '123 W Randolph St, Chicago, IL 60601'),
('Uptown Family Care', '456 W Dakin St, Chicago, IL 60613'),
('Eastside Medical Center', '789 E 79th St, Chicago, IL 60619');

INSERT INTO Doctor (firstName, lastName, specialization, status, email) VALUES
('John', 'Doe', 'Cardiology', 'active', 'jdoe@hospital.com'),
('Jane', 'Smith', 'Pediatrics', 'inactive', 'jsmith@hospital.com');
