DROP DATABASE IF EXISTS seed_for_change;

-- Create the database
CREATE DATABASE seed_for_change;

USE seed_for_change;


CREATE TABLE collective_cause_areas (
    collective_cause_areas_id INT PRIMARY KEY AUTO_INCREMENT,
    cause_area_1 VARCHAR(50),
    cause_area_2 VARCHAR(50),
    cause_area_3 VARCHAR(50),
    cause_area_4 VARCHAR(50),
    cause_area_5 VARCHAR(50),
    cause_area_6 VARCHAR(50),
    cause_area_7 VARCHAR(50),
    cause_area_8 VARCHAR(50),
    cause_area_9 VARCHAR(50),
    cause_area_10 VARCHAR(50)
);

-- Users table
CREATE TABLE users (
  user_id INT PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  first_name VARCHAR(50),
  last_name VARCHAR(50),
  biography TEXT,
  profile_photo VARCHAR(255),
  country VARCHAR(50),
  phone_number VARCHAR(20),
  languages_spoken VARCHAR(255)
);

-- Skills table
CREATE TABLE skills (
  skill_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL UNIQUE
);

-- Cause Areas table
CREATE TABLE cause_areas (
  cause_area_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL UNIQUE
);

-- Insert Cause Areas
INSERT INTO cause_areas (name) VALUES 
('Animals'),
('Arts & culture'),
('Civil rights'),
('Community & economic development'),
('Disaster relief'),
('Disease & medical research'),
('Diversity & inclusion'),
('Education'),
('Employment services'),
('Environment'),
('Gender equity & justice'),
('Health & nutrition'),
('Housing & homelessness'),
('Human services'),
('International affairs'),
('Justice & legal services'),
('LGBTQ+'),
('Maternal health'),
('Military & veterans affairs'),
('Philanthropy & capacity building'),
('Religion & spirituality'),
('Science & technology'),
('Violence prevention'),
('Youth development');




-- User Skills table (Many-to-Many Relationship)
CREATE TABLE user_skills (
  user_id INT,
  skill_id INT,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (skill_id) REFERENCES skills(skill_id),
  PRIMARY KEY (user_id, skill_id)
);

-- User Cause Areas table (Many-to-Many Relationship)
CREATE TABLE user_cause_areas (
  user_id INT,
  collective_cause_areas_id INT,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (collective_cause_areas_id) REFERENCES collective_cause_areas(collective_cause_areas_id),
  PRIMARY KEY (user_id, collective_cause_areas_id)
);

-- Opportunities table
CREATE TABLE opportunities (
  opportunity_id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  requirements TEXT NOT NULL,
  date DATE NOT NULL
);

-- Opportunity Cause Areas table (Many-to-Many Relationship)
CREATE TABLE opportunity_cause_areas (
  opportunity_id INT,
  collective_cause_areas_id INT,
  FOREIGN KEY (opportunity_id) REFERENCES opportunities(opportunity_id),
  FOREIGN KEY (collective_cause_areas_id) REFERENCES collective_cause_areas(collective_cause_areas_id),
  PRIMARY KEY (opportunity_id, collective_cause_areas_id)
);

-- Users_Opportunities table (Many-to-Many Relationship)
CREATE TABLE users_opportunities (
  user_id INT,
  opportunity_id INT,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (opportunity_id) REFERENCES opportunities(opportunity_id),
  PRIMARY KEY (user_id, opportunity_id)
);

