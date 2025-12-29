CREATE DATABASE IF NOT EXISTS ai1;
USE ai1;

-- Kategorie
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Platformy streamingowe
CREATE TABLE IF NOT EXISTS streamings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    url VARCHAR(255)
);

-- Filmy / Seriale
CREATE TABLE IF NOT EXISTS movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    release_year INT,
    is_series BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Powiązania Film-Kategoria
CREATE TABLE IF NOT EXISTS movie_categories (
    movie_id INT,
    category_id INT,
    PRIMARY KEY (movie_id, category_id),
    FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- Powiązania Film-Streaming (z informacją o sezonach dla seriali)
CREATE TABLE IF NOT EXISTS movie_streamings (
    movie_id INT,
    streaming_id INT,
    seasons VARCHAR(100) DEFAULT NULL, -- np. "1-3", "Wszystkie"
    PRIMARY KEY (movie_id, streaming_id),
    FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
    FOREIGN KEY (streaming_id) REFERENCES streamings(id) ON DELETE CASCADE
);

-- Oceny
CREATE TABLE IF NOT EXISTS ratings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT,
    rating TINYINT NOT NULL CHECK (rating >= 1 AND rating <= 10),
    comment TEXT,
    is_approved BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE
);

-- Przykładowe dane
INSERT INTO categories (name) VALUES ('Sci-Fi'), ('Fantasy'), ('Dramat'), ('Akcja');
INSERT INTO streamings (name, url) VALUES ('Netflix', 'https://netflix.com'), ('Disney+', 'https://disneyplus.com'), ('HBO Max', 'https://hbomax.com');

INSERT INTO movies (title, description, release_year, is_series) VALUES 
('Snowpiercer', 'Ostatni ludzie na Ziemi podróżują pociągiem.', 2020, TRUE),
('The Mandalorian', 'Łowca nagród w świecie Gwiezdnych Wojen.', 2019, TRUE),
('Incepcja', 'Złodziej wykrada sekrety z podświadomości.', 2010, FALSE);

INSERT INTO movie_categories (movie_id, category_id) VALUES (1, 1), (1, 3), (2, 2), (3, 1), (3, 4);
INSERT INTO movie_streamings (movie_id, streaming_id, seasons) VALUES (1, 1, '1-3'), (2, 2, '1-2'), (3, 3, NULL);