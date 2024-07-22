-- Create the database
CREATE DATABASE arcadia_zoo_db;

-- Use the database
USE arcadia_zoo_db;

-- Create the utilisateur table
CREATE TABLE utilisateur (
    username VARCHAR(50),
    password VARCHAR(50),
    nom VARCHAR(50),
    prenom VARCHAR(50),
    PRIMARY KEY (username)
);

-- Create the role table
CREATE TABLE role (
    role_id INT AUTO_INCREMENT,
    label VARCHAR(50),
    PRIMARY KEY (role_id)
);

-- Create the possede table
CREATE TABLE possede (
    username VARCHAR(50),
    role_id INT,
    PRIMARY KEY (username, role_id),
    FOREIGN KEY (username) REFERENCES utilisateur(username),
    FOREIGN KEY (role_id) REFERENCES role(role_id)
);

-- Create the service table
CREATE TABLE service (
    service_id INT AUTO_INCREMENT,
    nom VARCHAR(50),
    description VARCHAR(50),
    PRIMARY KEY (service_id)
);

-- Create the image table
CREATE TABLE image (
    image_id INT AUTO_INCREMENT,
    image_data BLOB,
    PRIMARY KEY (image_id)
);

-- Create the animal table
CREATE TABLE animal (
    animal_id INT AUTO_INCREMENT,
    prenom VARCHAR(50),
    etat VARCHAR(50),
    image_id INT,
    PRIMARY KEY (animal_id),
    FOREIGN KEY (image_id) REFERENCES image(image_id)
);

-- Create the rapport_veterinaire table
CREATE TABLE rapport_veterinaire (
    rapport_veterinaire_id INT AUTO_INCREMENT,
    date DATE,
    detail VARCHAR(50),
    PRIMARY KEY (rapport_veterinaire_id)
);

-- Create the redige table
CREATE TABLE redige (
    rapport_veterinaire_id INT,
    animal_id INT,
    PRIMARY KEY (rapport_veterinaire_id, animal_id),
    FOREIGN KEY (rapport_veterinaire_id) REFERENCES rapport_veterinaire(rapport_veterinaire_id),
    FOREIGN KEY (animal_id) REFERENCES animal(animal_id)
);

-- Create the habitat table
CREATE TABLE habitat (
    habitat_id INT AUTO_INCREMENT,
    nom VARCHAR(50),
    description VARCHAR(50),
    commentaire_habitat VARCHAR(50),
    PRIMARY KEY (habitat_id)
);

-- Create the comporte table
CREATE TABLE comporte (
    habitat_id INT,
    image_id INT,
    PRIMARY KEY (habitat_id, image_id),
    FOREIGN KEY (habitat_id) REFERENCES habitat(habitat_id),
    FOREIGN KEY (image_id) REFERENCES image(image_id)
);

-- Create the avis table
CREATE TABLE avis (
    avis_id INT AUTO_INCREMENT,
    pseudo VARCHAR(50),
    commentaire VARCHAR(50),
    isVisible BOOL,
    PRIMARY KEY (avis_id)
);

-- Create the race table
CREATE TABLE race (
    race_id INT AUTO_INCREMENT,
    label VARCHAR(50),
    PRIMARY KEY (race_id)
);

-- Create the detient table
CREATE TABLE detient (
    animal_id INT,
    habitat_id INT,
    PRIMARY KEY (animal_id, habitat_id),
    FOREIGN KEY (animal_id) REFERENCES animal(animal_id),
    FOREIGN KEY (habitat_id) REFERENCES habitat(habitat_id)
);

-- Create the dispose table
CREATE TABLE dispose (
    animal_id INT,
    race_id INT,
    PRIMARY KEY (animal_id, race_id),
    FOREIGN KEY (animal_id) REFERENCES animal(animal_id),
    FOREIGN KEY (race_id) REFERENCES race(race_id)
);

-- Create the obtient table
CREATE TABLE obtient (
    animal_id INT,
    rapport_veterinaire_id INT,
    PRIMARY KEY (animal_id, rapport_veterinaire_id),
    FOREIGN KEY (animal_id) REFERENCES animal(animal_id),
    FOREIGN KEY (rapport_veterinaire_id) REFERENCES rapport_veterinaire(rapport_veterinaire_id)
);

-- Insert example data into the habitat table
INSERT INTO habitat (nom, description, commentaire_habitat) 
VALUES ('Savane', 'Dégustez nos recettes et nos délicieux plats.', 'Grand espace ouvert avec herbes hautes');

-- Insert example data into the image table
INSERT INTO image (image_data) 
VALUES ('savane_video.mp4');

-- Insert example data into the comporte table to link habitats with images
INSERT INTO comporte (habitat_id, image_id) 
VALUES (1, 1);

INSERT INTO image (image_data) 
VALUES ('leo.jpg');

-- Insert example data into the animal table
INSERT INTO animal (prenom, etat, image_id) 
VALUES ('Leo', 'Healthy', 2);

-- Link animals to habitats
INSERT INTO detient (animal_id, habitat_id) 
VALUES (1, 1);


-- Insert example data into the utilisateur table
INSERT INTO utilisateur (username, password, nom, prenom) 
VALUES ('mahdi225', 'pass123', 'mah', 'di');

INSERT INTO utilisateur (username, password, nom, prenom) 
VALUES ('smith456', 'pass456', 'Smith', 'Alice');

-- Insert example data into the role table
INSERT INTO role (label) 
VALUES ('Admin');

INSERT INTO role (label) 
VALUES ('veterinaire');

-- Insert example data into the possede table to link users with roles
INSERT INTO possede (username, role_id) 
VALUES ('mahdi225', 1); -- John Doe is an Admin

INSERT INTO possede (username, role_id) 
VALUES ('smith456', 2); -- John Doe is an veterinaire
