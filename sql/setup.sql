CREATE DATABASE IF NOT EXISTS ai1;
USE ai1;

CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO posts (title, body) VALUES 
('Pierwszy wpis', 'To jest treść pierwszego wpisu pobrana z bazy MySQL.'),
('Drugi wpis', 'Kolejny przykład czystego SQL w akcji.'),
('SOLID w PHP', 'Opis zasad SOLID implementowanych w tym projekcie.');