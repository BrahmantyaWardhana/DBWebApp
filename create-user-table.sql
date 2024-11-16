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