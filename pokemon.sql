DROP DATABASE IF exists Collection;
CREATE DATABASE Collection;
use Collection; 

CREATE TABLE Region (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(50) NOT NULL
);

CREATE TABLE Pokemon(
	id INT AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(50) NOT NULL,
	etapa VARCHAR(10) NOT NULL,
	ilustrador VARCHAR(50) NOT NULL,
	HP int NOT NULL,
	descripcion VARCHAR(200) NOT NULL,
	categoria VARCHAR(50) NOT NULL,
	img VARCHAR(200) NOT NULL,
    imgSecundaria VARCHAR(200) NOT NULL,
	altura FLOAT(5,2) NOT NULL,
	peso FLOAT(5,2) NOT NULL,
	num_coleccion int NOT NULL,
	rareza VARCHAR(10) NOT NULL,
	ID_Region INT,
	ID_Preevolucion INT,
	FOREIGN KEY (ID_Region) REFERENCES Region(id),
	FOREIGN KEY (ID_Preevolucion) REFERENCES Pokemon(id)
);

CREATE TABLE Tipo(
	id INT AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(50) NOT NULL,
	debilidades INT,
	fortalezas INT,
	FOREIGN KEY (debilidades) REFERENCES Tipo(id),
	FOREIGN KEY (fortalezas) REFERENCES Tipo(id)
);

CREATE TABLE Movimiento(
	id INT AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(50) NOT NULL,
	daño double NOT NULL,
	efecto VARCHAR(100) NOT NULL,
	ID_Tipo INT,
	FOREIGN KEY (ID_Tipo) REFERENCES Tipo(id)
);


CREATE TABLE Movimiento_Pokemon(
	id_Pokemon INT,
	id_Movimiento INT,
	FOREIGN KEY (id_Pokemon) REFERENCES Pokemon(id) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (id_Movimiento) REFERENCES Movimiento(id),
	PRIMARY KEY(id_Pokemon ,id_Movimiento)
);

CREATE TABLE Tipo_Pokemon(
	id_Pokemon INT,
	id_Tipo INT,
	FOREIGN KEY (id_Pokemon) REFERENCES Pokemon(id) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (id_Tipo) REFERENCES Tipo(id),
	PRIMARY KEY(id_Pokemon , id_Tipo)
);

INSERT INTO Region (nombre) VALUES
  ('Kanto'),
  ('Johto'),
  ('Hoenn'),
  ('Sinnoh'),
  ('Unova'),
  ('Kalos'),
  ('Alola'),
  ('Galar'),
  ('Paldea');
  
-- 1
INSERT INTO Pokemon (nombre, etapa, ilustrador, HP, descripcion, categoria, img, imgSecundaria, altura, peso, num_coleccion, rareza, ID_Region, ID_Preevolucion)
VALUES ('Piplup', 'Basic', 'Illustrator1', 45, 'It is small and covered in blue down.','Penguin Pokémon.', 'piplup.jpg', 'piplup2.png', 0.4, 5.2, 1, 'Common', 4, NULL);

-- 2
INSERT INTO Pokemon (nombre, etapa, ilustrador, HP, descripcion, categoria, img, imgSecundaria, altura, peso, num_coleccion, rareza, ID_Region, ID_Preevolucion)
VALUES ('Prinplup', 'Stage 1', 'Illustrator1', 65,'It evolves from Piplup and is more regal.' ,'Penguin Pokémon', 'prinplup.jpg', 'prinplup2.png', 0.8, 23.0, 2, 'Uncommon', 4, 1);

-- 3
INSERT INTO Pokemon (nombre, etapa, ilustrador, HP, descripcion, categoria, img, imgSecundaria, altura, peso, num_coleccion, rareza, ID_Region, ID_Preevolucion)
VALUES ('Empoleon', 'Stage 2', 'Illustrator1', 85,'The final form of Piplup' ,'Emperor Pokémon', 'empoleon.jpg', 'empoleon2.png', 1.7, 84.5, 3, 'Rare', 4, 2);


-- 4
INSERT INTO Pokemon (nombre, etapa, ilustrador, HP, descripcion, categoria, img, imgSecundaria, altura, peso, num_coleccion, rareza, ID_Region, ID_Preevolucion)
VALUES ('Charmander', 'Basic', 'Illustrator2', 39, 'A small fire-breathing lizard Pokémon.', 'Lizard Pokémon', 'charmander.jpg', 'charmander2.png', 0.6, 8.5, 4, 'Common', 1, NULL);

-- 5
INSERT INTO Pokemon (nombre, etapa, ilustrador, HP, descripcion, categoria, img, imgSecundaria, altura, peso, num_coleccion, rareza, ID_Region, ID_Preevolucion)
VALUES ('Charmeleon', 'Stage 1', 'Illustrator2', 58, 'The Flame Pokémon. It is the evolved form of Charmander.', 'Flame Pokémon', 'charmeleon.jpg', 'charmeleon2.png', 1.1, 19.0, 5, 'Uncommon', 1, 4);

-- 6
INSERT INTO Pokemon (nombre, etapa, ilustrador, HP, descripcion, categoria, img, imgSecundaria, altura, peso, num_coleccion, rareza, ID_Region, ID_Preevolucion)
VALUES ('Charizard', 'Stage 2', 'Illustrator2', 78, 'The Flame Pokémon. The final form of Charmander, it can fly and breathe intense flames.', 'Flame Dragon Pokémon', 'charizard.jpg', 'charizard2.png', 1.7, 90.5, 6, 'Rare', 1, 5);


-- 7
INSERT INTO Pokemon (nombre, etapa, ilustrador, HP, descripcion, categoria, img, imgSecundaria, altura, peso, num_coleccion, rareza, ID_Region, ID_Preevolucion)
VALUES ('Chimchar', 'Basic', 'Illustrator3', 44, 'A small, mischievous Chimp Pokémon.', 'Chimp Pokémon', 'chimchar.jpg', 'chimchar2.png', 0.5, 6.2, 7, 'Common', 4, NULL);

-- 8
INSERT INTO Pokemon (nombre, etapa, ilustrador, HP, descripcion, categoria, img, imgSecundaria, altura, peso, num_coleccion, rareza, ID_Region, ID_Preevolucion)
VALUES ('Monferno', 'Stage 1', 'Illustrator3', 64, 'The Playful Pokémon. It is the evolved form of Chimchar.', 'Playful Pokémon', 'monferno.jpg', 'monferno2.png', 0.9, 22.0, 8, 'Uncommon', 4, 7);

-- 9
INSERT INTO Pokemon (nombre, etapa, ilustrador, HP, descripcion, categoria, img, imgSecundaria, altura, peso, num_coleccion, rareza, ID_Region, ID_Preevolucion)
VALUES ('Infernape', 'Stage 2', 'Illustrator3', 76, 'The Flame Pokémon. The final form of Chimchar, it is incredibly agile and skilled in martial arts.', 'Flame Pokémon', 'infernape.jpg', 'infernape2.png', 1.2, 55.0, 9, 'Rare', 4, 8);

-- 10
INSERT INTO Pokemon (nombre, etapa, ilustrador, HP, descripcion, categoria, img, imgSecundaria, altura, peso, num_coleccion, rareza, ID_Region, ID_Preevolucion)
VALUES ('Turtwig', 'Basic', 'Illustrator4', 55, 'A Tiny Leaf Pokémon. It has a small sprout growing on its head.', 'Tiny Leaf Pokémon', 'turtwig.jpg', 'turtwig2.png', 0.4, 10.2, 10, 'Common', 4, NULL);

-- 11
INSERT INTO Pokemon (nombre, etapa, ilustrador, HP, descripcion, categoria, img, imgSecundaria, altura, peso, num_coleccion, rareza, ID_Region, ID_Preevolucion)
VALUES ('Grotle', 'Stage 1', 'Illustrator4', 75, 'The Grove Pokémon. It is the evolved form of Turtwig.', 'Grove Pokémon', 'grotle.jpg', 'grotle2.png', 1.1, 97.0, 11, 'Uncommon', 4, 10);

-- 12
INSERT INTO Pokemon (nombre, etapa, ilustrador, HP, descripcion, categoria, img, imgSecundaria, altura, peso, num_coleccion, rareza, ID_Region, ID_Preevolucion)
VALUES ('Torterra', 'Stage 2', 'Illustrator4', 95, 'The Continent Pokémon. The final form of Turtwig, it has a large shell and a forest on its back.', 'Continent Pokémon', 'torterra.jpg', 'torterra2.png', 2.2, 310.0, 12, 'Rare', 4, 11);

-- 13
INSERT INTO Pokemon (nombre, etapa, ilustrador, HP, descripcion, categoria, img, imgSecundaria, altura, peso, num_coleccion, rareza, ID_Region, ID_Preevolucion)
VALUES ('Squirtle', 'Basic', 'Illustrator5', 44, 'A Tiny Turtle Pokémon. It has a shell that covers its body.', 'Tiny Turtle Pokémon', 'squirtle.jpg', 'squirtle2.png', 0.5, 9.0, 13, 'Common', 1, NULL);

-- 14
INSERT INTO Pokemon (nombre, etapa, ilustrador, HP, descripcion, categoria, img, imgSecundaria, altura, peso, num_coleccion, rareza, ID_Region, ID_Preevolucion)
VALUES ('Wartortle', 'Stage 1', 'Illustrator5', 59, 'The Turtle Pokémon. It is the evolved form of Squirtle.', 'Turtle Pokémon', 'wartortle.jpg', 'wartortle2.png', 1.0, 22.5, 14, 'Uncommon', 1, 13);

-- 15
INSERT INTO Pokemon (nombre, etapa, ilustrador, HP, descripcion, categoria, img, imgSecundaria, altura, peso, num_coleccion, rareza, ID_Region, ID_Preevolucion)
VALUES ('Blastoise', 'Stage 2', 'Illustrator5', 79, 'The Shellfish Pokémon. The final form of Squirtle, it has powerful water cannons on its back.', 'Shellfish Pokémon', 'blastoise.jpg', 'blastoise2.png', 1.6, 85.5, 15, 'Rare', 1, 14);



-- Tipo Normal
INSERT INTO Tipo (nombre, debilidades, fortalezas)
VALUES ('Normal', NULL, NULL);

-- Tipo Fuego
INSERT INTO Tipo (nombre, debilidades, fortalezas)
VALUES ('Fire', NULL, NULL);

-- Tipo Agua
INSERT INTO Tipo (nombre, debilidades, fortalezas)
VALUES ('Water', NULL, NULL);

-- Tipo Planta
INSERT INTO Tipo (nombre, debilidades, fortalezas)
VALUES ('Grass', NULL, NULL);

-- Tipo Eléctrico
INSERT INTO Tipo (nombre, debilidades, fortalezas)
VALUES ('Electric', NULL, NULL);

-- Tipo Hielo
INSERT INTO Tipo (nombre, debilidades, fortalezas)
VALUES ('Ice', NULL, NULL);

-- Tipo Lucha
INSERT INTO Tipo (nombre, debilidades, fortalezas)
VALUES ('Fighting', NULL, NULL);

-- Tipo Veneno
INSERT INTO Tipo (nombre, debilidades, fortalezas)
VALUES ('Poison', NULL, NULL);

-- Tipo Tierra
INSERT INTO Tipo (nombre, debilidades, fortalezas)
VALUES ('Ground', NULL, NULL);

-- Tipo Volador
INSERT INTO Tipo (nombre, debilidades, fortalezas)
VALUES ('Flying', NULL, NULL);

-- Tipo Psíquico
INSERT INTO Tipo (nombre, debilidades, fortalezas)
VALUES ('Psychic', NULL, NULL);

-- Tipo Bicho
INSERT INTO Tipo (nombre, debilidades, fortalezas)
VALUES ('Bug', NULL, NULL);

-- Tipo Roca
INSERT INTO Tipo (nombre, debilidades, fortalezas)
VALUES ('Rock', NULL, NULL);

-- Tipo Fantasma
INSERT INTO Tipo (nombre, debilidades, fortalezas)
VALUES ('Ghost', NULL, NULL);

-- Tipo Acero
INSERT INTO Tipo (nombre, debilidades, fortalezas)
VALUES ('Steel', NULL, NULL);

-- Tipo Dragón
INSERT INTO Tipo (nombre, debilidades, fortalezas)
VALUES ('Dragon', NULL, NULL);

-- Tipo Siniestro
INSERT INTO Tipo (nombre, debilidades, fortalezas)
VALUES ('Dark', NULL, NULL);

-- Tipo Hada
INSERT INTO Tipo (nombre, debilidades, fortalezas)
VALUES ('Fairy', NULL, NULL);

-- Tipo Fuego (Debilidades: Water)
UPDATE Tipo SET debilidades = 3 WHERE nombre = 'Fire';
-- Tipo Fuego (Fortalezas: Grass)
UPDATE Tipo SET fortalezas = 5 WHERE nombre = 'Fire';

-- Tipo Agua (Debilidades: Electric, Grass)
UPDATE Tipo SET debilidades = 2 WHERE nombre = 'Water';
UPDATE Tipo SET debilidades = 6 WHERE nombre = 'Water';
-- Tipo Agua (Fortalezas: Fire)
UPDATE Tipo SET fortalezas = 3 WHERE nombre = 'Water';

-- Tipo Planta (Debilidades: Fire, Ice, Flying, Bug, Poison)
UPDATE Tipo SET debilidades = 5 WHERE nombre = 'Grass';
UPDATE Tipo SET debilidades = 1 WHERE nombre = 'Grass';
UPDATE Tipo SET debilidades = 11 WHERE nombre = 'Grass';
UPDATE Tipo SET debilidades = 8 WHERE nombre = 'Grass';
UPDATE Tipo SET debilidades = 6 WHERE nombre = 'Grass';
-- Tipo Planta (Fortalezas: Water, Ground, Rock)
UPDATE Tipo SET fortalezas = 2 WHERE nombre = 'Grass';
UPDATE Tipo SET fortalezas = 9 WHERE nombre = 'Grass';
UPDATE Tipo SET fortalezas = 7 WHERE nombre = 'Grass';

-- Tipo Eléctrico (Debilidades: Ground)
UPDATE Tipo SET debilidades = 9 WHERE nombre = 'Electric';
-- Tipo Eléctrico (Fortalezas: Water, Flying)
UPDATE Tipo SET fortalezas = 2 WHERE nombre = 'Electric';
UPDATE Tipo SET fortalezas = 11 WHERE nombre = 'Electric';

-- Tipo Hielo (Debilidades: Fire, Fighting, Rock, Steel)
UPDATE Tipo SET debilidades = 3 WHERE nombre = 'Ice';
UPDATE Tipo SET debilidades = 10 WHERE nombre = 'Ice';
UPDATE Tipo SET debilidades = 7 WHERE nombre = 'Ice';
UPDATE Tipo SET debilidades = 11 WHERE nombre = 'Ice';
-- Tipo Hielo (Fortalezas: Grass, Ground, Flying, Dragon)
UPDATE Tipo SET fortalezas = 5 WHERE nombre = 'Ice';
UPDATE Tipo SET fortalezas = 9 WHERE nombre = 'Ice';
UPDATE Tipo SET fortalezas = 12 WHERE nombre = 'Ice';
UPDATE Tipo SET fortalezas = 8 WHERE nombre = 'Ice';

-- Tipo Lucha (Debilidades: Flying, Psychic, Fairy)
UPDATE Tipo SET debilidades = 12 WHERE nombre = 'Fighting';
UPDATE Tipo SET debilidades = 14 WHERE nombre = 'Fighting';
UPDATE Tipo SET debilidades = 13 WHERE nombre = 'Fighting';
-- Tipo Lucha (Fortalezas: Normal, Ice, Rock, Dark, Steel)
UPDATE Tipo SET fortalezas = 1 WHERE nombre = 'Fighting';
UPDATE Tipo SET fortalezas = 7 WHERE nombre = 'Fighting';
UPDATE Tipo SET fortalezas = 6 WHERE nombre = 'Fighting';
UPDATE Tipo SET fortalezas = 11 WHERE nombre = 'Fighting';
UPDATE Tipo SET fortalezas = 15 WHERE nombre = 'Fighting';

-- Tipo Veneno (Debilidades: Ground, Psychic)
UPDATE Tipo SET debilidades = 9 WHERE nombre = 'Poison';
UPDATE Tipo SET debilidades = 14 WHERE nombre = 'Poison';
-- Tipo Veneno (Fortalezas: Grass, Fairy)
UPDATE Tipo SET fortalezas = 5 WHERE nombre = 'Poison';
UPDATE Tipo SET fortalezas = 12 WHERE nombre = 'Poison';

-- Tipo Tierra (Debilidades: Water, Ice, Grass)
UPDATE Tipo SET debilidades = 4 WHERE nombre = 'Ground';
UPDATE Tipo SET debilidades = 7 WHERE nombre = 'Ground';
UPDATE Tipo SET debilidades = 5 WHERE nombre = 'Ground';
-- Tipo Tierra (Fortalezas: Fire, Electric, Poison, Rock, Steel)
UPDATE Tipo SET fortalezas = 3 WHERE nombre = 'Ground';
UPDATE Tipo SET fortalezas = 4 WHERE nombre = 'Ground';
UPDATE Tipo SET fortalezas = 8 WHERE nombre = 'Ground';
UPDATE Tipo SET fortalezas = 11 WHERE nombre = 'Ground';
UPDATE Tipo SET fortalezas = 15 WHERE nombre = 'Ground';

-- Tipo Volador (Debilidades: Electric, Ice, Rock)
UPDATE Tipo SET debilidades = 2 WHERE nombre = 'Flying';
UPDATE Tipo SET debilidades = 7 WHERE nombre = 'Flying';
UPDATE Tipo SET debilidades = 11 WHERE nombre = 'Flying';
-- Tipo Volador (Fortalezas: Grass, Fighting, Bug)
UPDATE Tipo SET fortalezas = 5 WHERE nombre = 'Flying';

-- Tipo Psychic (Debilidades: Bug, Ghost, Dark)
UPDATE Tipo SET debilidades = 12 WHERE nombre = 'Psychic';
UPDATE Tipo SET debilidades = 14 WHERE nombre = 'Psychic';
UPDATE Tipo SET debilidades = 17 WHERE nombre = 'Psychic';

-- Tipo Bug (Debilidades: Fire, Flying, Rock)
UPDATE Tipo SET debilidades = 3 WHERE nombre = 'Bug';
UPDATE Tipo SET debilidades = 11 WHERE nombre = 'Bug';
UPDATE Tipo SET debilidades = 13 WHERE nombre = 'Bug';

-- Tipo Rock (Debilidades: Water, Grass, Fighting, Ground, Steel)
UPDATE Tipo SET debilidades = 4 WHERE nombre = 'Rock';
UPDATE Tipo SET debilidades = 5 WHERE nombre = 'Rock';
UPDATE Tipo SET debilidades = 9 WHERE nombre = 'Rock';
UPDATE Tipo SET debilidades = 10 WHERE nombre = 'Rock';
UPDATE Tipo SET debilidades = 15 WHERE nombre = 'Rock';

-- Tipo Ghost (Debilidades: Ghost, Dark)
UPDATE Tipo SET debilidades = 14 WHERE nombre = 'Ghost';
UPDATE Tipo SET debilidades = 17 WHERE nombre = 'Ghost';

-- Tipo Steel (Debilidades: Fire, Fighting, Ground)
UPDATE Tipo SET debilidades = 3 WHERE nombre = 'Steel';
UPDATE Tipo SET debilidades = 9 WHERE nombre = 'Steel';
UPDATE Tipo SET debilidades = 10 WHERE nombre = 'Steel';

-- Tipo Dragon (Debilidades: Ice, Dragon, Fairy)
UPDATE Tipo SET debilidades = 6 WHERE nombre = 'Dragon';
UPDATE Tipo SET debilidades = 16 WHERE nombre = 'Dragon';
UPDATE Tipo SET debilidades = 18 WHERE nombre = 'Dragon';

-- Tipo Dark (Debilidades: Fighting, Bug, Fairy)
UPDATE Tipo SET debilidades = 12 WHERE nombre = 'Dark';
UPDATE Tipo SET debilidades = 13 WHERE nombre = 'Dark';
UPDATE Tipo SET debilidades = 18 WHERE nombre = 'Dark';

-- Tipo Fairy (Debilidades: Poison, Steel)
UPDATE Tipo SET debilidades = 8 WHERE nombre = 'Fairy';
UPDATE Tipo SET debilidades = 15 WHERE nombre = 'Fairy';
-- Tipo Psychic (Fortalezas: Fighting, Poison)
UPDATE Tipo SET fortalezas = 9 WHERE nombre = 'Psychic';
UPDATE Tipo SET fortalezas = 8 WHERE nombre = 'Psychic';

-- Tipo Bug (Fortalezas: Grass, Psychic, Dark)
UPDATE Tipo SET fortalezas = 5 WHERE nombre = 'Bug';
UPDATE Tipo SET fortalezas = 14 WHERE nombre = 'Bug';
UPDATE Tipo SET fortalezas = 17 WHERE nombre = 'Bug';

-- Tipo Rock (Fortalezas: Fire, Ice, Flying, Bug)
UPDATE Tipo SET fortalezas = 3 WHERE nombre = 'Rock';
UPDATE Tipo SET fortalezas = 6 WHERE nombre = 'Rock';
UPDATE Tipo SET fortalezas = 12 WHERE nombre = 'Rock';
UPDATE Tipo SET fortalezas = 8 WHERE nombre = 'Rock';

-- Tipo Ghost (Fortalezas: Ghost, Psychic)
UPDATE Tipo SET fortalezas = 14 WHERE nombre = 'Ghost';
UPDATE Tipo SET fortalezas = 9 WHERE nombre = 'Ghost';

-- Tipo Steel (Fortalezas: Ice, Rock, Fairy)
UPDATE Tipo SET fortalezas = 6 WHERE nombre = 'Steel';
UPDATE Tipo SET fortalezas = 12 WHERE nombre = 'Steel';
UPDATE Tipo SET fortalezas = 18 WHERE nombre = 'Steel';

-- Tipo Dragon (Fortalezas: Dragon)
UPDATE Tipo SET fortalezas = 16 WHERE nombre = 'Dragon';

-- Tipo Dark (Fortalezas: Ghost, Psychic)
UPDATE Tipo SET fortalezas = 14 WHERE nombre = 'Dark';
UPDATE Tipo SET fortalezas = 9 WHERE nombre = 'Dark';

-- Tipo Fairy (Fortalezas: Fighting, Bug, Dark)
UPDATE Tipo SET fortalezas = 9 WHERE nombre = 'Fairy';
UPDATE Tipo SET fortalezas = 17 WHERE nombre = 'Fairy';
UPDATE Tipo SET fortalezas = 13 WHERE nombre = 'Fairy';

-- Tipo Agua
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Water Gun', 40, 'None', 3);
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Hydro Pump', 110, 'None', 3);

-- Tipo Fuego
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Ember', 40, 'May burn the target.', 2);
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Fire Blast', 110, 'May burn the target.', 2);

-- Tipo Planta
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Vine Whip', 45, 'None', 4);
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Solar Beam', 120, 'Charges on the first turn and hits on the second.', 4);

-- Tipo Eléctrico
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Thunder Shock', 40, 'May paralyze the target.', 5);
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Thunderbolt', 90, 'May paralyze the target.', 5);

-- Tipo Hielo
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Ice Beam', 90, 'May freeze the target.', 6);
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Aurora Beam', 65, 'May lower the target''s Attack stat.', 6);

-- Tipo Lucha
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Karate Chop', 50, 'High critical-hit ratio.', 7);
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Focus Punch', 150, 'Fails if the user is hit before it hits.', 7);

-- Tipo Veneno
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Poison Sting', 15, 'May poison the target.', 8);
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Toxic', 0, 'Badly poisons the target.', 8);

-- Tipo Tierra
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Dig', 80, 'Digs underground the first turn and strikes the next turn.', 9);
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Earthquake', 100, 'Inflicts damage on all Pokémon in battle.', 9);

-- Tipo Volador
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Peck', 35, 'None', 10);
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Aerial Ace', 60, 'Never misses.', 10);

-- Tipo Psíquico
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Psybeam', 65, 'May confuse the target.', 11);
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Psychic', 90, 'May lower the target''s Special Defense stat.', 11);

-- Tipo Bicho
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Bug Bite', 60, 'User eats the target''s held Berry.', 12);
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('X-Scissor', 80, 'None', 12);

-- Tipo Roca
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Rock Throw', 50, 'None', 13);
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Stone Edge', 100, 'High critical-hit ratio.', 13);

-- Tipo Fantasma
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Lick', 30, 'May paralyze the target.', 14);
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Shadow Ball', 80, 'May lower the target''s Special Defense stat.', 14);

-- Tipo Acero
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Metal Claw', 50, 'May raise the user''s Attack stat.', 15);
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Iron Head', 80, 'May make the target flinch.', 15);

-- Tipo Dragón
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Dragon Breath', 60, 'May paralyze the target.', 16);
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Outrage', 120, 'Confuses the user every turn.', 16);

-- Tipo Siniestro
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Bite', 60, 'May make the target flinch.', 17);
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Foul Play', 95, 'Uses the target''s Attack stat.', 17);

-- Tipo Hada
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Fairy Wind', 40, 'None', 18);
INSERT INTO Movimiento (nombre, daño, efecto, ID_Tipo)
VALUES ('Moonblast', 95, 'May lower the target''s Special Attack stat.', 18);

-- Asignaciones de movimientos a Pokémon

-- Piplup (ID_Pokemon: 1)
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (1, 1);
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (1, 2);

-- Prinplup (ID_Pokemon: 2)
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (2, 1);
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (2, 2);

-- Empoleon (ID_Pokemon: 3)
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (3, 1);
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (3, 2);

-- Charmander (ID_Pokemon: 4)
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (4, 3);
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (4, 4);

-- Charmeleon (ID_Pokemon: 5)
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (5, 3);
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (5, 4);

-- Charizard (ID_Pokemon: 6)
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (6, 3);
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (6, 4);

-- Chimchar (ID_Pokemon: 7)
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (7, 3);
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (7, 4);

-- Monferno (ID_Pokemon: 8)
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (8, 3);
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (8, 4);

-- Infernape (ID_Pokemon: 9)
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (9, 3);
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (9, 4);

-- Turtwig (ID_Pokemon: 10)
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (10, 5);
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (10, 6);

-- Grotle (ID_Pokemon: 11)
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (11, 5);
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (11, 6);

-- Torterra (ID_Pokemon: 12)
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (12, 5);
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (12, 6);

-- Squirtle (ID_Pokemon: 13)
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (13, 1);
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (13, 2);

-- Wartortle (ID_Pokemon: 14)
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (14, 1);
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (14, 2);

-- Blastoise (ID_Pokemon: 15)
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (15, 1);
INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) VALUES (15, 2);

-- Asignaciones de tipos a Pokémon

-- Piplup (ID_Pokemon: 1)
INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) VALUES (1, 3);

-- Prinplup (ID_Pokemon: 2)
INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) VALUES (2, 3);

-- Empoleon (ID_Pokemon: 3)
INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) VALUES (3, 3);
INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) VALUES (3, 15);

-- Charmander (ID_Pokemon: 4)
INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) VALUES (4, 2);

-- Charmeleon (ID_Pokemon: 5)
INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) VALUES (5, 2);

-- Charizard (ID_Pokemon: 6)
INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) VALUES (6, 2);
INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) VALUES (6, 16);

-- Chimchar (ID_Pokemon: 7)
INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) VALUES (7, 2);

-- Monferno (ID_Pokemon: 8)
INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) VALUES (8, 2);
INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) VALUES (8, 14);

-- Infernape (ID_Pokemon: 9)
INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) VALUES (9, 2);

-- Turtwig (ID_Pokemon: 10)
INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) VALUES (10, 4);

-- Grotle (ID_Pokemon: 11)
INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) VALUES (11, 4);

-- Torterra (ID_Pokemon: 12)
INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) VALUES (12, 4);

-- Squirtle (ID_Pokemon: 13)
INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) VALUES (13, 3);

-- Wartortle (ID_Pokemon: 14)
INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) VALUES (14, 3);

-- Blastoise (ID_Pokemon: 15)
INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) VALUES (15, 3);
INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) VALUES (15, 15);