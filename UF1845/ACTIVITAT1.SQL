/*
  ACTIVITAT 1
  Crear una base de dades MYSQL de nom db_empl,
  i una taula empleados que tingui quatre cmaps, tots obligatoris:

  · id numèric clau primària auto incremental
  · nom
  · cognoms
  · data de naixement
*/

CREATE DATABASE db_empl_b;
USE db_empl_b;
CREATE TABLE empleados(
	id INT AUTO_INCREMENT NOT NULL,
    nom VARCHAR(25) NOT NULL,
    cognoms VARCHAR(100) NOT NULL,
    data_naixement DATE NOT NULL,
    PRIMARY KEY(id)
);
