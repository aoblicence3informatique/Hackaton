-- Création de la base de données
CREATE DATABASE IF NOT EXISTS plateforme_signalement;
USE plateforme_signalement;

-- Table des rôles
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL
);

-- Table des utilisateurs
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe TEXT NOT NULL,
    téléphone VARCHAR(20),
    role_id INT NOT NULL,
    est_confirmé BOOLEAN DEFAULT FALSE,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- Table des signalements
CREATE TABLE signalements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    titre VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    photo_url TEXT,
    latitude FLOAT NOT NULL,
    longitude FLOAT NOT NULL,
    type_probleme VARCHAR(50) NOT NULL,
    statut ENUM('Nouveau', 'En cours', 'Résolu') DEFAULT 'Nouveau',
    date_signalement TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
);

-- Table des votes
CREATE TABLE votes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    signalement_id INT NOT NULL,
    valeur INT CHECK (valeur IN (1, -1)),
    date_vote TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id),
    FOREIGN KEY (signalement_id) REFERENCES signalements(id)
);

-- Table des notifications
CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    message TEXT NOT NULL,
    type ENUM('alerte', 'email', 'confirmation') NOT NULL,
    est_lu BOOLEAN DEFAULT FALSE,
    date_envoi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
);

-- Table des emails envoyés
CREATE TABLE emails_envoyes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    sujet TEXT NOT NULL,
    type ENUM('confirmation', 'mot de passe', 'alerte') NOT NULL,
    date_envoi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
);

-- Table des administrateurs
CREATE TABLE administrateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe TEXT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertion des rôles par défaut
INSERT INTO roles (nom) VALUES ('citoyen'), ('admin');

-- Insertion d'un administrateur par défaut
INSERT INTO administrateurs (nom, email, mot_de_passe)
VALUES 
('Alice Dupont', 'alice.dupont@example.com', 'motdepasse123'),
('Jean Martin', 'jean.martin@example.com', 'securepass456');

INSERT INTO utilisateurs (
    nom, email, mot_de_passe, téléphone, role_id, est_confirmé
) VALUES 
(
    'Alice Dupont',
    'alice.dupont@example.com',
    'motdepassehashé1',  -- remplacez ceci par un mot de passe correctement hashé
    '0612345678',
    1,
    1
),
(
    'Bob Martin',
    'bob.martin@example.com',
    'motdepassehashé2',  -- remplacez ceci aussi par un mot de passe hashé
    '0698765432',
    2,
    0
);
