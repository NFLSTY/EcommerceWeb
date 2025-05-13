CREATE DATABASE marketplace
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- Use the database
USE marketplace;

CREATE TABLE users (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(50) NOT NULL,
	password VARCHAR(255) NOT NULL
);

CREATE TABLE main_categories (
    main_category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    image_url VARCHAR(255)
);

CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    main_category_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    FOREIGN KEY (main_category_id) REFERENCES main_categories(main_category_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE product (
	product_id INT AUTO_INCREMENT PRIMARY KEY,
	category_id INT NOT NULL,
	name VARCHAR(255) NOT NULL,
	price DOUBLE NOT NULL,
	image_url VARCHAR(255) NOT NULL,
	detail TEXT NOT NULL,
	stock ENUM('Available','Empty') NOT NULL DEFAULT 'Available',
	FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE CASCADE ON UPDATE CASCADE
);



INSERT INTO main_categories (name, image_url)
VALUES 
('PC Components', 'images/categories/pc_components.jpg'),
('Peripherals', 'images/categories/peripherals.jpg'),
('Laptops and Desktops', 'images/categories/laptops_and_desktops.jpg'),
('Accessories and Merch', 'images/categories/accessories.jpg');

INSERT INTO categories (main_category_id, name)
VALUES
-- PC Components
(1, 'Graphics Cards'),
(1, 'CPUs'),
(1, 'Motherboards'),
(1, 'RAM'),
(1, 'Power Supplies'),

-- Peripherals
(2, 'Keyboards'),
(2, 'Mice'),
(2, 'Headsets'),
(2, 'Monitors'),
(2, 'Controllers'),

-- Laptops & Desktops
(3, 'Gaming Laptops'),
(3, 'Prebuilt PCs'),
(3, 'Mini Gaming PCs'),

-- Accessories & Merch
(4, 'Mousepads'),
(4, 'Gaming Chairs'),
(4, 'Apparel'),
(4, 'Posters');
