CREATE USER 'adminpokemin'@'localhost' IDENTIFIED BY 'adminpokemin';
GRANT ALL PRIVILEGES ON `pokemin`.* TO 'adminpokemin'@'localhost' WITH GRANT OPTION;


CREATE TABLE compte(
   id_compte BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   email VARCHAR(128)  NOT NULL,
   pseudo VARCHAR(128)  NOT NULL,
   password VARCHAR(258)  NOT NULL,
   date_creation DATE,
   PRIMARY KEY(id_compte),
   UNIQUE(email),
   UNIQUE(pseudo)
);

CREATE TABLE dresseur(
   id_dresseur BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   nom VARCHAR(128)  NOT NULL,
   pokegrolard INT NOT NULL,
   PRIMARY KEY(id_dresseur)
);

CREATE TABLE objet(
   id_objet BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   nom VARCHAR(128)  NOT NULL,
   description VARCHAR(1024)  NOT NULL,
   effet VARCHAR(1024) ,
   degat INT,
   valeur INT NOT NULL,
   valeur_vente INT,
   PRIMARY KEY(id_objet),
   UNIQUE(nom)
);

CREATE TABLE type(
   id_type BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   nom VARCHAR(50)  NOT NULL,
   PRIMARY KEY(id_type),
   UNIQUE(nom)
);

CREATE TABLE attaque(
   id_attaque BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   nom VARCHAR(128)  NOT NULL,
   description VARCHAR(1024)  NOT NULL,
   degat INT NOT NULL,
   style VARCHAR(50)  NOT NULL,
   id_type BIGINT UNSIGNED NOT NULL,
   PRIMARY KEY(id_attaque),
   UNIQUE(nom),
   FOREIGN KEY(id_type) REFERENCES type(id_type)
);

CREATE TABLE don(
   id_don BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   nom VARCHAR(128)  NOT NULL,
   description VARCHAR(1024)  NOT NULL,
   effet VARCHAR(1024) ,
   degat INT,
   PRIMARY KEY(id_don),
   UNIQUE(nom)
);

CREATE TABLE pouvoir(
   id_pouvoir BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   nom VARCHAR(128)  NOT NULL,
   description VARCHAR(1024)  NOT NULL,
   effet VARCHAR(1024) ,
   degat INT,
   PRIMARY KEY(id_pouvoir),
   UNIQUE(nom)
);

CREATE TABLE personnage(
   id_personnage BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   nom VARCHAR(128)  NOT NULL,
   pokegrolard INT NOT NULL,
   id_pouvoir BIGINT UNSIGNED,
   id_compte BIGINT UNSIGNED NOT NULL,
   PRIMARY KEY(id_personnage),
   FOREIGN KEY(id_pouvoir) REFERENCES pouvoir(id_pouvoir),
   FOREIGN KEY(id_compte) REFERENCES compte(id_compte)
);

CREATE TABLE pokemin(
   id_pokemin BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   nom VARCHAR(128)  NOT NULL,
   description VARCHAR(1024)  NOT NULL,
   cri VARCHAR(256)  NOT NULL,
   evolution1 INT,
   niveau_evolution1 SMALLINT,
   evolution2 INT,
   niveau_evolution2 SMALLINT,
   taux_apparition INT,
   taux_capture INT,
   id_don BIGINT UNSIGNED,
   id_type2 BIGINT UNSIGNED,
   id_type BIGINT UNSIGNED NOT NULL,
   PRIMARY KEY(id_pokemin),
   UNIQUE(nom),
   FOREIGN KEY(id_don) REFERENCES don(id_don),
   FOREIGN KEY(id_type2) REFERENCES type(id_type),
   FOREIGN KEY(id_type) REFERENCES type(id_type)
);

CREATE TABLE instance_pokemin(
   id_instance BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   niveau INT NOT NULL,
   experience INT NOT NULL,
   experiencemax INT NOT NULL,
   pv INT NOT NULL,
   pvmax INT NOT NULL,
   mana INT NOT NULL,
   manamax INT NOT NULL,
   agilite INT NOT NULL,
   chance INT NOT NULL,
   endurance INT NOT NULL,
   esprit INT NOT NULL,
   puissance INT NOT NULL,
   intelligence INT NOT NULL,
   sauvage BOOLEAN NOT NULL,
   actif BOOLEAN,
   id_pokemin BIGINT UNSIGNED NOT NULL,
   id_dresseur BIGINT UNSIGNED,
   id_personnage BIGINT UNSIGNED,
   PRIMARY KEY(id_instance),
   FOREIGN KEY(id_pokemin) REFERENCES pokemin(id_pokemin),
   FOREIGN KEY(id_dresseur) REFERENCES dresseur(id_dresseur),
   FOREIGN KEY(id_personnage) REFERENCES personnage(id_personnage)
);

CREATE TABLE sac(
   id_sac BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   quantite SMALLINT NOT NULL,
   id_dresseur BIGINT UNSIGNED,
   id_personnage BIGINT UNSIGNED,
   id_objet BIGINT UNSIGNED,
   PRIMARY KEY(id_sac),
   FOREIGN KEY(id_dresseur) REFERENCES dresseur(id_dresseur),
   FOREIGN KEY(id_personnage) REFERENCES personnage(id_personnage),
   FOREIGN KEY(id_objet) REFERENCES objet(id_objet)
);

CREATE TABLE attaque_pokemin(
   id_attaque BIGINT UNSIGNED,
   id_instance BIGINT UNSIGNED,
   mana SMALLINT NOT NULL,
   active BOOLEAN NOT NULL,
   niveau_obtention SMALLINT NOT NULL,
   PRIMARY KEY(id_attaque, id_instance),
   FOREIGN KEY(id_attaque) REFERENCES attaque(id_attaque),
   FOREIGN KEY(id_instance) REFERENCES instance_pokemin(id_instance)
);

CREATE TABLE ct(
   id_objet BIGINT UNSIGNED,
   id_attaque BIGINT UNSIGNED,
   nom VARCHAR(128) ,
   description VARCHAR(1024) ,
   PRIMARY KEY(id_objet, id_attaque),
   FOREIGN KEY(id_objet) REFERENCES objet(id_objet),
   FOREIGN KEY(id_attaque) REFERENCES attaque(id_attaque)
);
