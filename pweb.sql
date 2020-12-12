-- Progettazione Web 
DROP DATABASE if exists pweb; 
CREATE DATABASE pweb; 
USE pweb; 
-- MySQL dump 10.13  Distrib 5.6.20, for Win32 (x86)
--
-- Host: localhost    Database: pweb
-- ------------------------------------------------------
-- Server version	5.6.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `eventi`
--

DROP TABLE IF EXISTS `eventi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eventi` (
  `ideventi` int(11) NOT NULL AUTO_INCREMENT,
  `tipologia` varchar(45) NOT NULL,
  `datainserimento` date NOT NULL,
  `maxpartecipanti` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `cognome` varchar(45) NOT NULL,
  `descrizione` text,
  `dataevento` date NOT NULL,
  `titolo` varchar(45) NOT NULL,
  `luogo` varchar(45) NOT NULL,
  `image` varchar(45) DEFAULT NULL,
  `nomeutente` varchar(45) NOT NULL,
  PRIMARY KEY (`ideventi`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventi`
--

LOCK TABLES `eventi` WRITE;
/*!40000 ALTER TABLE `eventi` DISABLE KEYS */;
INSERT INTO `eventi` VALUES (36,'concerto','2020-09-19',40,'Leonardo','Poggiani','Festa della musica con ospiti importanti','2020-09-22','Rock for life','Ponticelli (PG)','../Immagini/imgEventi/rfl.jfif','leopoggiani'),(37,'sagra','2020-09-19',10,'Leonardo ','Poggiani','Festa con musica e buon cibo','2020-10-21','Festa contadina','Fabro scalo (TR)','../Immagini/imgEventi/festacontadina.jfif','leopoggiani'),(39,'eventi','2020-09-19',2000,'Leonardo','Poggiani','Fiera agricola umbra','2020-12-23','Umbria in Fiera','Umbertide (PG)','../Immagini/imgEventi/umbriafiere.jfif','leopoggiani'),(41,'sagra','2020-09-19',400,'Leonardo','Poggiani','','2020-09-21','Sagra della cipolla','Cannara (PG)','../Immagini/imgEventi/cipolla.jfif','leopoggiani'),(46,'eventi','2020-09-21',500,'Nomone','Cognomone','Descrizione evento','2020-11-25','Evento','Luogo','../Immagini/imgEventi/passignano.jpg','organizzatore');
/*!40000 ALTER TABLE `eventi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventi_archiviati`
--

DROP TABLE IF EXISTS `eventi_archiviati`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eventi_archiviati` (
  `ideventi_archiviati` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(45) NOT NULL,
  `luogo` varchar(45) NOT NULL,
  PRIMARY KEY (`ideventi_archiviati`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventi_archiviati`
--

LOCK TABLES `eventi_archiviati` WRITE;
/*!40000 ALTER TABLE `eventi_archiviati` DISABLE KEYS */;
INSERT INTO `eventi_archiviati` VALUES (1,'evento','luogo'),(2,'altroevento','luogo');
/*!40000 ALTER TABLE `eventi_archiviati` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lineup`
--

DROP TABLE IF EXISTS `lineup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lineup` (
  `idconcerto` int(11) NOT NULL,
  `genere` varchar(45) NOT NULL,
  `nomegruppo` varchar(45) NOT NULL,
  PRIMARY KEY (`idconcerto`,`genere`,`nomegruppo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lineup`
--

LOCK TABLES `lineup` WRITE;
/*!40000 ALTER TABLE `lineup` DISABLE KEYS */;
INSERT INTO `lineup` VALUES (36,'jazz','Bud Spencerer Blues Explosion'),(36,'rap','Rkomi'),(36,'rock','Baustelle'),(42,'folk','Bandabardo');
/*!40000 ALTER TABLE `lineup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `idsagra` int(11) NOT NULL,
  `tipoportata` varchar(45) NOT NULL,
  `nomeportata` varchar(45) NOT NULL,
  PRIMARY KEY (`idsagra`,`tipoportata`,`nomeportata`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (37,'dolce','Crostata di mele'),(37,'primo','Pici aglione'),(37,'primo','Pici al ragu'),(37,'secondo','Fagioli con cotiche'),(37,'secondo','Grigliata mista'),(40,'primo','Tagliolini al tartufo'),(40,'secondo','Braciola al tartufo'),(41,'primo','Zuppa di cipolla'),(41,'secondo','Cipolle fritte'),(46,'primo','Pasta al forno'),(46,'secondo','Bistecchine alla brace'),(47,'primo','Pasta al forno'),(47,'secondo','Bistecchine alla brace');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messaggi`
--

DROP TABLE IF EXISTS `messaggi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messaggi` (
  `idmessaggi` int(11) NOT NULL AUTO_INCREMENT,
  `contenuto` text,
  `mittente` varchar(45) NOT NULL,
  `emailmittente` varchar(45) NOT NULL,
  `letto` varchar(45) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idmessaggi`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messaggi`
--

LOCK TABLES `messaggi` WRITE;
/*!40000 ALTER TABLE `messaggi` DISABLE KEYS */;
INSERT INTO `messaggi` VALUES (10,'Bel sito!','Leonardo Poggiani','leonardo.foggiani@gmail.com','1'),(11,'Poteva essere fatto meglio ma funziona!','Paolo Rossi','paolo.rossi@gmail.com','1'),(12,'Bene!','Leonardo Poggiani','leonardo.poggiani@gmail.com','1'),(13,'Benissimo!','Leonardo Poggiani','leonardo.poggiani@gmail.com','1'),(14,'Buon sito!','Nome Cognome','nome.cognome@gmail.com','0');
/*!40000 ALTER TABLE `messaggi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ospiti`
--

DROP TABLE IF EXISTS `ospiti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ospiti` (
  `idevento` int(11) NOT NULL,
  `argomento` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`idevento`,`argomento`,`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ospiti`
--

LOCK TABLES `ospiti` WRITE;
/*!40000 ALTER TABLE `ospiti` DISABLE KEYS */;
INSERT INTO `ospiti` VALUES (38,'ambiente','Tizio Sempronio'),(38,'attualita','Caio Rossi'),(39,'ambiente','Tizio Sempronio'),(39,'attualita','Caio Rossi'),(43,'attualita','Ospite 1'),(43,'cucina','Ospite'),(44,'cucina','Ospite1'),(46,'ambiente','Nuovo ospite'),(46,'attualita','Ospite nuovo');
/*!40000 ALTER TABLE `ospiti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prenotazioni`
--

DROP TABLE IF EXISTS `prenotazioni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prenotazioni` (
  `idprenotazioni` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `cognome` varchar(45) NOT NULL,
  `posti` int(11) NOT NULL,
  `titolo_evento` varchar(45) NOT NULL,
  `nome_utente` varchar(45) NOT NULL,
  PRIMARY KEY (`idprenotazioni`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prenotazioni`
--

LOCK TABLES `prenotazioni` WRITE;
/*!40000 ALTER TABLE `prenotazioni` DISABLE KEYS */;
INSERT INTO `prenotazioni` VALUES (4,'Paolo','Rossi',15,'Umbria in Fiera','parossi'),(5,'Leonardo','Poggiani',4,'Festa contadina','leopoggiani'),(7,'Leonardo','Poggiani',4,'Rock for life','leopoggiani'),(8,'Nome','Cognome',5,'Umbria in Fiera','nome');
/*!40000 ALTER TABLE `prenotazioni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utenti`
--

DROP TABLE IF EXISTS `utenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `Organizzatore` tinyint(4) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `cognome` varchar(45) NOT NULL,
  `admin` int(10) unsigned zerofill DEFAULT '0000000000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utenti`
--

LOCK TABLES `utenti` WRITE;
/*!40000 ALTER TABLE `utenti` DISABLE KEYS */;
INSERT INTO `utenti` VALUES (1,'admin','admin','admin@gestore.email.com',1,'admin','admin',0000000001),(41,'leopoggiani','$2y$10$m5Nz5YK0zpgPlmjURMSX0ubDsamw1RQE8NkvPcdeMGLcmb6HuiWja','leonardo.poggiani@gmail.com',1,'Leonardo','Poggiani',0000000000),(42,'parossi','$2y$10$A9Lm95rzig3acsmZPaIUxOtF8fblTBccHwB1bGph6TiLipIRfU1BW','paolo.rossi@gmail.com',0,'Paolo','Rossi',0000000000),(43,'caio','$2y$10$LcDLjReJ5YO6he7LOY4B6OpfI80spV5lRRBtFz8TIhyQ24XTNqKHG','tizio.caio@gmail.com',1,'Tizio','Caio',0000000000),(44,'nome','$2y$10$/tpHepe86MT4tf9FFDHMl.D6BIQ9yjHvbHkTcVqQbzaI9hMqo87LW','nome.cognome@gmail.com',0,'Nome','Cognome',0000000000),(45,'organizzatore','$2y$10$ZmIFdJftAnvrs8JLyW6kQu2rWVLYvMUncxLCaz3a5ZZzY3EVQgWZu','nomone.cognomone@gmail.com',1,'Nomone','Cognomone',0000000000);
/*!40000 ALTER TABLE `utenti` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

USE pweb;
SET GLOBAL event_scheduler = ON;

DROP EVENT IF EXISTS archivia_prenotazione;

DELIMITER $$

CREATE EVENT archivia_prenotazione
    ON SCHEDULE EVERY 1 MINUTE STARTS CURRENT_TIMESTAMP
DO BEGIN

    INSERT INTO eventi_archiviati
    SELECT 0, titolo,luogo FROM eventi
    WHERE dataevento < CURRENT_TIMESTAMP;
    
    DELETE FROM eventi WHERE  dataevento < CURRENT_TIMESTAMP;
    
END $$
DELIMITER ;

-- Dump completed on 2020-09-21  9:24:27
