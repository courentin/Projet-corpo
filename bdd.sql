﻿DROP TABLE IF EXISTS CommandeProduit CASCADE;
DROP TABLE IF EXISTS Produit CASCADE;
DROP TABLE IF EXISTS CategorieProduit CASCADE;
DROP TABLE IF EXISTS Commande CASCADE;
DROP TABLE IF EXISTS DemandeCarte CASCADE;
DROP TABLE IF EXISTS Utilisateur CASCADE;
DROP TABLE IF EXISTS Rang CASCADE;
DROP TABLE IF EXISTS Reduction CASCADE;

CREATE TABLE Rang (
idRang serial PRIMARY KEY,
nomRang text NOT NULL,
reduction boolean NOT NULL);

CREATE TABLE Utilisateur (
idUtilisateur serial PRIMARY KEY,
nom text NOT NULL,
prenom text NOT NULL,
mail text UNIQUE NOT NULL,
motDePasse text NOT NULL,
solde numeric(10,2),
rang int NOT NULL REFERENCES Rang,
try int DEFAULT 3);

CREATE TABLE DemandeCarte (
idDemande serial PRIMARY KEY,
idUtilisateur int REFERENCES Utilisateur NOT NULL,
idValideur int, FOREIGN KEY (idValideur) REFERENCES Utilisateur (idUtilisateur),
--Si 0 -> En attente & 1 -> validé & 2 -> Non validé
statut int NOT NULL);

CREATE TABLE Commande (
idCommande serial PRIMARY KEY,
utilisateur int NOT NULL REFERENCES Utilisateur,
serveur int REFERENCES Utilisateur,
dateCommande timestamp NOT NULL);

CREATE TABLE CategorieProduit (
idCategorieProduit serial PRIMARY KEY,
nomCategorieProduit text NOT NULL);

CREATE TABLE Produit (
idProduit serial PRIMARY KEY,
nomProduit text NOT NULL,
prix numeric(10,2) NOT NULL,
stock int NOT NULL,
categorieProduit int NOT NULL REFERENCES CategorieProduit);

CREATE TABLE CommandeProduit (
commande int,
produit int,
quantite int NOT NULL CHECK (quantite >= 0),
PRIMARY KEY(commande,produit));

CREATE TABLE Reduction (
idReduction serial PRIMARY KEY,
seuil numeric(10,2) NOT NULL,
reduction numeric(10,2) NOT NULL);

INSERT INTO Rang VALUES
	(0, 'President', true),
	(1, 'Tresorier', true),
	(2, 'Bureau', true),
	(3, 'Adherent', true),
	(4, 'Non-adherent', false);