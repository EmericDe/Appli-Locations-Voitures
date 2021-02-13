SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `client`(
    `id_c` int(11) NOT NULL AUTO_INCREMENT,
    `nom_c` text COLLATE utf8_bin NOT NULL,
    `email_c` text COLLATE utf8_bin NOT NULL,
    `mdp_c` text COLLATE utf8_bin NOT NULL,
    PRIMARY KEY (`id_c`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS `loueur`(
    `id_l` int(11) NOT NULL AUTO_INCREMENT,
    `nom_l` text COLLATE utf8_bin NOT NULL,
    `email_l` text COLLATE utf8_bin NOT NULL,
    `mdp_l` text COLLATE utf8_bin NOT NULL,
    PRIMARY KEY (`id_l`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS `vehicule`(
    `id_v` int(11) NOT NULL AUTO_INCREMENT,
    `type_v` text COLLATE utf8_bin NOT NULL,
    `energie_v` text COLLATE utf8_bin NOT NULL,
    `boite_v`   text COLLATE utf8_bin NOT NULL,
    `places_v`int(11) NOT NULL,
    `location_v` text COLLATE utf8_bin NOT NULL,
    `photo_v` text COLLATE utf8_bin NOT NULL,
    PRIMARY KEY (`id_v`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS `facturation`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `ide` int(11) NOT NULL,
    `idv` int(11) NOT NULL,
    `dateD` date NOT NULL,
    `dateF` date NOT NULL,
    `valeur` double NOT NULL,
    `etat` text COLLATE utf8_bin NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE facturation
ADD CONSTRAINT fk_Client_numero 
FOREIGN KEY (ide) REFERENCES client(id_c);

ALTER TABLE facturation
ADD CONSTRAINT fk_Vehicule_numero 
FOREIGN KEY (idv) REFERENCES vehicule(id_v);

INSERT INTO `client` (`id_c`,`nom_c`,`email_c`,`mdp_c`) VALUES
(1,'Orange','company@orange.fr','notorange'),
(2,'Free','freemail@free.fr','notfree123'),
(3,'Renault','Rmail@renault.fr','wearerenault');

INSERT INTO `loueur` (`id_l`,`nom_l`,`email_l`,`mdp_l`) VALUES
(1,'Emeric','Emeric@gmail.com','note'),
(2,'Kenny','kenny@gmail.com','notK'),
(3,'Haiwen','Haiwen@gmail.com','noth'),
(4,'Prof', 'professeur@u-paris.fr','projetPWEB');

INSERT INTO vehicule (id_v,type_v,energie_v,boite_v,places_v,location_v,photo_v) VALUES
(1,'Renault zoé', 'électrique', 'automatique', 2,'disponible', './vue/Photo/Renault.jpg'),
(2,'Peugeot 206', 'hybride', 'manuelle',5,'loué','./vue/Photo/Peugeot.jpg'),
(3,'Ferrari', 'hybride', 'manuelle', 2,'disponible','./vue/Photo/Ferrari.jpg'),
(4,'Citroën c4', 'hybride', 'automatique', 5,'loué','./vue/Photo/Citroen.jpg'),
(5,'Tesla', 'électrique', 'automatique', 7,'loué','./vue/Photo/Tesla.jpg'),
(6,'Mercedes', 'hybride', 'manuelle', 5, 'disponible','./vue/Photo/Mercedes.jpg'),
(7,'Honda', 'électrique', 'manuelle', 5,'disponible','./vue/Photo/Honda.jpg'),
(8,'Nissan','hybride','manuelle', 5, 'disponible','./vue/Photo/Nissan.jpg'),
(9,'Opel','électrique','automatique', 5, 'disponible','./vue/Photo/Opel.jpg'),
(10,'Audi','hybride','manuelle',5, 'disponible','./vue/Photo/Audi.jpg'),
(11,'BMW','hybride','automatique',5, 'en_révision','./vue/Photo/BMW.jpg'),
(12,'Fiat','électrique','automatique',3, 'en_révision','./vue/Photo/Fiat.jpg'),
(13,'Ford','hybride','manuelle',5, 'disponible','./vue/Photo/Ford.jpg'),
(14,'Rolls Royce','hybride','automatique',5, 'disponible','./vue/Photo/RR.jpg'),
(15,'Suzuki','électrique','automatique',2, 'loué','./vue/Photo/Suzuki.jpg'),
(16,'Chevrolet', 'hybride','automatique',5, 'disponible','./vue/Photo/Chevrolet.jpg'),
(17,'Aston Martin','électrique','manuelle',3, 'loué','./vue/Photo/Aston.jpg'),
(18,'Mazda','électrique','automatique',5, 'disponible','./vue/Photo/Mazda.jpg'),
(19,'Hummer','hybride','manuelle',3, 'en_révision','./vue/Photo/Hummer.jpg'),
(20,'Jaguar','hybride','automatique',2, 'disponible','./vue/Photo/Jaguar.jpg'),
(21,'Land Rover','hybride','automatique',1, 'en_révision','./vue/Photo/LR.jpg'),
(22,'BatMobile','électrique','manuelle',1, 'loué','./vue/Photo/Batmobile.jpg'),
(23,'Crinale','électrique','manuelle',1, 'disponible','./vue/Photo/Crinale.jpg'),
(24,'Kamata Longinus','électrique','automatique',1, 'disponible','./vue/Photo/Kamata.jpg'),
(25,'Nosferatu','électrique','manuelle',1, 'en_révision','./vue/Photo/Nosferatu.jpg');

INSERT INTO `facturation` (`id`, `ide`,`idv`,`dateD`,`dateF`,`valeur`,`etat`) VALUES
(100,1,3,'2020-09-21','2020-10-29',369,'fait'),
(101,2,6,'2020-10-05','2020-10-25',185,'non_fait'),
(102,3,4,'2020-11-21','2020-12-30',402,'fait'),
(103,1,2,'2020-08-12','2020-10-31',783,'fait'),
(104,2,5,'2020-11-02','2020-12-29',292,'non_fait'),
(105,3,7,'2020-10-13','2020-11-15',213,'fait'),
(106,2,1,'2020-07-29','2020-12-29',1043,'non_fait'),
(107,2,22,'2020-11-11','2020-12-29',263,'fait'),
(108,3,17,'2020-11-11','2021-01-30',380,'fait'),
(109,1,15,'2020-11-11','2021-02-15',479,'fait');
