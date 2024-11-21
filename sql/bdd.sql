CREATE TABLE compte(
   id_compte BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   email VARCHAR(128) ,
   pseudo VARCHAR(128) ,
   password VARCHAR(258) ,
   date_creation DATE,
   PRIMARY KEY(id_compte)
);

CREATE TABLE personnage(
   id_personnage BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   nom VARCHAR(128) ,
   pokegrolard INT,
   id_compte BIGINT UNSIGNED NOT NULL,
   PRIMARY KEY(id_personnage),
   FOREIGN KEY(id_compte) REFERENCES compte(id_compte)
);

CREATE TABLE dresseur(
   id_dresseur BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   nom VARCHAR(128) ,
   pokegrolard INT,
   PRIMARY KEY(id_dresseur)
);

CREATE TABLE objet(
   id_objet BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   nom VARCHAR(128) ,
   description VARCHAR(1024) ,
   effet VARCHAR(4096) ,
   valeur INT,
   valeur_vente INT,
   PRIMARY KEY(id_objet)
);

CREATE TABLE type(
   id_type BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   nom VARCHAR(50) ,
   PRIMARY KEY(id_type)
);

CREATE TABLE attaque(
   id_attaque BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   nom VARCHAR(128) ,
   description VARCHAR(1024) ,
   degat INT,
   style VARCHAR(50) ,
   id_type BIGINT UNSIGNED NOT NULL,
   PRIMARY KEY(id_attaque),
   FOREIGN KEY(id_type) REFERENCES type(id_type)
);

CREATE TABLE don(
   id_don BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   nom VARCHAR(128) ,
   description VARCHAR(1024) ,
   effet VARCHAR(4096) ,
   PRIMARY KEY(id_don)
);

CREATE TABLE pokemin(
   id_pokemin BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
   nom VARCHAR(128) ,
   description VARCHAR(1024) ,
   cri VARCHAR(256) ,
   niveau INT,
   experience INT,
   experiencemax INT,
   pv INT,
   pvmax INT,
   mana INT,
   manamax INT,
   agilite INT,
   chance INT,
   endurance INT,
   esprit INT,
   puissance INT,
   intelligence INT,
   stocker BOOLEAN,
   pnj BOOLEAN,
   evolution1 INT,
   evolution2 INT,
   id_type BIGINT UNSIGNED,
   id_type_1 BIGINT UNSIGNED NOT NULL,
   PRIMARY KEY(id_pokemin),
   FOREIGN KEY(id_type) REFERENCES type(id_type),
   FOREIGN KEY(id_type_1) REFERENCES type(id_type)
);

CREATE TABLE sac(
   id_personnage BIGINT UNSIGNED,
   id_objet BIGINT UNSIGNED,
   quantite INT,
   PRIMARY KEY(id_personnage, id_objet),
   FOREIGN KEY(id_personnage) REFERENCES personnage(id_personnage),
   FOREIGN KEY(id_objet) REFERENCES objet(id_objet)
);

CREATE TABLE equipe_dresseur(
   id_pokemin BIGINT UNSIGNED,
   id_dresseur BIGINT UNSIGNED,
   PRIMARY KEY(id_pokemin, id_dresseur),
   FOREIGN KEY(id_pokemin) REFERENCES pokemin(id_pokemin),
   FOREIGN KEY(id_dresseur) REFERENCES dresseur(id_dresseur)
);

CREATE TABLE equipe_personnage(
   id_personnage BIGINT UNSIGNED,
   id_pokemin BIGINT UNSIGNED,
   PRIMARY KEY(id_personnage, id_pokemin),
   FOREIGN KEY(id_personnage) REFERENCES personnage(id_personnage),
   FOREIGN KEY(id_pokemin) REFERENCES pokemin(id_pokemin)
);

CREATE TABLE sac_dresseur(
   id_dresseur BIGINT UNSIGNED,
   id_objet BIGINT UNSIGNED,
   quantite INT,
   PRIMARY KEY(id_dresseur, id_objet),
   FOREIGN KEY(id_dresseur) REFERENCES dresseur(id_dresseur),
   FOREIGN KEY(id_objet) REFERENCES objet(id_objet)
);

CREATE TABLE attaque_pokemin(
   id_pokemin BIGINT UNSIGNED,
   id_attaque BIGINT UNSIGNED,
   PRIMARY KEY(id_pokemin, id_attaque),
   FOREIGN KEY(id_pokemin) REFERENCES pokemin(id_pokemin),
   FOREIGN KEY(id_attaque) REFERENCES attaque(id_attaque)
);

CREATE TABLE ct(
   id_objet BIGINT UNSIGNED,
   id_attaque BIGINT UNSIGNED,
   PRIMARY KEY(id_objet, id_attaque),
   FOREIGN KEY(id_objet) REFERENCES objet(id_objet),
   FOREIGN KEY(id_attaque) REFERENCES attaque(id_attaque)
);

CREATE TABLE don_pokemin(
   id_pokemin BIGINT UNSIGNED,
   id_don BIGINT UNSIGNED,
   PRIMARY KEY(id_pokemin, id_don),
   FOREIGN KEY(id_pokemin) REFERENCES pokemin(id_pokemin),
   FOREIGN KEY(id_don) REFERENCES don(id_don)
);
