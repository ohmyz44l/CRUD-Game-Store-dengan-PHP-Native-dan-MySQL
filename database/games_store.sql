SHOW DATABASES;
USE topup_game;

SELECT * FROM orders;
SHOW TABLES;

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_server INT NOT NULL,
    customer_name VARCHAR(255) NOT NULL,
    game_name VARCHAR(255) NOT NULL,
    topup_amount INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    topup_bonus VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



USE topup_game;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    PASSWORD VARCHAR(255) NOT NULL
);

INSERT INTO users (username, PASSWORD) 
VALUES ('admin', MD5('admin'));

CREATE TABLE games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(255) NOT NULL,
    genre VARCHAR(100) NOT NULL,
    rating DECIMAL(3, 2) NOT NULL,
    bonus VARCHAR(255),
    poster_url VARCHAR(255) NOT NULL,
    DESCRIPTION TEXT NOT NULL
);

INSERT INTO games (NAME, genre, rating, bonus, poster_url, DESCRIPTION) VALUES
('Mobile Legends', 'MOBA', 4.5, 'Bonus 50 Diamonds', 'img/ml2.webp', 'Game MOBA populer dengan hero menarik dan mode permainan seru.'),
('Free Fire', 'Battle Royale', 4.7, 'Bonus 100 Diamonds', 'img/ff.jpg', 'Battle royale cepat dengan fitur karakter unik dan peta menantang.'),
('PUBG Mobile', 'Battle Royale', 4.6, 'Bonus 70 UC', 'img/pubg1.jpg', 'Game battle royale realistis dengan grafis dan gameplay berkualitas tinggi.'),
('Genshin Impact', 'RPG', 4.8, 'Bonus 200 Primogems', 'img/gi1.jpg', 'RPG dunia terbuka dengan cerita mendalam dan grafis memukau.'),
('Valorant', 'FPS', 4.4, 'Bonus Skin Weapon', 'img/vl1.jpg', 'Game FPS taktis dengan agen unik dan gameplay kompetitif.');


USE topup_game;

ALTER TABLE orders ADD created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;


CREATE TABLE orders (
id_server VARCHAR (255) NOT NULL
);