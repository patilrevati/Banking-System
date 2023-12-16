CREATE DATABASE IF NOT EXISTS sparks_bank;

USE sparks_bank;

CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    balance DECIMAL(10, 2) NOT NULL DEFAULT 0
);

INSERT INTO customers (id, name, email, balance) VALUES (01, 'John Doe', 'john@example.com', 1000.00), (02, 'Jane Smith', 'jane@example.com', 1500.50)
-- Add more customer records as needed
