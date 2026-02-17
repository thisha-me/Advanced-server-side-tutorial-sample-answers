-- =============================================
-- Tut4 ex1 - Films table for Movies app
-- =============================================
-- 1. Create database (optional - or use an existing one)
-- 2. Run this script in phpMyAdmin or: mysql -u root -p < films_setup.sql
-- 3. Set application/config/database.php: database => 'tut4_movies'
--    and username/password (e.g. root / empty for XAMPP default)
-- =============================================

CREATE DATABASE IF NOT EXISTS tut4_movies
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE tut4_movies;

-- --------------------------------------------------------
-- Table: films
-- --------------------------------------------------------
DROP TABLE IF EXISTS films;

CREATE TABLE films (
  id            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  title         VARCHAR(255) NOT NULL,
  director      VARCHAR(255) NOT NULL,
  genre         VARCHAR(100) NOT NULL,
  imdb_rating   DECIMAL(2,1) NULL COMMENT 'e.g. 7.5',
  release_year  SMALLINT UNSIGNED NULL,
  PRIMARY KEY (id),
  KEY idx_genre (genre),
  KEY idx_release_year (release_year)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------
-- Sample data
-- --------------------------------------------------------
INSERT INTO films (title, director, genre, imdb_rating, release_year) VALUES
('The Shawshank Redemption', 'Frank Darabont', 'Drama', 9.3, 1994),
('The Godfather', 'Francis Ford Coppola', 'Crime', 9.2, 1972),
('The Dark Knight', 'Christopher Nolan', 'Action', 9.0, 2008),
('Pulp Fiction', 'Quentin Tarantino', 'Crime', 8.9, 1994),
('Forrest Gump', 'Robert Zemeckis', 'Drama', 8.8, 1994),
('Inception', 'Christopher Nolan', 'Sci-Fi', 8.8, 2010),
('The Matrix', 'Lana Wachowski, Lilly Wachowski', 'Sci-Fi', 8.7, 1999),
('Goodfellas', 'Martin Scorsese', 'Crime', 8.7, 1990),
('Interstellar', 'Christopher Nolan', 'Sci-Fi', 8.7, 2014),
('The Lion King', 'Roger Allers, Rob Minkoff', 'Animation', 8.5, 1994),
('Gladiator', 'Ridley Scott', 'Action', 8.5, 2000),
('Back to the Future', 'Robert Zemeckis', 'Sci-Fi', 8.5, 1985),
('Toy Story', 'John Lasseter', 'Animation', 8.3, 1995),
('Finding Nemo', 'Andrew Stanton', 'Animation', 8.2, 2003),
('Die Hard', 'John McTiernan', 'Action', 8.2, 1988);

-- Quick check
SELECT COUNT(*) AS total_films FROM films;
SELECT genre, COUNT(*) AS count FROM films GROUP BY genre;
