-- Database Creation
CREATE DATABASE IF NOT EXISTS e_commerce
DEFAULT CHARACTER SET utf8mb4
DEFAULT COLLATE utf8mb4_unicode_ci;

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

CREATE TABLE product_reviews (
  review_id INT NOT NULL AUTO_INCREMENT,
  product_id INT NOT NULL,
  user_name VARCHAR(50) NOT NULL,
  rating TINYINT NOT NULL,
  comment TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (review_id),
  FOREIGN KEY (product_id) REFERENCES products(product_id)
    ON DELETE CASCADE 
    ON UPDATE CASCADE
);

-- Insert default admin user (password: admin)
INSERT INTO users (user_name, user_password) VALUES 
    ('admin', '$2y$10$rgbpBjy8fYAGQrdOAEdOoeoPFRFh0R1mywPZ0/eiAc.d7UlNM.wQK');

-- Base categories
INSERT INTO categories (category_name) VALUES
('PC Components'),
('Peripherals'),
('Accessories'),
('Laptops and Desktops');

-- Sample products for 'PC Components'
INSERT INTO products (category_id, product_name, price, product_image, detail, stock) VALUES
(1, 'AMD Ryzen 7 5800X', 4650000, '../image/products/ryzen7_5800x.jpg', '8-core, 16-thread unlocked desktop processor for AM4 socket', 'Available'),
(1, 'Intel Core i7-12700K', 5950000, '../image/products/i7_12700k.jpg', '12-core (8P+4E) processor with integrated graphics', 'Available'),
(1, 'NVIDIA GeForce RTX 4070 Ti', 12899000, '../image/products/rtx_4070ti.jpg', '12GB GDDR6X GPU with DLSS 3 and Ray Tracing support', 'Available'),
(1, 'Corsair Vengeance LPX 16GB DDR4 3200MHz', 975000, '../image/products/corsair_ddr4_16gb.jpg', 'High-performance DDR4 RAM kit (2x8GB)', 'Available'),
(1, 'Samsung 980 PRO 1TB NVMe SSD', 2099000, '../image/products/samsung_980pro.jpg', 'PCIe Gen4 NVMe SSD with read speeds up to 7000MB/s', 'Available');

-- Sample products for 'Peripherals'
INSERT INTO products (category_id, product_name, price, product_image, detail, stock) VALUES
(2, 'Logitech G Pro X Gaming Headset', 1599000, '../image/products/logitech_gpro_headset.jpg', 'Wired headset with Blue VO!CE mic technology', 'Available'),
(2, 'Razer DeathAdder V2 Gaming Mouse', 799000, '../image/products/razer_deathadder.jpg', 'Ergonomic mouse with 20K DPI optical sensor', 'Available'),
(2, 'Corsair K70 RGB Mechanical Keyboard', 1399000, '../image/products/corsair_k70.jpg', 'Mechanical keyboard with Cherry MX switches and RGB backlight', 'Available'),
(2, 'ASUS TUF Gaming 27” Monitor (VG27AQ)', 5299000, '../image/products/asus_vg27aq.jpg', '2K 165Hz IPS gaming monitor with G-Sync compatibility', 'Available'),
(2, 'Elgato Stream Deck MK.2', 2399000, '../image/products/elgato_streamdeck.jpg', '15 customizable LCD keys for streaming and productivity', 'Available');

-- Sample products for 'Accessories'
INSERT INTO products (category_id, product_name, price, product_image, detail, stock) VALUES
(3, 'Logitech MX Palm Rest', 199000, '../image/products/logitech_palmrest.jpg', 'Soft memory foam palm rest for keyboards', 'Available'),
(3, 'Cooler Master MasterGel Pro V2', 99000, '../image/products/coolermaster_gel.jpg', 'Thermal paste for CPUs and GPUs with improved viscosity', 'Available'),
(3, 'NZXT Puck Cable Organizer', 249000, '../image/products/nzxt_puck.jpg', 'Magnetic headset and cable organizer for PC cases', 'Available'),
(3, 'HyperX Wrist Rest', 149000, '../image/products/hyperx_wristrest.jpg', 'Cooling gel-infused memory foam wrist rest', 'Available'),
(3, 'UGREEN USB 3.0 Hub 4-Port', 179000, '../image/products/ugreen_usb_hub.jpg', 'High-speed USB 3.0 hub with 4 ports and LED indicator', 'Available');

-- Sample products for 'Laptops and Desktops'
INSERT INTO products (category_id, product_name, price, product_image, detail, stock) VALUES
(4, 'Dell XPS 15 (2023)', 30499000, '../image/products/dell_xps15.jpg', 'Intel i7, 16GB RAM, 1TB SSD, NVIDIA RTX 4050, 15.6” OLED display', 'Available'),
(4, 'Apple MacBook Air M2 (2023)', 18999000, '../image/products/macbook_air_m2.jpg', 'M2 chip, 8GB RAM, 256GB SSD, 13.6-inch Retina display', 'Available'),
(4, 'Lenovo Legion 5 Pro', 23990000, '../image/products/lenovo_legion5pro.jpg', 'Ryzen 7 6800H, 16GB RAM, RTX 3070, 1TB SSD, 165Hz display', 'Available'),
(4, 'HP Pavilion Desktop TG01-2003w', 11750000, '../image/products/hp_pavilion_tg01.jpg', 'Intel Core i5, 12GB RAM, 512GB SSD, GTX 1660 Super', 'Available'),
(4, 'MSI Stealth 16 Studio', 32999000, '../image/products/msi_stealth_16.jpg', 'Intel i9, 32GB RAM, RTX 4080, 1TB SSD, 240Hz QHD+ display', 'Available');

-- Sample reviews
INSERT INTO product_reviews (product_id, user_name, rating, comment, created_at) VALUES
(1, 'Alex', 5, 'This is great!', '2025-05-18 13:51:31'),
(2, 'Gisselle', 4, 'wow, i have never seen this before!', '2025-05-18 13:55:47');
