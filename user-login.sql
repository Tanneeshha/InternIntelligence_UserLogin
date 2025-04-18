CREATE DATABASE IF NOT EXISTS user_auth;
USE user_auth;

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    pass VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (full_name, email, passw)
VALUES ('taneesha', 'taneesha@example.com', '$2y$10$WvjGowGmr99d57ZtMg.AUeEK6i5eHhknkIYbOEUVHgD6Em9iK6jVC');