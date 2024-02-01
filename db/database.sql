DROP DATABASE IF EXISTS dbTest;

CREATE DATABASE dbTest;
USE dbTest;

CREATE TABLE author (
                         id INT PRIMARY KEY AUTO_INCREMENT,
                         name VARCHAR(100) NOT NULL
);

CREATE TABLE book (
                       id INT PRIMARY KEY AUTO_INCREMENT,
                       title VARCHAR(100) NOT NULL,
                       publication_date DATE,
                       author_id INT,
                       FOREIGN KEY (author_id) REFERENCES author(id) ON DELETE CASCADE
);

CREATE TABLE gender (
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        gender_name VARCHAR(50) NOT NULL
);

CREATE TABLE book_gender (
                            id INT PRIMARY KEY AUTO_INCREMENT,
                            book_id INT,
                            gender_id INT,
                            FOREIGN KEY (book_id) REFERENCES book(id)ON DELETE CASCADE,
                            FOREIGN KEY (gender_id) REFERENCES gender(id)ON DELETE CASCADE
);