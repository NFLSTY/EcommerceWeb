INSERT INTO categories (name) VALUES
('PC Components'),
('Peripherals'),
('Accessories'),
('Laptops and Desktops');

-- Sample products for 'PC Components'
INSERT INTO products (category_id, name, price, image_url, description, stock) VALUES
(1, 'AMD Ryzen 7 5800X', 4650000, 'images/products/ryzen7_5800x.jpg', '8-core, 16-thread unlocked desktop processor for AM4 socket', 10),
(1, 'Intel Core i7-12700K', 5950000, 'images/products/i7_12700k.jpg', '12-core (8P+4E) processor with integrated graphics', 10),
(1, 'NVIDIA GeForce RTX 4070 Ti', 12899000, 'images/products/rtx_4070ti.jpg', '12GB GDDR6X GPU with DLSS 3 and Ray Tracing support', 10),
(1, 'Corsair Vengeance LPX 16GB DDR4 3200MHz', 975000, 'images/products/corsair_ddr4_16gb.jpg', 'High-performance DDR4 RAM kit (2x8GB)', 10),
(1, 'Samsung 980 PRO 1TB NVMe SSD', 2099000, 'images/products/samsung_980pro.jpg', 'PCIe Gen4 NVMe SSD with read speeds up to 7000MB/s', 10);

-- Sample products for 'Peripherals'
INSERT INTO products (category_id, name, price, image_url, description, stock) VALUES
(2, 'Logitech G Pro X Gaming Headset', 1599000, 'images/products/logitech_gpro_headset.jpg', 'Wired headset with Blue VO!CE mic technology', 10),
(2, 'Razer DeathAdder V2 Gaming Mouse', 799000, 'images/products/razer_deathadder.jpg', 'Ergonomic mouse with 20K DPI optical sensor', 10),
(2, 'Corsair K70 RGB Mechanical Keyboard', 1399000, 'images/products/corsair_k70.jpg', 'Mechanical keyboard with Cherry MX switches and RGB backlight', 10),
(2, 'ASUS TUF Gaming 27” Monitor (VG27AQ)', 5299000, 'images/products/asus_vg27aq.jpg', '2K 165Hz IPS gaming monitor with G-Sync compatibility', 10),
(2, 'Elgato Stream Deck MK.2', 2399000, 'images/products/elgato_streamdeck.jpg', '15 customizable LCD keys for streaming and productivity', 10);

-- Sample products for 'Accessories'
INSERT INTO products (category_id, name, price, image_url, description, stock) VALUES
(3, 'Logitech MX Palm Rest', 199000, 'images/products/logitech_palmrest.jpg', 'Soft memory foam palm rest for keyboards', 10),
(3, 'Cooler Master MasterGel Pro V2', 99000, 'images/products/coolermaster_gel.jpg', 'Thermal paste for CPUs and GPUs with improved viscosity', 10),
(3, 'NZXT Puck Cable Organizer', 249000, 'images/products/nzxt_puck.jpg', 'Magnetic headset and cable organizer for PC cases', 10),
(3, 'HyperX Wrist Rest', 149000, 'images/products/hyperx_wristrest.jpg', 'Cooling gel-infused memory foam wrist rest', 10),
(3, 'UGREEN USB 3.0 Hub 4-Port', 179000, 'images/products/ugreen_usb_hub.jpg', 'High-speed USB 3.0 hub with 4 ports and LED indicator', 10);

-- Sample products for 'Laptops and Desktops'
INSERT INTO products (category_id, name, price, image_url, description, stock) VALUES
(4, 'Dell XPS 15 (2023)', 30499000, 'images/products/dell_xps15.jpg', 'Intel i7, 16GB RAM, 1TB SSD, NVIDIA RTX 4050, 15.6” OLED display', 10),
(4, 'Apple MacBook Air M2 (2023)', 18999000, 'images/products/macbook_air_m2.jpg', 'M2 chip, 8GB RAM, 256GB SSD, 13.6-inch Retina display', 10),
(4, 'Lenovo Legion 5 Pro', 23990000, 'images/products/lenovo_legion5pro.jpg', 'Ryzen 7 6800H, 16GB RAM, RTX 3070, 1TB SSD, 165Hz display', 10),
(4, 'HP Pavilion Desktop TG01-2003w', 11750000, 'images/products/hp_pavilion_tg01.jpg', 'Intel Core i5, 12GB RAM, 512GB SSD, GTX 1660 Super', 10),
(4, 'MSI Stealth 16 Studio', 32999000, 'images/products/msi_stealth_16.jpg', 'Intel i9, 32GB RAM, RTX 4080, 1TB SSD, 240Hz QHD+ display', 10);
