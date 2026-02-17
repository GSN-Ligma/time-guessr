-- 1. Création de la base de données
CREATE DATABASE IF NOT EXISTS time_guesoeur CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE time_guesoeur;

-- 2. Création de la table
CREATE TABLE IF NOT EXISTS rounds (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_path VARCHAR(255) NOT NULL,
    true_year INT NOT NULL,
    description TEXT,
    latitude DECIMAL(10, 8) NULL,
    longitude DECIMAL(11, 8) NULL
);

-- 3. Insertion des données par défaut
INSERT INTO rounds VALUES 
(1, 'img/photo1.png', 1989, 'Chute du mur de Berlin', 52.51630000, 13.37770000),
(2, 'img/photo2.png', 1945, 'Fin de la seconde guerre mondiale', 49.26300000, 4.02690000),
(3, 'img/photo3.png', 2001, 'Lancement de Wikipedia', 32.71570000, -117.16110000),
(4, 'img/photo4.png', 1996, 'Windows XP screen Sonoma, en Californie', 38.24910000, -122.41010000),
(5, 'img/photo5.png', 2024, 'JO paris 2024', 48.86390000, 2.31360000),
(6, 'img/photo6.png', 1964, 'RDA Berlin', 52.12050000, 11.62760000);

-- 4. Création d'un utilisateur
-- Cela permet d'avoir les mêmes identifiants que dans notre db.php
CREATE USER IF NOT EXISTS 'root'@'localhost' IDENTIFIED BY '1704';
GRANT ALL PRIVILEGES ON time_guesoeur.* TO 'root'@'localhost';
FLUSH PRIVILEGES;