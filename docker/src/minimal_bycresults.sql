/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.18-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: bycresults
-- ------------------------------------------------------
-- Server version	10.6.18-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `boats`
--

DROP TABLE IF EXISTS `boats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sail` varchar(40) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `model` varchar(50) DEFAULT NULL,
  `phrf` int(11) NOT NULL,
  `length` int(11) NOT NULL,
  `FridayNightClass` int(11) DEFAULT NULL,
  `rollerFurling` tinyint(1) NOT NULL DEFAULT 0,
  `skipper` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=369 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boats`
--

LOCK TABLES `boats` WRITE;
/*!40000 ALTER TABLE `boats` DISABLE KEYS */;
INSERT INTO `boats` VALUES (1,'2014-10-28 15:46:43','0','None','-',0,0,4,0,'Empty','-',''),(2,'2014-11-11 23:40:36','0','Sambolo','Sabre 402',72,40,3,0,'Owen Oakley','ohoakley@gmail.com','9258424953'),(3,'2014-11-11 23:40:45','1','Puppeteer','Corsair/Tom 24',75,24,2,0,'Tom Davis','tpdavis@yahoo.com','707-746-5192'),(4,'2014-11-11 23:40:49','6','Emma Jean','Corsair F24 MkII',69,24,2,0,'','',''),(5,'2014-11-11 23:40:55','7','Emma','Cosair C31',48,31,3,1,'Bill Roberts','bill@econsci.com,','510-289-9957'),(6,'2014-11-11 23:43:14','9','Panda','Bear',252,22,1,0,'Daniel Maloney','',''),(7,'2014-11-11 23:43:22','11','Balienau','Olson 25',159,25,2,0,'Dan Coleman','',''),(8,'2014-11-11 23:43:28','11','Alchemy','Tayana 37',178,37,1,0,'','',''),(9,'2014-11-11 23:43:32','14','No Name','Bear',252,22,1,0,'','',''),(10,'2014-11-11 23:43:42','15','Abordage','Melges 24',84,24,2,0,'','',''),(11,'2014-11-11 23:43:46','17','Huck Finn','Bear ',252,22,1,0,'','',''),(12,'2014-11-11 23:43:50','18','Bravada','Cal 29',180,29,1,0,'','',''),(13,'2014-11-11 23:43:55','20','Hurricane','Express 27',129,27,2,0,'Jari Laskarzewski','',''),(14,'2014-11-11 23:43:59','23','Psycho Tiller','Jeanneau 32i',141,32,3,1,'James Goldberg','jng7000@gmail.com',''),(15,'2014-11-11 23:44:33','24','Viper','Viper',96,21,3,0,'TBD','','415-271-0649'),(16,'2014-11-11 23:44:38','31','Eventide','L36',162,36,3,0,'Greg Milano','',''),(17,'2014-11-11 23:44:42','32','Little Dipper','Bear',252,22,1,0,'Alejandro D','','415-531-5654'),(18,'2014-11-11 23:44:44','35','Renegade','Bear',252,22,1,0,'','',''),(19,'2014-11-11 23:44:47','39','No Name','Bear',252,22,1,0,'','','650-494-7724, 510-524-5059'),(20,'2014-11-11 23:44:51','39','Centurion\'s Ghost','Corsair 28R',27,28,2,0,'Sances Hensley','eattomey@yahoo.com','415-299-1251'),(21,'2014-11-11 23:44:55','41','Mojo','Ranger 33',159,33,3,0,'Paul Weisman','',''),(22,'2014-11-11 23:44:59','43','Fandango','Cal 2-27',204,27,1,1,'Tom Loughran','tloughran@yahoo.com',''),(23,'2014-11-11 23:45:04','48','Hang Ten','Express 27',129,27,2,0,'Rachel Fogel','rachelthemoo@gmail.com','510-541-6006'),(24,'2014-11-11 23:45:09','48','Ogie','Cal 20',273,20,2,0,'','','650-703-2727'),(25,'2014-11-11 23:45:49','63','Rousay','Corsair Dash 750',60,24,2,1,'','','650-454-5243'),(26,'2014-11-20 03:37:06','64','La Dolce Vita','J 32',123,32,3,1,'Chad Schwartz','Chadallan@aol.com','9167169820'),(27,'2014-11-11 23:45:59','67','Windsong','Islander 29',246,29,1,0,'','','925-413-9607'),(28,'2014-11-11 23:46:02','68','Kodiak','Bear',252,22,1,0,'Peter Miller','',''),(29,'2014-11-11 23:46:07','68','Synchronicity','Olson 25',159,25,2,0,'Steve Smith','SSmith@slac.standford.edu',''),(30,'2014-11-11 23:46:10','74','Balineau','Olson 25',159,25,2,0,'Dan Coleman','dcole328@yahoo.com',''),(31,'2014-11-11 23:46:20','87','Knot Studying','Hunter 33',174,33,1,0,'Mike Dvorak','dvorak@stanford.edu',''),(32,'2014-11-11 23:47:48','94','Double Digit','J/111',36,36,3,0,'Gorken ','gorken@gmail.com',''),(33,'2014-11-11 23:47:53','113','Libra','Express 27',129,27,2,0,'Rachel Fogel','rachelthemoo@gmail.com','415.342.6045'),(34,'2014-11-11 23:49:03','134/147','JGPC','J/105',78,34,3,0,'Jim Gulseth','jgulseth@jgpc.com','9254137607'),(35,'2014-11-11 23:49:07','136','Talisman','Moore 24',150,24,2,0,'','',''),(36,'2014-11-11 23:49:10','145','Mandalay','Catalina 36',141,36,3,0,'John Larsen','',''),(37,'2014-11-11 23:50:25','148','Dinghy','Contender',216,16,1,0,'','',''),(38,'2014-11-11 23:50:30','148','Coquelicot','Ranger 33',153,33,3,1,'Paul Hollenbach','Paulhcs@gmail.com','510-502-8108'),(39,'2014-11-11 23:50:34','74','Chrysalis','Durfor 34',174,34,1,0,'','',''),(40,'2014-11-11 23:51:12','150','Rascal II','Person Triton ',231,28,1,0,'Norman ','enormas@sbcglobal.net',''),(41,'2014-11-11 23:51:16','150','Pursuit','Triton',228,28,1,0,'','','925-519-1980'),(42,'2014-11-11 23:51:31','161','Sir Leansalot','Hunter 40',105,40,3,1,'Tom Lueck','stknbmxer@aol.com','209-604-1300'),(43,'2014-11-11 23:51:34','203','Jack Fish','Ranger 32',150,32,3,0,'Ed Lint','',''),(44,'2014-11-11 23:51:37','213','ExIndigo','Cal 27',204,27,1,0,'','',''),(45,'2014-11-11 23:51:41','217','Utopia','Olson 30',99,30,3,0,'David Lee','',''),(46,'2014-11-11 23:51:47','239','Martha','Columbia 29',228,29,1,0,'Troy Lane','trailhammer@gmail.com','510-778-3093'),(47,'2014-11-11 23:51:50','248','Alexandria','Ericson 35-2',132,35,3,0,'','','530-902-1720'),(48,'2014-11-11 23:51:54','259','Blue Eyes','Catalina 38',126,38,3,0,'Patrick Harpole','',''),(49,'2014-11-20 03:31:30','322','Roxanne','Tartan 4100',90,41,3,1,'Michael Mitchell','mmitchel@cisco.com','5105177875'),(50,'2014-11-11 23:53:10','342','Nirvana','J/105',78,34,3,0,'David Gross','',''),(51,'2014-11-11 23:53:14','357','Yellowfin','J/105',78,34,3,0,' Dick Maclay',' dick@maclay.net','(510) 381-7587'),(52,'2014-11-12 00:16:43','362','Sailorbird','Saber 36.2',108,36,3,0,'','',''),(53,'2014-11-12 00:01:28','375','Iain','Dhinghy 505',128,16,3,0,'Iain','',''),(54,'2014-11-12 00:17:11','434','Our Way','Santana 22',234,22,1,0,'','','510-428-1735'),(55,'2014-11-11 23:53:07','449','Peregrine','J/105',78,34,3,0,'','',''),(56,'2014-11-11 23:59:00','457','Pax','Cal 2-27',198,27,1,0,'Betsy Dorsett','',''),(57,'2014-11-11 23:53:39','513','Shut up and Drive','J 24',168,24,2,0,'Valentin Lulevich','lulevich@hotmail.com',''),(58,'2014-11-11 23:59:54','518','Duct Tape','Cal-29',174,29,1,0,'','',''),(59,'2014-11-11 23:54:39','518','No Name','1984 Hunter 34',144,34,3,1,'','',''),(60,'2014-11-12 00:01:53','521','Avalon','Erricson 28',183,28,3,0,'Ichiaro Yamawaki','sailfurther@hotmail.com',''),(61,'2014-11-11 23:58:57','616','Dura Mater','Cal 2-27',210,27,1,1,'Jackie Philpott','philpott@netscape.com','510-681-5440'),(62,'2014-11-12 00:11:16','632','American Lady','Melges 24',84,24,2,0,'','','415-381-2653'),(63,'2014-11-12 00:00:28','667','Searene','Catalina 30',180,30,1,0,'Kevin Duffus','kevinduffus@att.net','5174202955'),(64,'2014-11-11 23:59:16','691','Merlin','Cal 20',273,20,1,0,'Oscar (Ozzie) Graham','ograham@imi.net','510-548-4676'),(65,'2014-11-12 00:01:46','697','Nimbus','Ericson 30+',162,30,3,0,'','',''),(66,'2014-11-12 00:11:51','747','Rule 13','Newport 30',174,30,1,0,'','',''),(68,'2014-11-11 23:59:07','988','Ondina','Cal 2-29',186,29,1,1,'Mark Dallow','',''),(70,'2014-11-11 23:54:00','1036','Flight','J24',168,24,2,0,'Randall Rasicot','','510-712-0137'),(71,'2014-11-24 00:09:04','1036','Evil Octopus','J24',168,24,2,0,'Jasper Van Vliet','jaspervvliet@gmail.com',''),(72,'2014-11-12 00:00:32','1244','Athena','Catalina 36',141,36,3,0,'Kelvin Phillips','',''),(73,'2014-11-11 23:54:09','1892','Jaded','J24',168,24,2,0,'','',''),(74,'2014-11-11 23:53:54','1898','Critter','J24',168,24,2,0,'','','707-933-1429'),(75,'2014-11-24 00:10:16','2176','Evil Octopus','J24',168,24,2,0,'Jasper Van Vliet','jaspervvliet@gmail.com','415-381-2653'),(76,'2014-11-11 23:59:50','2196','Sea Rose','Cal- -30',186,30,1,0,'','',''),(77,'2014-11-11 23:54:14','2223','Take Five','J24',168,24,2,0,'','','707-495-0686'),(78,'2014-11-11 23:53:57','2372','Fly by Night','J24',168,24,2,0,'Alex Schultink','',''),(79,'2014-11-11 23:53:28','2394','Downtown Uproar','J-24',168,24,2,0,'','',''),(80,'2014-11-11 23:54:03','2546','NoName','j24',168,24,2,0,'','','510-548-2027'),(82,'2014-11-12 00:11:26','2859','Meritorious','Merit 25',168,25,2,0,'Seth Clark','Seth@geodatainfo.com','925 998 7370'),(83,'2014-11-11 23:56:27','3207','Toucan','Albin 27 Vega',240,27,1,0,'Bobby Arthurs','bobbyarthurs@gmail.com',''),(84,'2014-11-11 23:53:31','3316','Woof','J-24',168,24,3,0,'','',''),(85,'2014-11-11 23:53:51','3534','About Time','J24',168,24,2,0,'','',''),(86,'2014-11-11 23:54:25','3747','Hot Pursuit','J24',168,24,2,0,'','','510-938-7601'),(87,'2014-11-11 23:59:04','3866','Ruby Slipper','Cal 2-27',204,27,1,0,'Ted Nordquist/Chris Wall','nordquist@wholesoyco.com, c.wall@syserco.com','925 209 6761'),(88,'2014-11-11 23:59:46','4045','XL','Cal 40',114,40,3,1,'Charlie Casey','',''),(89,'2014-11-11 23:59:28','4100','Free Lunch','Cal 20',270,20,1,0,'Nicholas Halkowski','',''),(90,'2014-11-11 23:59:19','4105','Cheap Therapy','Cal 20',264,20,1,0,'','',''),(91,'2014-11-11 23:59:25','4161','Coyote','Cal 20',273,20,1,0,'Dave Gardner','ddgard@vom.com','415-558-4019'),(92,'2014-11-11 23:53:34','4268','Little Wink','J-24',168,24,2,0,'','','707-337-8436'),(93,'2014-11-12 00:01:40','4307','Unknown','Erickson 27',219,27,1,0,'','',''),(94,'2014-11-11 23:54:20','4526','Vitamin J','J24',168,24,2,0,'','',''),(95,'2014-11-12 00:01:19','4539','Blue Note','CS 30',159,30,3,0,'Louis Benainous','louis@baydesignassociates.com',''),(96,'2014-11-11 23:54:22','4906','TMC Racing','J24',168,24,2,0,'Michael Whitfield','',''),(97,'2014-11-12 00:17:00','5029','Mad Max','Santana  22',234,22,1,0,'Megan Dwyer','megandwyer@aol.com,Êbillgavelis@sbcglobal.net',''),(98,'2014-11-12 00:17:08','5062','Raven','Santana 22',234,22,1,0,'John Hopkins','john@hopkinstudio.com','510-910-1937'),(99,'2014-11-12 00:17:04','5194','Meliki','Santana 22',234,22,1,0,'Deb Fehr','',''),(100,'2014-11-11 23:53:25','5253','3 Big Dogs','J-24',168,24,2,0,'','','510-235-9540x101'),(101,'2014-11-11 23:59:36','5707','Intrepid Fox','Cal 34',174,34,1,0,'','',''),(102,'2014-11-12 00:16:11','5906','Diva','Ranger 28',183,28,1,0,'','',''),(103,'2014-11-12 00:00:09','6073','Callisto','Catalina 25',222,25,1,0,'Bryan Henrikson','',''),(104,'2014-11-12 00:00:18','6090','Latin Lass','Catalina 27',204,27,1,0,'Bill Chapman','latinlass@sbcglobal.net',''),(105,'2014-11-12 00:10:36','6109','Eclipse','Hawkfarm 28',162,28,2,0,'','',''),(106,'2014-11-12 00:10:54','6287','Restless','Islander 30 MK2',186,30,1,0,'','','?'),(107,'2014-11-11 23:56:18','6307','Tiburon','505',126,16,2,0,'','',''),(108,'2014-11-12 00:15:58','6422','Roadrunner','Ranger 23',216,23,1,0,'','','510-798-7550'),(109,'2014-11-12 00:16:06','6423','Crazy Horse','Ranger 23',216,23,1,0,'Ancel-Schvtz','Naancel@yahoo.com',''),(110,'2014-11-20 05:18:31','6520','Amici','Catalina 30',186,30,1,1,'Greg O\'Toole','',''),(111,'2014-11-11 23:59:32','6609','Hatikvah','Cal 29',186,29,1,0,'Scott Cyphers','',''),(112,'2014-11-12 00:10:58','6747','Pilot','Islander 36',144,36,3,0,'Paul Zingaro','',''),(113,'2014-11-12 00:11:48','6847','Achates','Newport 30',174,30,1,0,'','',''),(114,'2014-11-11 23:52:59','46060','Energy','J/105',78,34,3,0,'James Isbester','',''),(116,'2014-11-12 00:17:20','8012','Upstart','SC 27',144,27,2,0,'Richard Page','Richard@newmed.com','510-507-0998'),(117,'2014-11-12 00:16:18','8262','Boogie Woogie','Ranger 33',159,33,3,0,'Michael YY','',''),(118,'2014-11-12 00:11:29','8425','Dr. Who','Merit 25',168,25,2,0,'','',''),(119,'2014-11-11 23:58:54','8427','Starkite','Cal - 30',180,30,1,0,'Laurie Miller','laurie@alliancetradingdesk.com',''),(120,'2014-11-12 00:01:56','8500','Mirage','Express 27',141,27,2,0,'','',''),(121,'2014-10-28 15:46:43','8819','Honcho II','',195,0,1,0,'','','408-247-8879'),(122,'2014-11-12 00:18:36','8844','Snow Bird','Yankee 30',174,30,1,0,'','','408-315-2984'),(123,'2014-11-12 00:15:55','8903','Aquavit','Peterson 34',120,34,3,1,'Arne Brock-Utne','arnebu@gmail.com',''),(124,'2014-11-12 00:17:51','8933','Georgia','VandenStaat 40',75,40,3,0,'','','408-391-0963'),(125,'2014-11-11 23:59:42','8939','Back Bay','Cal 39 Mk2 TM',111,39,3,1,'Peter Schoenburg','pschoenburg@rothsteinlaw.com',''),(126,'2014-11-11 23:53:20','8998','Breakthrough','J-24',168,24,2,0,'','',''),(127,'2014-11-12 00:01:05','10105','Big Catamaran','Catamaran',0,40,0,0,'','',''),(128,'2014-11-12 00:11:32','18072','Star Trek','Merit 25',168,25,2,0,'N/A','N/A',''),(129,'2014-11-12 00:11:37','18091','Mission Impossible','Merit 25',168,25,2,0,'Dave Hamilton','seagrace38@gmail.com',''),(130,'2014-11-11 23:55:41','18198','Rock-on','Olson 25',162,25,2,0,'Tom Cavers','tomcavers@yahoo.com','510-710-7877 / 510-527-5557 (H)'),(131,'2014-11-11 23:55:54','18201','Shark on Bluegrass','Olson 25',159,25,2,0,'Falk Meissner','falk.meissner@gmail.com',''),(132,'2014-11-11 23:55:48','18252','Alchemy','Olson 25',159,25,2,0,'Nick Ancel','naancel@yahoo.com','510-459-1337'),(133,'2014-11-12 00:07:52','18278','Stewball','Express 37',72,37,3,0,'','','925-980-4320'),(134,'2014-11-12 00:17:14','18325','Albacore','Santana 22',234,22,1,0,'Jeremy Westerman','Jeremywesterman@hotmail.com',''),(136,'2014-11-11 23:55:38','18517','American Standard','Olson 25',159,25,2,0,'Bob Gunion','',''),(137,'2014-11-11 23:54:29','18675','Prime Mover','J30',141,30,3,0,'Lloyd Burns','lburns9355@aol.com','707-567-0524'),(138,'2014-11-12 00:16:55','18711','Vitresse','Santa Cruise 27',141,27,2,0,'','',''),(139,'2014-11-12 00:17:36','26337','Arianne','Tartan 10',126,32,3,0,'','',''),(140,'2014-11-12 00:17:45','26337','Tartanic','Tartan Ten',129,32,3,0,'unknown','',''),(141,'2014-11-12 00:01:15','27062','Wings','Corsair 27/MK 1',87,27,2,0,'Bill Cook','','510-910-9939'),(143,'2014-11-12 00:00:24','28105','Seas the Moment','Catalina 30',180,30,1,0,'John Kyser','johnkyser9@gmail.com','925.698.4068'),(144,'2014-11-11 23:53:04','181','Wianno','J/105',78,34,3,0,'','','559-273-9549'),(145,'2014-11-11 23:56:24','28186','TNT','Airis 32 ',234,32,2,0,'','',''),(146,'2014-11-12 00:17:40','28195','Wishful Thinking','Tartan 10',126,32,3,0,'','',''),(148,'2014-11-11 23:56:58','28590','Warp Speed','C&C 115',63,37,3,0,'','',''),(149,'2014-11-11 23:56:01','28708','ThinkFast','Olson 30',99,30,3,0,'Will Zarth','thinkfasto30@att.com','(408) 247-8879'),(150,'2014-11-11 23:55:58','28775','Hellion','Olson 30',99,30,3,0,'Nelson Passos','Npassos@aol.com','408-315-2984'),(151,'2014-11-12 00:11:41','28888','Unknown ','Moore 24',150,24,2,0,'','',''),(152,'2014-11-12 00:00:15','28916','Windhorse','Catalina 27',204,27,1,0,'','',''),(153,'2014-11-12 00:17:16','30980','Ahi','Santana 35',114,35,3,0,'Andy Newell','Andy.Newell@sbcglobal.net',''),(154,'2014-11-12 00:14:30','33468','Milagro','Off Shore One Design',114,34,3,1,'','',''),(155,'2014-11-12 00:11:08','33562','Stinkeye','Laser 28',129,28,2,0,'','',''),(156,'2014-11-12 00:18:26','34840','Gravlax','X402',87,39,3,0,'','',''),(157,'2014-11-12 00:11:44','36046','Europa','New York 36',114,36,3,1,'','',''),(158,'2014-11-12 00:18:39','37660','Jam Jam','Yankee 30',183,30,3,0,'','',''),(159,'2014-11-11 23:59:39','38022','Sea Star','Cal 39',114,39,3,0,'Bob Walden','','510-220-7755'),(160,'2014-11-12 00:08:01','38030','Aleph Null','Fredom 25',186,25,2,0,'John Danielson','','408-398-8724'),(161,'2014-11-12 00:10:41','38069','Ultimate Cypher','Hunter 410',123,41,3,0,'Spencer Nassar','spencer@deepdarksee.com',''),(163,'2014-11-11 23:59:12','40127','Francesca','Cal 2.9',174,29,1,0,'','','9252566936'),(164,'2014-11-12 00:07:56','40646','Jeannette','Frers 40',66,40,3,0,'Henry King','jeannettebleu@gmail.com','510-482-0949'),(165,'2014-11-11 23:58:46','43728','Maggie','C&C',72,39,3,0,'Dave Douglas','ddouglas01@aol.com','415 717 7634'),(166,'2014-11-12 00:10:45','50444','Hawkeye','IMX38',66,38,3,0,'Frank Morrow','','508-574-2600'),(167,'2014-11-12 00:01:22','52839','Lightspeed','Custom Wylie 39',81,39,3,0,'Rick Elkins','lightspeed@wylie39.com','510-461-9250'),(168,'2014-11-12 00:12:32','57313','Passat','North Star 500',236,25,1,0,'Ethan Mobley','',''),(169,'2014-11-12 00:16:14','59065','Diva','Ranger 28',183,28,1,0,'','',''),(170,'2014-11-12 00:01:09','63336','Warwhoop','Contessa 33',144,33,3,0,'Chuck Shelly/ Hooper Nissen','csjnhooper@yahoo.com','N/A'),(171,'2014-11-12 00:11:20','67614 (do not use)','Twilight Zone (Before Oct-2021)','Merit 25',171,25,2,0,'Paul Kamen','pk@well.com',''),(172,'2014-11-12 00:00:02','77427','Pomodoro','Capri 25',168,25,2,0,'','',''),(173,'2014-11-12 00:16:37','79747','Eurydice II','Ross 930',75,30,3,0,'','',''),(174,'2014-11-12 00:14:37','87637','F.L.a.B S.L.a.B','Olson 25',159,25,2,0,'Saul Schumsky','',''),(175,'2014-11-11 23:55:45','87863','Firebolt','Olson 25',159,25,2,1,'Marie Mallannao','mallannao@gmail.com','916-716-9820'),(176,'2014-11-12 00:17:23','87939','BogHopper','Soverel 33',93,33,3,0,'Anders Finn','anders@finn.us','415-244-6759'),(177,'2014-11-12 00:00:05','94807','Par Avion','Carrera 38',96,38,3,0,'','','415-558-4019'),(178,'2014-12-01 15:31:52','97050','Ergo','Ericson 35-2 SM',159,35,3,0,'Scott Cyphers','scottcyphers@sbcglobal.net','650-926-3916'),(179,'2014-11-12 00:00:12','97440','Caroline','Catalina 27',204,27,1,0,'Robert Lanzafame','lanzafame.robert@gmail.com','510-725-0472'),(180,'2014-11-12 00:15:00','97707 (do not use)','Plus Sixteen (do not use)','Olson 911',129,29,3,0,'Paul Disario','pdisario@comcast.net','505-250-5616'),(181,'2014-11-11 23:56:38','97914','Pursuit','Ben 310R',126,31,3,0,'','',''),(182,'2014-10-28 15:46:43','99999','Bay Loon','xxx',0,0,0,0,'Joseph Ferrie','',''),(183,'2014-10-28 15:46:43','99999','Hello Kuma','xxx',0,0,0,0,'Ismail Ergen','ismailergen@gmail.com','4158685320'),(184,'2014-11-12 00:11:34','99999','Speed Racer','Merit 25',168,25,2,0,'Teresa Scarpulla','','916-719-5225'),(185,'2014-11-12 00:08:11','99999','Windance','Gulfstar 41',0,41,0,0,'Thomas Tazelaar','',''),(186,'2014-11-12 00:08:08','99999','Windsong','Fuji 35',210,35,0,0,'Wilfred Hand','','5104285440'),(187,'2014-11-12 00:15:51','99999','Uncle Donald/ Cal Sailing','Pearson Commander',258,26,1,0,'','',''),(189,'2014-11-12 00:15:21','D','Maris','Pacific Sea Craft Dana 24',243,24,1,0,'','',''),(190,'2014-11-12 00:01:43','TWSC','Sea Sloth','Ericson 27',219,27,1,1,'Colin Thompson','',''),(191,'2014-11-12 00:15:14','USA 186','Boracic','Open 5.70',138,18,1,0,'','',''),(192,'2014-11-12 00:15:17','USA 275','Open Acquatic','Open 5.70',138,18,1,0,'','','2095765404'),(193,'2014-11-11 23:53:23','USA1000','Skippers Gift','J-24',168,24,2,0,'David Guinther','',''),(194,'2014-11-11 23:56:30','V2502','Interalia','Albin Vega',240,27,1,0,'Scott Hotes','',''),(196,'2014-11-12 00:10:51','114','Lady K','Islander 29',186,29,1,1,'Jesse Bradford','',''),(197,'2014-11-11 23:58:50','12641','Mary C.','C&C 27',204,27,1,0,'Glen and Mary Garfein','gm@drnu.net','9259474350'),(203,'2014-11-24 00:14:37','195928','D\'Hooligan','Laser',217,14,NULL,0,'Robbie O\'Brien','',''),(204,'2015-01-18 23:14:07','2144','2144','Albin Vega 27',204,27,NULL,0,'Timmerman','','408-914-0110'),(205,'2015-01-18 23:16:34','0000','Saya','Catalina 30 Sloop',186,30,NULL,0,'Ichiro Yamawaki','','510-778-3643'),(206,'2015-01-18 23:26:43','211','Two Truths','Pacific Seacraft Dana',240,24,NULL,0,'Bob Sharf','rsharf@berkeley.edu','510-526-6444'),(207,'2015-01-19 00:08:25','198','Couch','Sailmaster 26',234,26,NULL,0,'Bobby Arthurs','meritlaw2014@gmail.com','808-557-9484'),(208,'2015-01-25 22:57:03','192948','Bob Laser','Laser',217,14,NULL,0,'Bob Gunion','bob.gunion@gmail.com',''),(209,'2015-04-11 03:24:37','18091','Nimbus','J80',114,25,NULL,1,'Tim Han','timhanocscsailing@gmail.com','520-979-2030'),(210,'2015-04-11 03:26:13','18','Bravada','Cal-29',192,29,NULL,1,'Curtis Brown','baywater911@gmail.com','415-531-7939'),(211,'2015-04-11 03:28:56','8844','Snowbird','Yankee 30',180,30,NULL,0,'Amod Chopra','amodchopra@gmail.com','510-647-1163'),(212,'2015-04-11 03:30:55','019','Monsoon','Fuji Ketch 32',246,32,NULL,1,'Travis Weaver','liquidblulo@gmail.com','937-205-8934'),(213,'2015-05-02 02:51:16','5147','Ricochet','Santana 22',234,22,NULL,0,'Jeremy Tingle','lasersailor01@gmail.com',''),(214,'2015-05-09 03:19:00','44','Flamingo','J24',168,24,NULL,0,'John Prato','john.prato@gmail.com','510-575-3655'),(215,'2015-05-30 03:19:18','38085','Serendipity','Ericson 30',168,30,NULL,0,'Norman Miller','nlmiller@berkeley.edu',''),(216,'2015-06-06 03:46:24','747','Cricket','Sea Sprite 23',270,23,NULL,0,'Scott Wall','scottwallphoto@gmail.com','(C) 415-235-1123 (H) 415-865-0320'),(217,'2015-07-15 15:31:42','17','Margaux','Morgan 382 Cruiser',159,38,NULL,1,'Patrick Hind Smith','psman99@hotmail.com','415-328-2819'),(218,'2015-07-25 03:33:23','5570','Dream Catcher','Catalina 25',222,25,NULL,1,'Holding Place','',''),(219,'2015-08-08 04:06:23','5570','Dream Catcher','Catalina 25',225,24,NULL,0,'David Janinis','davidjaninis@yahoo.com','530-966-6411'),(220,'2015-08-15 03:14:51','22884','Run and Reach','Pearson 10M',189,33,NULL,1,'Scott Walker','','408-942-9035'),(221,'2015-08-29 03:36:29','18441','Mintaka 4','Farr 38',81,38,NULL,0,'Gerry Brown','','4082456560'),(222,'2015-10-04 21:38:39','1609','Double Trouble','F18 Catamaran',-39,18,NULL,0,'Matthaeus Leitner','MattLeitner@outlook.com','510-220-2051'),(223,'2015-10-18 21:11:38','29706','Juanita','Ranger 29',180,29,NULL,0,'Kevin Biggerstaff','Kevin.biggerstaff@gmail.com','4159940684'),(224,'2015-10-25 21:56:32','114','High and Dry','Santana 22',237,22,NULL,0,'Igor polevoy','Igor.polevoy@gmail.com','408-816-9831'),(225,'2015-11-01 22:23:18','90','USA 90','F18',-39,18,NULL,0,'Ben','',''),(226,'2015-11-22 17:56:48','200','Quiet Thing','Ranger 22',216,22,NULL,0,'Will Anderson','will.anderson@sbcglobal.net','678-517-6578'),(227,'2015-11-22 22:54:06','48','Hang 20','Express 27',129,27,NULL,0,'Laurie Foredeck Queen','mstewks@yahoo.com','510-285-6889'),(228,'2015-11-29 22:44:26','56','Current Affair','Express 27',129,27,NULL,0,'Seth Clark','seth@geodatainfo.com','925-768-1574 / 510-234-9485'),(229,'2015-11-29 23:09:16','18091','Get Smart','Merit 25',168,25,NULL,0,'David Hamilton','wiseweb@comcast.net',''),(230,'2016-01-17 22:41:23','32','Old Bluey','Laser',217,13,NULL,0,'Alejandro Dorazio','',''),(231,'2016-01-24 18:42:36','0000','Skinny Love','11 meter one design',69,39,NULL,0,'John Powell','Jpowellaoe@yahoo.com','6507269219'),(232,'2016-02-14 18:46:55','98','Slight Disorder','Moore 24',150,24,NULL,0,'Noah Goldman','mailto:noahg34@gmail.com','860-597-3336'),(233,'2016-02-21 21:12:26','7268','Sea Rover','Mariner 31 ketch',213,31,NULL,0,'','',''),(234,'2016-03-06 19:23:33','49550','Red Witch','C&C 29',174,29,NULL,0,'Jessica Eva Hauser','','(253) 878-4789'),(235,'2016-04-22 21:31:00','34','Maui Blanc','Ericson 34',129,34,NULL,1,'Aaron Kimball','akimball83@gmail.com','215-962-6774'),(236,'2016-04-30 04:35:16','41','Magic Bus','Express 27',129,27,NULL,0,'Hans Opsahl','',''),(237,'2016-06-22 22:59:19','27','Charge!','Ericson 27',234,27,NULL,1,'Tim Roche','roche.tp@gmail.com','415-994-8083'),(238,'2016-07-08 23:51:54','C27','High Road','Catalina 27',207,27,NULL,1,'Ed Lynt','','5106732400'),(239,'2016-09-17 03:37:33','blank','Bamboleiro','Ranger 33',153,33,NULL,1,'Kohlneyer','mattleo78@gmail.com','5105020234'),(240,'2017-01-29 17:10:39','97707','Plus Sixteen','Olson 911',135,30,NULL,1,'Paul Disario','pdisario@comcast.net','559-273-9549'),(241,'2017-01-29 17:41:49','518','Maybe Baby','Hunter 34',144,34,NULL,1,'Mark Bird','markwbird@yahoo.com','214-801-7387'),(242,'2017-04-08 00:07:39','none','Nimbus','J-80',111,26,NULL,1,'Mitchell Andrus','Mitchell@ocsc.com','435-640-0246'),(243,'2017-04-08 00:09:46','18656','Maui Blanc','Ericson 34',132,34,NULL,1,'Aaron Kimball','akimball@gmail.com','215-962-6774'),(244,'2017-04-15 03:47:50','181','Vuja Star','J/105',78,34,NULL,0,'Chris Kim','racerxz@hotmail.com','7073159120'),(245,'2017-04-22 02:35:43','US77220','Imagine','Davidson 44',57,44,NULL,0,'Paul Kamen','wyatt.jones@live.com','510-219-8106'),(246,'2017-04-22 03:39:47','231','Blue Moon','Santana 22',234,22,NULL,0,'Dan McGuire','dwmcguire@gmail.com','415-596-4483'),(247,'2017-04-29 03:16:53','1036','Flight','J24',168,24,NULL,0,'Rosanne Scholl','rmscholl@gmail.com','6083470788'),(248,'2017-04-29 03:18:17','616','Dura Mater (OLD - DO NOT USE)','Cal 2-27',213,27,NULL,0,'Jackie Philpott','','510-428-1735'),(249,'2017-05-06 03:24:45','000','Con Brio','Catalina 30',180,30,NULL,1,'Brian Skillinglaw','eneffinger@gmail.com','732-693-9474'),(250,'2017-06-03 00:41:53','1976','Sirenita','C&C 29',174,29,NULL,1,'Rob Richardson','rob.richardson740@gmail.com','510-714-0159'),(251,'2017-06-03 00:47:10','2410','Bamboleiro','Ranger 33',150,33,NULL,1,'Matt Kohlneyer','mattleo78@gmail.com','510-502-0234'),(252,'2017-06-30 00:39:10','43','Fandango','Cal 2-27',204,27,NULL,0,'Sarah Rahimi','slrahimi@outlook.com','415-527-6448'),(253,'2017-07-22 02:45:17','28055','Frequent Flyer','Express 37',72,37,NULL,0,'Hugo Schmitt','','510-205-3303'),(254,'2017-08-11 23:27:01','18252','Alchemy - DUPLiCATE DO NOT USE','Olson 25',159,25,NULL,0,'Nick Ancel','naancel@yahoo.com','510-459-1337'),(255,'2017-09-23 03:02:50','63336','Warwhoop','Contessa 33',147,33,NULL,1,'Chuck Hooper','',''),(256,'2017-11-02 22:03:17','2935','My Time','Tartan 3700',120,37,NULL,1,'Steve Colitz','steve.colits@gmail.com','732-616-7277'),(257,'2017-11-03 17:39:07','101','Archaeopteryx','Hotfoot 20',177,20,NULL,0,'Ryan Georgianna','david.georgianna@gmail.com','757-869-3594'),(258,'2017-11-24 16:20:29','168','Junkyard Dog','J-109',69,36,NULL,1,'James Goldberg','jng7000@gmail.com','916-719-5225'),(259,'2017-12-17 23:43:49','28824','Zena - Old entry do not use','Northstar 727',195,24,NULL,0,'David Russel','anawhata@gmail.com','6508624665'),(260,'2017-12-31 19:33:28','NA','S227','Sloop',186,27,NULL,1,'Hal McArthur','hmcarthur@icloud.com','9254481268'),(261,'2018-01-28 22:54:18','27062','Wings','Corsair F24 MKI',87,24,NULL,1,'Bill and Tammy Cook','finishguy29@hotmail.com','9259639226'),(262,'2018-02-04 23:50:42','21102','Solana','Santa Cruz 27',141,27,NULL,0,'Andrew Lacenere','','5018338649'),(263,'2018-02-05 00:12:00','8031','Cat 30','Catalina 30',180,30,NULL,0,'','',''),(264,'2018-02-18 19:10:57','283','Chomp!','Etchells ',126,31,NULL,0,'Sailing Access Initiative-David,Eric,Martin,Nick','sailingaccessinitiative@gmail.com',''),(265,'2018-04-21 03:17:52','1037','Priya','Ericson 27',228,27,NULL,0,'Aaron Bennett','aarondavidbennett@gmail.com','4159025510'),(266,'2018-04-21 03:47:41','808','Sky','J80',114,26,NULL,0,'Mark Jordan','Office@modernsailing.com','4153318250'),(267,'2018-05-18 23:44:35','352','Sarah','Contessa 26',255,26,NULL,0,'Tiburcio de la Carcova','tiburciod@gmail.com','6506446689'),(268,'2018-06-02 03:48:55','101','Cedric','IOD',156,20,NULL,0,'Richard Jepsen','richardjepsen@gmail.com','5105049077'),(269,'2018-06-23 00:13:40','330','Cheap Therapy','Cal 20',273,20,NULL,0,'Darrell','darrelcaraway@juno.com','6509840400'),(270,'2018-06-30 00:16:38','78','Split Water','J88',81,29,NULL,1,'David Britt','rdbritt@ucdavis.edu','530-400-9142'),(271,'2018-10-14 22:27:21','28258','O\'mar','Olson 25',159,25,NULL,0,'David Scott','skinnyd23@gmail.com','510-506-1628'),(272,'2019-01-27 18:00:54','31','Cheers','Catalina 28',192,28,NULL,0,'Ben Davis','',''),(273,'2019-03-03 23:09:22','NA','Hal McArthur ','S2 27',174,27,NULL,1,'Hal McArthur','halmcarthur@icloud.com','925-448-1268'),(274,'2019-03-24 17:14:41','123','Zeno','Pearson 365',210,36,NULL,0,'Phil Freeman','phil@svzeno.com',''),(275,'2019-04-03 22:49:19','884','LUNA','Catalina 36',150,36,NULL,1,'Marcia Kreycik','kreycik@gmail.com','4048278558'),(276,'2019-05-03 17:06:15','5238','Wilhelmina','Pearson 34',144,34,NULL,1,'Curtis Brown','baywater911@gmail.com','4155317939'),(277,'2019-05-04 03:48:37','000','ocsc','J24',168,24,NULL,0,'OCSC','',''),(278,'2019-05-13 22:15:17','47952','Wolpertinger','Santa Cruz 27',141,27,NULL,1,'Philip Strause','philipstrause@gmail.xom','8043344671'),(279,'2019-05-18 00:44:56','h25','Currency Lad VII','Hunter 25',240,25,NULL,0,'Eric Hunter','symptox@gmail.com','2159130340'),(280,'2019-05-18 00:46:05','332','Tara','Columbia 24 ',258,24,NULL,0,'Charlie Deist','chdeist@gmail.com','415 717 5570'),(283,'2019-06-01 03:39:59','3841','Penelope','Cal 27',201,27,NULL,0,'Unknown','Unknown','Unknown'),(284,'2019-07-13 04:11:03','18228','Gabe Ahseln','Laser 28',141,28,NULL,0,'Babe Ahseln','feebleminded@gmail.com','503-319-1061'),(285,'2019-08-10 03:41:47','154','no name','Ericson 35-2',150,35,NULL,0,'','',''),(286,'2019-08-23 23:50:50','226','Greyhound (until 2019 - do not use)','Farrier F22',90,40,NULL,0,'Evan Mac Donald','evan@hudsonmacdonald.com','5102076174'),(287,'2019-08-31 03:26:21','226','Greyhound (until 2021 - do not use)','Farrier F22',30,66,NULL,0,'Evan Mac Donald','evan@hudsonmacdonald.com','5102076174'),(288,'2019-09-07 03:17:03','373','Rosalita','cal 29',192,29,NULL,0,'','',''),(289,'2019-10-24 23:57:41','357','SOGNO','Pearson Triton',228,28,NULL,1,'Phil Freeman','elektron@halo.nu','3127256318'),(290,'2019-10-28 23:07:42','57449','Island Girl','Islander 36',144,36,NULL,1,'Frank Burkhart','burkhart@me.com','415 515 1945'),(291,'2019-10-28 23:09:01','n/a','Impulse','Catalina 30',180,30,NULL,0,'Martin Taber','mtaber@sti.net','209 617 2580'),(292,'2019-11-04 00:22:51','30130','Mad Hatter','Wylie 34',120,34,NULL,0,'Rich Fischer','Kurrewa59@gmail.com','5105243108'),(293,'2019-11-13 22:50:04','30130','Mad Hatter','Wylie 34',120,34,NULL,0,'Rick Fisher','','5105243108'),(294,'2019-12-06 21:39:15','884','Luna','Catalina 36',150,36,NULL,1,'Marcia and Keith Kreycik','kreycik@gmail.com','4044145070'),(295,'2019-12-22 23:21:24','6218','Process','Islander 30 mk2',186,30,NULL,1,'','',''),(296,'2020-10-10 00:08:54','61108','Indefatigable','Hallberg Rassy 43 MK1',132,43,NULL,0,'John Hess','Jhess1024@gmail.com','5105894627'),(297,'2020-10-11 21:42:52','77146','Bear Territory','Merit 25',168,24,NULL,0,'Mike Callahan','',''),(298,'2020-10-11 21:48:04','1387','Gryphon','Catalina 30',180,30,NULL,0,'Richard Kenny','',''),(299,'2020-10-18 21:59:05','none','G-2','Swan 36',144,36,NULL,0,'Chris Harding','cwharding86@gmail.com',''),(300,'2020-10-18 22:01:00','28706','Perseverance','Catalina 36 TM',141,36,NULL,0,'Robert Havens','rdhavens@sbcglobal.net',''),(301,'2020-10-25 22:15:00','104','Foul Air','Olson 25',159,25,NULL,0,'John Zimmerman','',''),(303,'2021-01-16 20:12:01','3903','Joyous','Catalina 30',180,30,NULL,1,'Wilder Lee','wilder@greatdefense.com','5106814603'),(304,'2021-01-18 01:26:03','7877','Baby Yoda','505',120,16,NULL,0,'JP Camille','','5106100403'),(305,'2021-01-29 21:01:56','No number','Andiamo','Freedom 32',171,32,NULL,0,'Julia Karostoiaiva','Stas.yurkevich@gmail.com','5107033151'),(306,'2021-03-01 15:32:25','155','Heartstring','Catalina 36',141,36,NULL,0,'Sharon Greenhagen','sgreenhagen@earthlink.net',''),(307,'2021-03-30 20:15:22','8','#8','J24',168,24,NULL,0,'Trumpton Mcfarlane','Mistertrumpton@gmail.com','4155136666'),(308,'2021-03-30 23:23:58','Ha','Vroom','Ranger 33',150,33,NULL,1,'Gregory OToole','Greg@gregotoole.com','5107085581'),(309,'2021-05-06 01:00:26','None','Outrun','Ericson 36C',162,36,NULL,1,'Shane Engelman','Contact@shane.gg','4153355209'),(310,'2021-06-26 04:19:56','57307','Wind Walker','Islander 36',144,36,NULL,0,'RICHARD SHOENHAIR','rshoenhair@yahoo.com','14086740792'),(311,'2021-11-20 23:42:33','410','Resolute','J/105',78,34,NULL,0,'David Morris','david.g.morris@sbcglobal.net',''),(312,'2021-11-21 14:53:28','56272','Zaff','J/92',105,30,NULL,0,'Timothy Roche','roche.tp@gmail.com','14159948083'),(313,'2021-11-21 14:53:47','56272','Zaff','J/92',105,30,NULL,0,'Timothy Roche','roche.tp@gmail.com','14159948083'),(314,'2022-01-05 21:28:09','S2 7.3','Gina','S2 7.3',240,27,NULL,0,'Frances Moore','fmoore125@gmail.com','(617)233-3380'),(317,'2022-01-11 17:44:12','14','Hattie','J 100',84,33,NULL,0,'Paolo Calafiura','paolo.calafiura@gmail.com','(510)260-5705'),(318,'2022-01-11 20:23:05','14','Hattie (duplicate entry - don’t use)','J-100',84,33,NULL,0,'Paolo Calafiura','paolo.calafiura@gmail.com','510-260-5705'),(319,'2022-01-23 23:58:19','400','Lulu','J/105',78,32,NULL,0,'Steven Hill','java410@yahoo.com','tbd'),(320,'2022-02-13 23:25:21','67614','Twilight Zone','Merit 25',168,25,NULL,0,'Paul Kamen','pk@well.com',''),(321,'2022-03-16 22:53:11','20','Juno','J88',81,29,NULL,0,'Jeremy Moncada','j_moncada@sbcglobal.net','510-332-3459'),(322,'2022-03-26 01:26:31','Unknown ','Eileen','J24',168,24,NULL,0,'Inspire Sailing','Phil@inspiresailing.com','5108311800'),(323,'2022-04-22 20:38:05','226','Greyhound','Farrier F22',84,66,NULL,0,'Evan MacDonald','evan@hudsonmacdonald.com','5102076174'),(324,'2022-05-07 03:07:10','18627','Ocean X','Santana 35',114,35,NULL,0,'','',''),(325,'2022-05-13 19:52:45','28219 (do not use)','Maiden California (Before Aug-2022)','Olson 30',99,30,NULL,0,'Hawkeye King','hawkeye.king@gmail.com','954-756-0264'),(326,'2022-06-05 18:30:31','C42','Southern Cross','Catalina 42',102,42,NULL,1,'Michael Zigler','mzigler@mac.com','(415)609-1143'),(327,'2022-06-14 23:57:47','154','Betty','Ericsson 35-2',150,35,NULL,1,'Joe Seraphin','joe@seraphinsailing.com','757.553.0427'),(328,'2022-07-16 03:25:46','j24','j24','j24',168,24,NULL,0,'Inspire','',''),(329,'2022-08-08 20:32:04','28219','Maiden California','Olson 30',102,30,NULL,0,'Hawkeye King','hawkeye.king@gmail.com','954-756-0264'),(330,'2022-08-13 03:47:10','Catalina 42','Sea Wolf','Catalina 42',102,42,NULL,0,'Nope','',''),(331,'2022-09-10 03:36:17','77','Unknown','Folkboat',252,25,NULL,0,'','',''),(332,'2022-09-23 19:14:35','154','Tortuga','Moore 24',150,24,NULL,0,'Caleb Everett','caleb@calebeverett.io','4157600000'),(333,'2022-09-26 20:00:34','271','Vitamin Sea','Catalina 36',150,36,NULL,1,'Steve Corwin','stevenpcorwin@gmail.com','415-238-3977'),(334,'2022-09-30 05:01:37','18514','Quiver','Santa Cruz 40',57,40,NULL,0,'Adam Eliot','adameliot@gmail.com','650-656-3799'),(335,'2022-10-02 17:41:04','529','Anna Lu','Merit 25',168,25,NULL,1,'Jay Bauer','jaybauer@gmail.com','(530)219-9725'),(336,'2022-10-05 15:48:04','143','Tern','Pearson Ariel 26',258,26,NULL,0,'Lauren Pavlak','thatsailingcouple@gmail.com','530-919-9781'),(337,'2022-10-07 02:54:28','422','Junesque Jones','Islander 36',147,36,NULL,1,'Peter N Kacandes','KADYCA@YAHOO.COM','(415)601-6332'),(338,'2022-10-09 14:43:07','1000','Outsider','Azzura 310',57,31,NULL,0,'Greg Nelsen','gregnelsen@yahoo.com','(925)984-6768'),(339,'2022-10-12 19:02:28','38132','Take 5 More','Olson 911 SE',135,30,NULL,0,'Grant Kiba','gkiba@pacbell.net','925-550-6379'),(340,'2022-10-16 15:01:10','40415','Resa ','Sweden Yachts 41',99,41,NULL,1,'Dan McGuire/Liz Gatewood','dwmcguire@gmail.com','5105061628'),(341,'2022-11-07 16:47:05','NA','Sculpin','S2-27',186,27,NULL,1,'Luke Hornof','Luke@hornof.org','510.999.0416'),(342,'2023-01-08 23:08:28','blank','Joyful Spirit','Newport 20',270,20,NULL,0,'Filipe Olloa','','510-241-6158'),(343,'2023-01-09 21:52:38','N/a','Ariel','Cal 39',120,39,NULL,1,'Nick Wright','ksteigman@gmail.com','9727430109'),(344,'2023-03-24 16:42:34','USA382','Chao Pescao','J105',78,34,NULL,0,'Paolo Juvara ','pjuvara@gmail.com','415-5740314'),(345,'2023-04-14 21:27:53','N/A','Alsager','Carter 41',90,41,NULL,1,'	Charlie Deist','chdeist@gmail.com','4157175370'),(346,'2023-04-17 21:12:05','7875','O’Leary Construction ','505',149,15,NULL,0,'Ian O’Leary','ian@ianolearyconstruction.com','5105170269'),(347,'2023-05-26 18:53:36','91','Shadowfax','Olson 25',159,25,NULL,0,'JP Camille','jcamille@gmail.com',''),(348,'2023-06-23 00:34:05','18283','Verve','Express 27',129,27,NULL,0,'Ron','',''),(349,'2023-06-24 03:38:06','87637','Flabslab','Olson 25',159,25,NULL,0,'Saul','cscsaul@yahoo.com',''),(350,'2023-07-22 03:35:00','18283','Glitch','Express 27',129,27,NULL,0,'Sam Kronick','',''),(351,'2023-07-28 03:23:11','77010','Second Wind','Capri 25',168,25,NULL,0,'Sharon Greenhagen','sgreenhagen@earthlink.net','916-798-6819'),(352,'2023-08-05 03:07:16','196/18635','Easy Wind','Santana 35',114,35,NULL,0,'Yev Ossippov','yevossipov@gmail.com','909-438-7383'),(353,'2023-08-12 03:30:39','3095','Merial','Catalina 30',186,30,NULL,1,'','',''),(354,'2023-09-02 03:18:22','67','Fly','J88',81,29,NULL,0,'Mark Jordan','markj415@gmail.com','4152971568'),(355,'2023-10-08 22:01:07','No Sail number','Adriana','Dufour 385',108,38,NULL,1,'Josh Butler','',''),(356,'2023-10-08 22:02:20','0070','Nesher','Express 27',129,27,NULL,0,'Arjun Verma','',''),(357,'2023-10-09 03:37:34','87863','Falkor','Olson 25',159,25,NULL,0,'Zach Parisa','',''),(358,'2023-11-02 03:34:18','27031','Hullabaloo','Corsair F-31',27,91,NULL,0,'Jonathan Kaplan','',''),(359,'2023-11-20 16:53:39','28824','Zena','Northstar 727',192,24,NULL,0,'David Russell','anawhata@gmail.com','6508624665'),(360,'2024-01-07 00:45:14','38349','Dazzler','Wyliecat 30',123,30,NULL,0,'Keith Kreycik','kreycik@gmail.com','4048278558'),(361,'2024-02-18 22:10:03','5714','Mymble','J99',69,32,NULL,0,'Stuart Strickland','stuart@strickland.net','5103585246'),(362,'2024-02-27 21:49:38','J601','Très Grande Vitesse','Karate 32',174,33,NULL,0,'Liam McNamara','Liammail@gmail.com','17076994867'),(363,'2024-03-04 23:28:13','108','Latency','J99',72,32,NULL,0,'','',''),(364,'2024-03-05 20:01:43','977','Foxy Lady','Etchells One Design',120,30,NULL,0,'Sofie Mravcova','sofiemravcova@gmail.com','425-240-8234'),(365,'2024-05-29 20:09:39','0000','Foxsea','C&C 40',93,40,NULL,1,'Mark Bird','markwbird@yahoo.com','2148017387'),(366,'2024-07-27 03:18:01','499','Surprise','Ranger 23 (tall)',210,23,NULL,0,'','',''),(367,'2024-08-31 03:31:08','Hunter380','Mango','Hunter 380',180,38,NULL,1,'Curtis Brown','baywater911@gmail.com','4155317939'),(368,'2024-09-03 21:18:53','18','Ripple','Moore 24',150,24,NULL,0,'Barbara Briner','barbarabriner@gmail.com','');
/*!40000 ALTER TABLE `boats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `distance` float NOT NULL,
  `roundings` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,1,4.3,NULL),(2,2,5,NULL),(3,3,5.8,NULL),(4,4,6.8,NULL),(5,5,5.4,NULL),(6,12,5.3,NULL),(7,13,2.9,NULL),(8,14,4.3,NULL),(9,15,3,NULL),(10,21,4.4,NULL),(11,23,5.1,NULL),(12,24,4.2,NULL),(13,25,8.6,NULL),(14,31,5.7,NULL),(15,32,5.7,NULL),(16,34,7.5,NULL),(17,35,6.7,NULL),(18,41,4.9,NULL),(19,42,1.7,NULL),(20,43,3.7,NULL),(21,45,7.9,NULL),(22,51,4.2,NULL),(23,52,6.9,NULL),(24,53,6.9,NULL),(25,54,5.7,NULL),(26,123,4.2,NULL),(27,124,4,NULL),(28,134,5.7,NULL),(29,143,5.2,NULL),(30,213,5.3,NULL),(31,214,5.9,NULL),(32,231,5.7,NULL),(33,241,5.5,NULL),(34,312,6.5,NULL),(35,314,5.7,NULL),(36,321,9.1,NULL),(37,341,6.1,NULL),(38,432,7.5,NULL);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divisions`
--

DROP TABLE IF EXISTS `divisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `divisions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `raceid` int(11) unsigned NOT NULL,
  `typeid` int(10) unsigned DEFAULT NULL,
  `starttime` time NOT NULL,
  `courseid` int(11) unsigned NOT NULL,
  `distance` float NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `minphrf` int(11) DEFAULT NULL,
  `maxphrf` int(11) DEFAULT NULL,
  `minlength` int(11) DEFAULT NULL,
  `maxlength` int(11) DEFAULT NULL,
  `operator` enum('and','or') NOT NULL DEFAULT 'and',
  PRIMARY KEY (`id`),
  KEY `raceid` (`raceid`),
  KEY `typeid` (`typeid`),
  CONSTRAINT `divisions_ibfk_1` FOREIGN KEY (`raceid`) REFERENCES `races` (`id`),
  CONSTRAINT `divisions_ibfk_2` FOREIGN KEY (`typeid`) REFERENCES `divisiontypes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=659 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divisions`
--

LOCK TABLES `divisions` WRITE;
/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;
/*!40000 ALTER TABLE `divisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divisiontypes`
--

DROP TABLE IF EXISTS `divisiontypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `divisiontypes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `seriestypeid` int(11) unsigned NOT NULL,
  `defaultstarttime` time NOT NULL,
  `name` varchar(20) NOT NULL DEFAULT '',
  `minphrf` int(11) DEFAULT NULL,
  `maxphrf` int(11) DEFAULT NULL,
  `minlength` int(11) DEFAULT NULL,
  `maxlength` int(11) DEFAULT NULL,
  `operator` enum('and','or') NOT NULL DEFAULT 'and',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divisiontypes`
--

LOCK TABLES `divisiontypes` WRITE;
/*!40000 ALTER TABLE `divisiontypes` DISABLE KEYS */;
INSERT INTO `divisiontypes` VALUES (2,1,'18:45:00','slow or small',NULL,NULL,NULL,29,'or'),(3,1,'18:50:00','fast and big',NULL,172,29,NULL,'and'),(4,2,'13:00:00','',NULL,NULL,NULL,NULL,'or');
/*!40000 ALTER TABLE `divisiontypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entries`
--

DROP TABLE IF EXISTS `entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `raceid` int(10) unsigned NOT NULL,
  `boatid` int(10) unsigned NOT NULL,
  `divisionid` int(11) unsigned NOT NULL,
  `phrf` int(11) NOT NULL,
  `finish` time DEFAULT NULL,
  `spinnaker` tinyint(1) DEFAULT NULL,
  `rollerFurling` tinyint(1) DEFAULT NULL,
  `tcf` float DEFAULT NULL,
  `corrected` time DEFAULT NULL,
  `status` enum('DNF','DSQ') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `raceid` (`raceid`),
  KEY `boatid` (`boatid`),
  CONSTRAINT `entries_ibfk_1` FOREIGN KEY (`raceid`) REFERENCES `races` (`id`),
  CONSTRAINT `entries_ibfk_2` FOREIGN KEY (`boatid`) REFERENCES `boats` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3756 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entries`
--

LOCK TABLES `entries` WRITE;
/*!40000 ALTER TABLE `entries` DISABLE KEYS */;
/*!40000 ALTER TABLE `entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `races`
--

DROP TABLE IF EXISTS `races`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `races` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `seriesid` int(11) unsigned NOT NULL,
  `racedate` date NOT NULL,
  `rcboat` varchar(30) DEFAULT NULL,
  `rcskipper` varchar(30) DEFAULT NULL,
  `preparer` varchar(30) DEFAULT NULL,
  `method` enum('TOT','TOD') NOT NULL DEFAULT 'TOT',
  `param1` float DEFAULT NULL,
  `param2` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seriesid` (`seriesid`),
  CONSTRAINT `races_ibfk_1` FOREIGN KEY (`seriesid`) REFERENCES `series` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=429 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `races`
--

LOCK TABLES `races` WRITE;
/*!40000 ALTER TABLE `races` DISABLE KEYS */;
/*!40000 ALTER TABLE `races` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `series`
--

DROP TABLE IF EXISTS `series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `series` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `typeid` int(10) unsigned NOT NULL,
  `name` varchar(40) NOT NULL DEFAULT '',
  `defaultMethod` enum('TOT','TOD') NOT NULL DEFAULT 'TOT',
  `defaultParam1` float DEFAULT NULL,
  `defaultParam2` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `typeid` (`typeid`),
  CONSTRAINT `series_ibfk_1` FOREIGN KEY (`typeid`) REFERENCES `seriestypes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `series`
--

LOCK TABLES `series` WRITE;
/*!40000 ALTER TABLE `series` DISABLE KEYS */;
/*!40000 ALTER TABLE `series` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seriestypes`
--

DROP TABLE IF EXISTS `seriestypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seriestypes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `defaultMethod` enum('TOT','TOD') NOT NULL DEFAULT 'TOT',
  `defaultParam1` float DEFAULT NULL,
  `defaultParam2` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seriestypes`
--

LOCK TABLES `seriestypes` WRITE;
/*!40000 ALTER TABLE `seriestypes` DISABLE KEYS */;
INSERT INTO `seriestypes` VALUES (1,'Friday Nights','TOT',650,550),(2,'Sunday Chowders','TOT',800,550);
/*!40000 ALTER TABLE `seriestypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(20) NOT NULL DEFAULT '',
  `fname` varchar(40) DEFAULT NULL,
  `lname` varchar(40) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `tstamp` datetime DEFAULT NULL,
  `passwd` char(41) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'gunion','Bob','Gunion','bob.gunion@gmail.com','510-541-7478',100,'2014-12-21 09:16:23','*0D3CED9BEC10A777AEC23CCC353A8C08A633045E'),(2,'byc','','','manager@berkeleyyc.org','',100,'2024-09-06 20:33:45','*E2EC39E0AE451A018C6DDAC8CAB818C4F23B9EC8');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-08 12:17:39
