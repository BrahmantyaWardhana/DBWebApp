CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    role ENUM('admin', 'staff') NOT NULL,
);

-- Insert sample admin and staff users
INSERT INTO users (username, password, role) VALUES
('admin', 'admin', 'admin'),
('staff', 'staff', 'staff');