-- I used phpmyadmin to create the database to do it there with the database name of tech_marketplace

-- create user table
CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       username VARCHAR(100) UNIQUE NOT NULL,
                       password VARCHAR(255) NOT NULL
);

-- products table with username as foreign key so users can delete posts
CREATE TABLE products (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          product_name VARCHAR(255) NOT NULL,
                          product_description TEXT NOT NULL,
                          product_price DECIMAL(10, 2) NOT NULL,
                          category ENUM('smartphones', 'tablets', 'laptops', 'accessories', 'wearables') NOT NULL,
                          product_image VARCHAR(255) NOT NULL,
                          username VARCHAR(255) NOT NULL,
                          FOREIGN KEY (username) REFERENCES users(username)
);
