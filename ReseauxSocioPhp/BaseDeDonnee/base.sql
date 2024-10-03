CREATE DATABASE ReseauxSocio;
USE ReseauxSocio;

-- compte
CREATE TABLE compte(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenoms VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    mdp VARCHAR(255) NOT NULL
);

-- publications
CREATE TABLE publications(
    id INT AUTO_INCREMENT PRIMARY KEY,
    idCompte INT,
    contenue TEXT NOT NULL,
    nbrJaimeP INT DEFAULT 0,
    nbrNonJaimeP INT DEFAULT 0,
    nbrHahahaP INT DEFAULT 0,
    nbrJadoreP INT DEFAULT 0,
    dateHeurePub TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idCompte) REFERENCES compte(id)
);

-- Reaction de la publications
CREATE TABLE reactionPublications(
    id INT AUTO_INCREMENT PRIMARY KEY,
    idCompte INT,
    idPublication INT,
    Reaction ENUM('aime', 'nonAime', 'hahaha', 'adore') NOT NULL,
    dateHeureReaction TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idCompte) REFERENCES compte(id),
    FOREIGN KEY (idPublication) REFERENCES publications(id),
    -- chaque utilisateur ne peut réagir qu'une fois à une publication
    UNIQUE(idCompte, idPublication)
);

-- commentaire 
CREATE TABLE commentaires(
    id INT AUTO_INCREMENT PRIMARY KEY,
    idPublication INT,
    idCompte INT,
    contenue TEXT NOT NULL,
    nbrJaimeC INT DEFAULT 0,
    nbrNonJaimeC INT DEFAULT 0,
    nbrHahahaC INT DEFAULT 0,
    nbrJadoreC INT DEFAULT 0,
    dateHeureCom TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idPublication) REFERENCES publications(id),
    FOREIGN KEY (idCompte) REFERENCES compte(id)
);

-- Reaction de la commentaire
CREATE TABLE reactionCommentaire(
    id INT AUTO_INCREMENT PRIMARY KEY,
    idCommentaire INT,
    idPublication INT,
    idCompte INT,
    Reaction ENUM('aime', 'nonAime', 'hahaha', 'adore') NOT NULL,
    dateHeureCommentaire TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idCommentaire) REFERENCES commentaires(id),
    FOREIGN KEY (idPublication) REFERENCES publications(id),
    FOREIGN KEY (idCompte) REFERENCES compte(id), 
    -- chaque utilisateur ne peut réagir qu'une fois à une publication
    UNIQUE(idCompte, idPublication, idCommentaire)
);

-- insersion de l'admin
INSERT INTO compte VALUES (1,'freddy','nomena','akama@gmail.com','$2y$10$27R1cdDT/pju/gGE.d1QyOVxbvdfbNGvWoBHFrpPzMnycnnODk2Ka');
