DROP DATABASE IF EXISTS seed_for_change;

-- Create the database
CREATE DATABASE seed_for_change;

USE seed_for_change;

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

CREATE TABLE skills (
  skill_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE opportunities (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  requirements TEXT NOT NULL,
  date DATE NOT NULL,
  user_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(user_id)
);


CREATE TABLE user_skills (
  user_id INT,
  skill_id INT,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (skill_id) REFERENCES skills(skill_id),
  PRIMARY KEY (user_id, skill_id)
);

CREATE TABLE cause_areas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE opportunity_cause_areas (
  opportunity_id INT NOT NULL,
  cause_area_id INT NOT NULL,
  FOREIGN KEY (opportunity_id) REFERENCES opportunities(id),
  FOREIGN KEY (cause_area_id) REFERENCES cause_areas(id),
  PRIMARY KEY (opportunity_id, cause_area_id)
);

CREATE TABLE user_cause_areas (
  user_id INT,
  cause_area_id INT,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (cause_area_id) REFERENCES cause_areas(id),
  PRIMARY KEY (user_id, cause_area_id)
);

CREATE TABLE users_opportunities (
  user_id INT,
  opportunity_id INT,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (opportunity_id) REFERENCES opportunities(id),
  PRIMARY KEY (user_id, opportunity_id)
);

INSERT INTO cause_areas (name) VALUES
  ("Animals"),
  ("Arts & culture"),
  ("Civil rights"),
  ("Community & economic development"),
  ("Disaster relief"),
  ("Disease & medical research"),
  ("Diversity & inclusion"),
  ("Education"),
  ("Employment services"),
  ("Environment"),
  ("Gender equity & justice"),
  ("Health & nutrition"),
  ("Housing & homelessness"),
  ("Human services"),
  ("International affairs"),
  ("Justice & legal services"),
  ("LGBTQ+"),
  ("Maternal health"),
  ("Military & veterans affairs"),
  ("Philanthropy & capacity building"),
  ("Religion & spirituality"),
  ("Science & technology"),
  ("Violence prevention"),
  ("Youth development");
