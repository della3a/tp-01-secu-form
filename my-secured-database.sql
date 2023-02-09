-- Create database
CREATE DATABASE identification_form;

-- Use database
USE identification_form;

-- Create table
CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  username VARCHAR(255) NOT NULL,
  password_hash VARCHAR(255) NOT NULL
);
