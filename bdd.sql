DROP TABLE IF EXISTS CommandeProduit CASCADE;
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
solde numeric(10,2) NOT NULL,
rang int NOT NULL REFERENCES Rang);

CREATE TABLE DemandeCarte (
idDemande serial PRIMARY KEY,
idUtilisateur int REFERENCES Utilisateur NOT NULL);

CREATE TABLE Commande (
idCommande serial PRIMARY KEY,
utilisateur int NOT NULL REFERENCES Utilisateur,
serveur int REFERENCES Utilisateur);

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
