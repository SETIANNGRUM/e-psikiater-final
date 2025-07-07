CREATE DATABASE IF NOT EXISTS e_psikiater_db;
USE e_psikiater_db;

CREATE TABLE IF NOT EXISTS pasien (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    usia INT,
    keluhan TEXT
);