-- Database Creation
CREATE DATABASE e_commerce;
USE e_commerce;

-- Table structure for categories
CREATE TABLE categories (
    category_id INT NOT NULL AUTO_INCREMENT,
    category_name VARCHAR(100) NOT NULL,
    PRIMARY KEY (category_id)
);

-- Table structure for products
CREATE TABLE products (
    product_id INT NOT NULL AUTO_INCREMENT,
    category_id INT NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    price DOUBLE NOT NULL,
    product_image VARCHAR(255) NOT NULL,
    detail TEXT NOT NULL,
    stock ENUM('Available', 'Empty') NOT NULL DEFAULT 'Available',
    PRIMARY KEY (product_id),
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
        ON DELETE CASCADE 
        ON UPDATE CASCADE
);

-- Table structure for users
CREATE TABLE users (
    user_id INT NOT NULL AUTO_INCREMENT,
    user_name VARCHAR(50) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    PRIMARY KEY (user_id)
);

-- Insert default admin user
INSERT INTO users (user_name, user_password) VALUES 
    ('admin', '$2y$10$rgbpBjy8fYAGQrdOAEdOoeoPFRFh0R1mywPZ0/eiAc.d7UlNM.wQK');

-- Set auto increment starting values
ALTER TABLE categories AUTO_INCREMENT = 6;
ALTER TABLE products AUTO_INCREMENT = 7;
ALTER TABLE users AUTO_INCREMENT = 2;
